<?php

namespace App\Repositories\Project;

use App\Helpers\Helper;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Project\ProjectCollection;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Employee\Employee;
use App\Models\Project\Project;
use App\Models\User;
use App\Repositories\Employer\Interface\EmployerRepositoryInterface;
use App\Repositories\Project\Interface\ProductRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Response;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($request)
    {
        if($request->input('all', '') == 1) {
            $project_list = Project::all();
        } else {
            $project_list = Project::orderBy('created_at', 'desc')->paginate(10);
        }

        if (count($project_list) > 0) {
            return new ProjectCollection($project_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
    public function findById($id)
    {

        $project = Project::find($id);

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
