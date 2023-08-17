<?php

namespace App\Repositories\Designation;

use App\Helpers\Helper;
use App\Http\Resources\Designation\DesignationCollection;
use App\Models\Designation\Designation;
use App\Repositories\Designation\Interface\DesignationRepositoryInterface;
use Illuminate\Http\Response;

class DesignationRepository implements DesignationRepositoryInterface
{

    public function all($request)
    {

        if($request->input('all', '') == 1) {
            $designation_list = Designation::all();
        } else {
            $designation_list = Designation::orderBy('created_at', 'desc')->paginate(10);
        }

        if (count($designation_list) > 0) {
            return new DesignationCollection($designation_list);
        } else {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
}
