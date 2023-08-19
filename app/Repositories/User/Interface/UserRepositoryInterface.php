<?php

namespace App\Repositories\User\Interface;

interface UserRepositoryInterface
{
    public function all($request);
    public function changePassword($request);
    public function findById($id);


}
