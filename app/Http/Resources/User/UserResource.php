<?php

namespace App\Http\Resources\User;

use App\Helpers\Helper;
use App\Models\Employee\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'state'=> $this->state,
            'user_role'=> $this->user_role,
            'employee'=> Employee::where('user_id',$this->id)->first()
        ];
    }
}
