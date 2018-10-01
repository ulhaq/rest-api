<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::middleware('jwt.auth')->namespace('Api')->group(function(){

    Route::apiResources([
      'users' => 'UserController',
      'teams' => 'TeamController',
      'roles' => 'RoleController',
    ]);

    Route::get('users/search/{q}', 'UserController@search');
    Route::get('users/{user}/teams', 'UserController@showTeams');
    Route::post('users/{user}/teams', 'UserController@addToTeams');
    Route::delete('users/{user}/teams', 'UserController@removeFromTeams');
    Route::post('users/{user}/roles', 'UserController@assignRoles');
    Route::delete('users/{user}/roles', 'UserController@unassignRoles');

    Route::get('teams/search/{q}', 'TeamController@search');
    Route::get('teams/{team}/users', 'TeamController@showUsers');
    Route::patch('teams/{team}/owner', 'TeamController@setOwner');
    Route::post('teams/{team}/users', 'TeamController@addUsers');
    Route::delete('teams/{team}/users', 'TeamController@removeUsers');

    Route::get('logout', 'AuthController@logout');
});
