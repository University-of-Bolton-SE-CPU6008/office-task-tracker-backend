<?php

namespace App\Repositories\Task;

use App\Helpers\Helper;
use App\Http\Resources\Task\TaskCollection;
use App\Http\Resources\Task\TaskResource;
use App\Models\Employee\Employee;
use App\Models\Task\Task;
use App\Repositories\Task\Interface\TaskRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{
    public function all($request)
    {
        $employee = Employee::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->user_level_id == 1){
            if($request->input('all', '') == 1) {
                $task_list = Task::all();
            } else {
                $task_list = Task::orderBy('created_at', 'desc')->paginate(10);
            }
        }else{
            if($request->input('all', '') == 1) {
                $task_list = Task::where('employee_id',$employee->id)->get();
            } else {
                $task_list = Task::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->paginate(10);
            }
        }

        if (count($task_list) > 0) {
            return new TaskCollection($task_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function report()
    {
        $employee = Employee::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->user_level_id == 1){
            $task_list = Task::orderBy('date', 'desc')
                ->get()
                ->groupBy(function ($task) {
                    return $task->date;
                });
        }else{
            $task_list = Task::where('employee_id', $employee->id)->select("date","number_of_hour")
                ->orderBy('date', 'desc')
                ->get()
                ->groupBy(function ($task) {
                    return $task->date;
                });

        }
        if ($task_list) {
            return $task_list;

        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function findById($id)
    {
        $task = Task::find($id);
        if ($task) {
            return new TaskResource($task);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
    public function store($request)
    {
        $task = new Task();
        $task->employee_id = $request->employee_id;
        $task->project_id = $request->project_id;
        $task->task_type_id = $request->task_type_id;
        $task->task_detail = $request->task_detail;
        $task->date = $request->date;
        $task->number_of_hour = $request->number_of_hour;
        $task->comment = $request->comment;
        if ($task->save()) {

            activity('task')
                ->performedOn($task)
                ->causedBy(auth()->user())
                ->withProperties(['name' => 'task'])
                ->log('created');

            return new TaskResource($task);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
}
