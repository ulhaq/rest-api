<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\User
     */
    public function index()
    {
        return UserResource::collection(User::paginate(3));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $q
     * @return \App\Http\Resources\User
     */
    public function search($q)
    {
        return UserResource::collection(User::search($q)->paginate(3));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showTeams(User $user)
    {
        return $user->teams()->select('title')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function update(UserRequest $request, User $user)
    {
          $user->update($request->all());

          return new UserResource($user);
    }

    /**
     * Add the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function addToTeams(UserRequest $request, User $user)
    {
        $user->teams()->attach($request->teams);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function removeFromTeams(UserRequest $request, User $user)
    {
        $user->teams()->detach($request->teams);

        return new UserResource($user);
    }

    /**
     * Add the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function assignRoles(UserRequest $request, User $user)
    {
        $user->roles()->attach($request->roles);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function unassignRoles(UserRequest $request, User $user)
    {
        $user->roles()->detach($request->roles);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function destroy(User $user)
    {
        $user->delete();

        return new UserResource($user);
    }
}
