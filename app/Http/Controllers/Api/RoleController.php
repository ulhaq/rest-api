<?php

namespace App\Http\Controllers\Api;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role as RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Role
     */
    public function index()
    {
        return RoleResource::collection(Role::paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \App\Http\Resources\Role
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \App\Http\Resources\Role
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \App\Http\Resources\Role
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \App\Http\Resources\Role
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return new RoleResource($role);
    }
}
