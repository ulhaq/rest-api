<?php

namespace App\Http\Controllers\Api;

use App\Team;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Team as TeamResource;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Team
     */
    public function index()
    {
        return TeamResource::collection(Team::paginate(3));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $q
     * @return \App\Http\Resources\Team
     */
    public function search($q)
    {
        return TeamResource::collection(Team::search($q)->paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TeamRequest  $request
     * @return \App\Http\Resources\Team
     */
    public function store(TeamRequest $request)
    {
        $team = Team::create($request->all());

        return new TeamResource($team);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \App\Http\Resources\Team
     */
    public function show(Team $team)
    {
        return new TeamResource($team);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function showUsers(Team $team)
    {
        return $team->users()->select('name')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeamRequest  $request
     * @param  \App\Team  $team
     * @return \App\Http\Resources\Team
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return new TeamResource($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeamRequest  $request
     * @param  \App\Team  $team
     * @return \App\Http\Resources\Team
     */
    public function setOwner(TeamRequest $request, Team $team)
    {
        $team->update([
            'owner_id' => $request->id
        ]);

        return new TeamResource($team);
    }

    /**
     * Add the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeamRequest  $request
     * @param  \App\Team  $team
     * @return \App\Http\Resources\Team
     */
    public function addUsers(TeamRequest $request, Team $team)
    {
        $team->users()->attach($request->users);

        return new TeamResource($team);
    }

    /**
     * Remove the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeamRequest  $request
     * @param  \App\Team  $team
     * @return \App\Http\Resources\Team
     */
    public function removeUsers(TeamRequest $request, Team $team)
    {
        $team->users()->detach($request->users);

        return new TeamResource($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \App\Http\Resources\Team
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return new TeamResource($team);
    }
}
