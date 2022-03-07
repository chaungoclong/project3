<?php

namespace App\Http\Controllers\Admin\Role;

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
    private RoleService $roleService;

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
        checkPermission('view_role');

        return view('pages.admin.roles.index');
    }

    /**
     * Lay du lieu datatables de hien thi
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getDatatables(Request $request)
    {
        checkPermission('view_role');

        return $this->roleService->getDatatables($request);
    }
    /**
     * Hien thi form tao moi vai tro
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPermission('create_role');

        return $this->roleService->getCreateView();
    }

    /**
     * Tao vai tro moi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request)
    {
        checkPermission('create_role');

        try {
            $this->roleService->create($request->all());
            alert()->success(__('create success', ['name' => 'vai trò']));

            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            alert()->error(__('create fail', ['name' => 'vai trò']));

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
     * Hien thi form cap nhat
     * Khong the hien thi form cap nhat cua cac vai tro goc|admin
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        checkPermission('edit_role');

        return $this->roleService->getEditView($role);
    }

    /**
     * cap nhat vai tro
     * khong the cap nhat cac vai tro goc|admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormRequest $request, Role $role)
    {
        checkPermission('edit_role');

        try {
            $this->roleService->update($role, $request->all());
            alert()->success(__('update success', ['name' => 'vai trò']));

            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            alert()->error(__('update fail', ['name' => 'vai trò']));

            return redirect()->back()->withInput();
        }
    }

    /**
     * dat vai tro mac dinh
     * khi mot vai tro duoc dat la mac dinh => cac vai tro khac bi huy mac dinh
     *
     * @param SetDefaultFormRequest $request [description]
     * @param Role                  $role    [description]
     */
    public function setRoleDefault(SetDefaultFormRequest $request, Role $role)
    {
        checkPermission('edit_role');

        try {
            $this->roleService->setRoleDefault($role, $request->validated());
            
            return response()->json(
                ['message' => __("set default success")],
                200
            );
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(
                ['message' => __("server error")],
                500
            );
        }
    }

    /**
     * xoa vai tro
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, DeleteFormRequest $request)
    {
        checkPermission('delete_role');

        try {
            $this->roleService->delete($role);

            return response()->json(
                ['message' => __('delete success', ['name' => 'vai trò'])],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => __("server error")],
                500
            );
        }
    }

    /**
     * xoa nhieu vai tro
     * neu vai tro khong the xoa thi se bo qua va xoa cac vai tro khac
     *
     * @param  DeleteMultipleFormRequest $request [description]
     * @return [type]                             [description]
     */
    public function deleteMultiple(DeleteMultipleFormRequest $request)
    {
        checkPermission('delete_role');

        try {
            $this->roleService->deleteMultiple($request->ids);

            return response()->json(
                ['message' => __('delete success', ['name' => 'vai trò'])],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => __("server error")],
                500
            );
        }
    }
}
