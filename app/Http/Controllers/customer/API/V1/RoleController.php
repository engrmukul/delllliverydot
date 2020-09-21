<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController {

    public function __construct(){
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return $this->sendResponse($roles, 'Role retrieved successfully.',Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }

        $role = Role::create(['name' => $request->input('name')]);
        if($role){
            $role->syncPermissions($request->input('permission'));
            return $this->sendResponse($role, 'Role add successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    /**
     * @param $id
     */
    public function show($id)
    {
        $data['role'] = Role::find($id);
         if (is_null($data['role'])) {
            return $this->sendError('Role not found.');
        }

        $data['rolePermissions'] = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return $this->sendResponse($data, 'Role retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['role'] = Role::find($id);

        if (is_null($data['role'])) {
            return $this->sendError('Role not found.');
        }

        $data['permission'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return $this->sendResponse($data, 'Role retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }

        $role = Role::find($id);
        $role->name = $request->input('name');

        if($role->save()){
            $role->syncPermissions($request->input('permission'));
            return $this->sendResponse($role, 'Role update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return $this->sendResponse([], 'Role delete successfully.',Response::HTTP_OK);

    }

    /**
     * @param Request $request
     * @param Role $role
     * @param User $user
     * @return Response
     */
    public function rolesAddUser(Request $request, Role $role, User $user)
    {
        $user->assignRole($role);

        return $this->sendResponse($user, 'Assign role successfully.',Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param Role $role
     * @param User $user
     * @return Response
     */
    public function rolesRemoveUser(Request $request, Role $role, User $user)
    {
        $user->removeRole($role);

        return $this->sendResponse($user, 'Remove role successfully.',Response::HTTP_OK);

    }
}
