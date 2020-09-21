<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController {

    public function __construct(){
        $this->middleware('permission:permission-list');
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return $this->sendResponse($permissions, 'Permission retrieved successfully.',Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }

        $input = $request->all();
        $permission = Permission::create(['name' => $input['name']]);

        if($permission){
            return $this->sendResponse($permission, 'Permission add successfully.',Response::HTTP_OK);
        }

        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        if (is_null($permission)) {
            return $this->sendError('Permission not found.');
        }

        return $this->sendResponse($permission, 'Permission retrieved successfully.');
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
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }

        $permission = Permission::find($id);
        $permission->name = $request->input('name');

        if($permission->save()){
            return $this->sendResponse($permission, 'Permission update successfully.',Response::HTTP_OK);
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
        DB::table("permissions")->where('id',$id)->delete();
        return $this->sendResponse([], 'Permission delete successfully.',Response::HTTP_OK);

    }
}
