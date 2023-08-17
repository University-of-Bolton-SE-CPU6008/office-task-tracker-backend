<?php

namespace App\Repositories\Task\Interface;

interface TaskRepositoryInterface
{
    public function all($request);
    public function findById($id);
    public function report();
    public function store($request);
}
