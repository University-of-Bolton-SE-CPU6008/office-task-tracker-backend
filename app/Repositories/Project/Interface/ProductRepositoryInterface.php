<?php

namespace App\Repositories\Project\Interface;

interface ProductRepositoryInterface
{
    public function all($request);
    public function findById($id);
    public function store($request);
}