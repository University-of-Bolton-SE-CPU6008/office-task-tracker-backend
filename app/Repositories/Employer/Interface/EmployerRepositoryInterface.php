<?php

namespace App\Repositories\Employer\Interface;

interface EmployerRepositoryInterface
{
    public function all($request);
    public function findById($id);
    public function store($request);
}
