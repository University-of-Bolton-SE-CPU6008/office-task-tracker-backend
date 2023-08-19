<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Repositories\Employer\Interface\EmployerRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employerRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->employerRepository->all($request);
    }

    /**
     * Display a listing of the resource.
     */
    public function findById($id)
    {
        return $this->employerRepository->findById($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'project_id'=>'required',
            'designation_id'=>'required',
            'state'=>'required'

        ]);
        return $this->employerRepository->store($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'project_id'=>'required',
            'designation_id'=>'required',
            'state'=>'required'

        ]);
        return $this->employerRepository->update($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function statusUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status'=>'required'

        ]);
        return $this->employerRepository->statusUpdate($request);
    }

    public function involve(Request $request)
    {
        $request->validate([
            'employer_id' => 'required',
            'project_id'=>'required'

        ]);
        return $this->employerRepository->newProjectInvolve($request);

    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
