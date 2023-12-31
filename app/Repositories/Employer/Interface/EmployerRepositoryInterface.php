<?php

namespace App\Repositories\Employer\Interface;

interface EmployerRepositoryInterface
{
    public function all($request);
    public function findById($id);
    public function store($request);
    public function update($request);
    public function statusUpdate($request);
    public function newProjectInvolve($request);

}
