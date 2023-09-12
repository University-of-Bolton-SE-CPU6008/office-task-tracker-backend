<?php

namespace App\Repositories\Employer;

use App\Helpers\Helper;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeProject;
use App\Models\Project\Project;
use App\Models\User\User;
use App\Models\User\UserLevel;
use App\Repositories\Employer\Interface\EmployerRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EmployerRepository implements EmployerRepositoryInterface
{


    public function all($request)
    {
        if(Auth::user()->user_level_id == 1) {

            if ($request->input('all', '') == 1) {
                $employer_list = Employee::all();
            } else {
                $employer_list = Employee::orderBy('created_at', 'desc')->paginate(10);
            }
        }else{
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
        if (count($employer_list) > 0) {
            return new EmployeeCollection($employer_list);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
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
        $project = Project::find($request->project_id);
        if(!$project){
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
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

    public function newProjectInvolve($request){
        $employer = Employee::find($request->employer_id);
        if($employer){
            $employeeProject = new EmployeeProject();
            $employeeProject->employee_id = $request->employer_id;
            $employeeProject->project_id = $request->project_id;
            $employeeProject->save();
//            $employer->projects()->sync($request->project_id);
            return new EmployeeResource($employer);
        }else{
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }

    }
    public function update($request)
    {
//            $employer = Employee::find($request->id);
//            $employer->designation_id = $request->designation_id;
//            $employer->status = $request->state;
//
//            if ($employer->save()) {
//                $employer->projects()->sync($request->project_id);
//
//                activity('employer')
//                    ->performedOn($employer)
//                    ->causedBy(auth()->user())
//                    ->withProperties(['name' => $request->name])
//                    ->log('created');
//
//                return new EmployeeResource($employer);
//            } else {
//                return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
//            }
//
//        return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
    }

    public function statusUpdate($request)
    {
        $employer = Employee::find($request->id);
        $employer->status = $request->status;

        if ($employer->save()) {

            activity('employer_update')
                ->performedOn($employer)
                ->causedBy(auth()->user())
                ->withProperties(['name' => $request->name])
                ->log('created');

            return new EmployeeResource($employer);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }


}
