<?php

namespace App\Repositories\User;

use App\Helpers\Helper;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Task\TaskResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Project\Project;
use App\Models\User\User;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserRepository implements UserRepositoryInterface
{

    public function all($request)
    {
        if(Auth::user()->user_level_id == 1) {

            if ($request->input('all', '') == 1) {
                $user_list = User::all();
            } else {
                $user_list = User::orderBy('created_at', 'desc')->paginate(10);
            }
        }else{
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }

        if (count($user_list) > 0) {
            return new UserCollection($user_list);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }




    public function changePassword($request)
    {
        $user = User::find($request->user_id);
        if (Hash::check($request->old_password, $user->password)) {

            $user->password = bcrypt($request->password);
            if ($user->save()) {
                activity('change_password')
                    ->performedOn($user)
                    ->causedBy(auth()->user())
                    ->withProperties(['name' => $user->name])
                    ->log('created');

                return new UserResource($user);
            } else {
                return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
            }
        }else{
            return response()->json(['message' => 'Old password is incorrect'], 422);
            return Helper::error("Old password is incorrect", 422);
        }
    }
    public function findById($id)
    {
        if(Auth::user()->user_level_id == 1) {
            $user = User::find($id);
        }else{
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
        if ($user) {
            return new UserResource($user);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

}
