<?php

namespace App\Repositories\User;

use App\Helpers\Helper;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Project\Project;
use App\Models\User\User;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class UserRepository implements UserRepositoryInterface
{

    public function all($request)
    {

        if($request->input('all', '') == 1) {
            $user_list = User::all();
        } else {
            $user_list = User::orderBy('created_at', 'desc')->paginate(10);
        }

        if (count($user_list) > 0) {
            return new UserCollection($user_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function findById($id)
    {

        $user = User::find($id);

        if ($user) {
            return new UserResource($user);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

}
