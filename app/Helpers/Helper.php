<?php

namespace App\Helpers;

use App\Models\User\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use DateTime;

class Helper
{
    public static function error($message, $code)
    {
        return Response::json([
            'status' => 'error',
            'success' => false,
            'code' => $code,
            'message' => $message], $code);
    }

    public static function success($message, $code)
    {
        return Response::json([
            'status' => 'success',
            'success' => true,
            'code' => $code,
            'message' => $message], $code);
    }

    public static function imageResponse($image, $isInStorage = true)
    {
        if ($image == null) {
            return null;
        } else {
            if ($isInStorage) {
                return asset('storage') . $image;
            } else {
                return $image;
            }

        }
    }

    public static function isAdmin()
    {
        return Auth::user()->userLevel->scope == 'admin' ? true : null;
    }

    public static function admin()
    {
        return User::where('user_level_id',1)->first();
    }

    public static function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
