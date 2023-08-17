<?php

namespace App\Repositories\Task;

use App\Helpers\Helper;
use App\Http\Resources\Task\TaskTypeCollection;
use App\Models\TaskType;
use App\Repositories\Task\Interface\TaskTypeRepositoryInterface;
use Illuminate\Http\Response;

class TaskTypeRepository implements TaskTypeRepositoryInterface
{

    public function all($request)
    {

        if($request->input('all', '') == 1) {
            $type_list = TaskType::all();
        } else {
            $type_list = TaskType::orderBy('created_at', 'desc')->paginate(10);
        }

        if (count($type_list) > 0) {
            return new TaskTypeCollection($type_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
}
