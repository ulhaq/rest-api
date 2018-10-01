<?php

namespace App;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use Searchable;

    /**
     * The attributes that are searchable.
     *
     * @var array
     */
    protected $searchable = [
        'title',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id', 'title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
    ];

    /**
     * The users that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
