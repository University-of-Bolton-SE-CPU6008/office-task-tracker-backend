<?php

namespace App\Repositories\Project;

use App\Helpers\Helper;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Project\ProjectCollection;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeProject;
use App\Models\Project\Project;
use App\Models\User;
use App\Models\User\UserLevel;
use App\Repositories\Employer\Interface\EmployerRepositoryInterface;
use App\Repositories\Project\Interface\ProductRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($request)
    {
        $employee = Employee::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->user_level_id == 1){
            if($request->input('all', '') == 1) {
                $project_list = Project::all();
            } else {
                $project_list = Project::orderBy('created_at', 'desc')->paginate(10);
            }
        }else{
            $projects = EmployeeProject::select("project_id")->where('employee_id',$employee->id)->get();
            if($projects){
                if($request->input('all', '') == 1) {
                    $project_list = Project::whereIn('id',$projects)->get();
                } else {
                    $project_list = Project::whereIn('id',$projects)->orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
            }
        }

        if (count($project_list) > 0) {
            return new ProjectCollection($project_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
    public function findById($id)
    {
        $employee = Employee::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->user_level_id == 1){
            $project = Project::find($id);
        }else{
            $employeeProject = EmployeeProject::where('employee_id',$employee->id)->where('project_id',$id)->first();
            if($employeeProject){
                $project = Project::find($id);
            }else{
                return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
            }
        }

        if ($project) {
            return new ProjectResource($project);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
    public function store($request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->status = $request->status;
        if ($project->save()) {

            activity('project')
                ->performedOn($project)
                ->causedBy(auth()->user())
                ->withProperties(['name' => $project->name])
                ->log('created');

            return new ProjectResource($project);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

}
