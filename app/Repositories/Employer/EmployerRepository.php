<?php

namespace App\Repositories\Employer;

use App\Helpers\Helper;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee\Employee;
use App\Models\User\User;
use App\Models\User\UserLevel;
use App\Repositories\Employer\Interface\EmployerRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Response;

class EmployerRepository implements EmployerRepositoryInterface
{


    public function all($request)
    {

        if($request->input('all', '') == 1) {
            $employer_list = Employee::all();
        } else {
            $employer_list = Employee::orderBy('created_at', 'desc')->paginate(10);
        }

        if (count($employer_list) > 0) {
            return new EmployeeCollection($employer_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
    public function findById($id)
    {

        $employer = Employee::find($id);

        if ($employer) {
            return new EmployeeResource($employer);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
    public function store($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = date('Y-m-d');
        $user->password = bcrypt($request->password);
        $user->state = $request->state;
        $user->user_level_id = 2;
        $user->user_role = UserLevel::where('scope','user')->first()->id;

        if ($user->save()) {
            $employer = new Employee();
            $employer->user_id = $user->id;
            $employer->designation_id = $request->designation_id;
            $employer->status = $request->state;

            if ($employer->save()) {
                $employer->projects()->sync($request->project_id);

                activity('employer')
                    ->performedOn($employer)
                    ->causedBy(auth()->user())
                    ->withProperties(['name' => $request->name])
                    ->log('created');

                return new EmployeeResource($employer);
            } else {
                return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
            }
        }
        return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
    }
}
