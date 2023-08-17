<?php

namespace App\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->userRepository->all($request);
    }

    /**
     * get the form for creating a new resource.
     */
    public function findById($id){
        return $this->userRepository->findById($id);
    }
}
