<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateFormRequest;
use App\Http\Requests\Admin\Role\DeleteFormRequest;
use App\Http\Requests\Admin\Role\DeleteMultipleFormRequest;
use App\Http\Requests\Admin\Role\SetDefaultFormRequest;
use App\Http\Requests\Admin\Role\UpdateFormRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Role\RoleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    // private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.roles.index');
    }

    public function getDatatables(Request $request)
    {
        return $this->roleService->getDatatables($request);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! auth()->user()->can('create-role'), 403);
        return $this->roleService->getCreateView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request)
    {
        try {
            $this->roleService->create($request->all());
            alert()->success('create success');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            alert()->error('create failed');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return $this->roleService->getEditView($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormRequest $request, Role $role)
    {
        try {
            $this->roleService->update($role, $request->all());
            alert()->success('update success');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            alert()->error('update failed');
            return redirect()->back()->withInput();
        }
    }

    public function setRoleDefault(SetDefaultFormRequest $request, Role $role)
    {
        try {
            $this->roleService->setRoleDefault($role, $request->validated());
            return response()->json(['message' => 'set default success'], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, DeleteFormRequest $request)
    {
        try {
            $this->roleService->delete($role);
            return response()->json(
                ['message' => 'delete success'], 200
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Server Error'], 500
            );
        }
    }

    public function deleteMultiple(DeleteMultipleFormRequest $request)
    {
        try {
            $this->roleService->deleteMultiple($request->ids);
            return response()->json(
                ['message' => 'delete success'], 200
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Server Error'], 500
            );
        }
    }
}
