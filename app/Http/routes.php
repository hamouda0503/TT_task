<?php
Route::get('/', 'HomeController@index')->name('home');
Route::get('register', function(){ return View::make('register')->with('pTitle', "Register"); })->name('register');
Route::get('login', function(){ return View::make('login')->with('pTitle', "Login"); })->name('login');
Route::get('faq', function(){ return View::make('faq')->with('pTitle', "FAQ"); })->name('faq');

//----------------- User routes
Route::resource('users', 'UsersController', array('only' => array('show')));
Route::post('login', 'UsersController@login');
Route::post('make', 'UsersController@register');
Route::get('logout', 'UsersController@logout')->name('logout');
Route::post('resetPassword/{id}','UsersController@resetPassword');

//----------------- Auth routes
Route::group(array('before' => 'auth'), function()
{
	Route::get('hud', 'HomeController@index')->name('hud');
	Route::get('search', 'HomeController@search')->name('search');
	Route::get('profile', 'UsersController@index')->name('profile');
	Route::get('platforms', 'PlatformsController@index')->name('platforms');
	Route::delete('platforms/{id}', 'PlatformsController@destroy');
    Route::resource('servers', 'ServersController', array('only' => array('show')));


//	Route::delete('servers/{id}/remove', array('uses' => 'ServersController@remove', 'as' => 'servers.remove') );
//    Route::get('servers/{id}/files', array('uses' => 'ServersController@files', 'as' => 'servers.files' ));
//    Route::post('servers/{id}/files', array('uses' => 'FilesController@store', 'as' => 'files.store' ));
//    Route::delete('servers/{id}/files', array('uses' => 'FilesController@destroy', 'as' => 'files.remove' ));



});

//----------------- API routes
Route::group(['prefix' => '/api/'], function()
{	
	// USER 
    Route::get('user', 'UsersController@getUser');
    Route::post('user/{id}', 'UsersController@updateUser');
	Route::delete('user/', 'UsersController@deleteUser');
	Route::delete('users/', 'UsersController@show');


	// PLATFORM
	Route::get('platforms/{withWeight?}', 'PlatformsController@getAllUserPlatforms');
	Route::put('platforms/{id}', 'PlatformsController@updatePlatform');
	Route::post('platforms', 'PlatformsController@storePlatform');
	Route::delete('platforms/{id}', 'PlatformsController@removePlatform');

	//SERVER
    Route::get('servers/', 'ServersController@getAllUserServers');
    Route::get('servers/shared', 'ServersController@getAllMemberServers');
    Route::get('servers/{id}','ServersController@getServer');
    Route::get('servers/{id}/owner','ServersController@getOwner');
    Route::get('servers/{id}/members','ServersController@getMembers');
	Route::post('servers', 'ServersController@storeServer');
    Route::put('servers/{id}', 'ServersController@updateServer');
    Route::post('servers/{id}/{email}/invite', 'ServersController@invite');
    Route::delete('servers/{id}/{member_id}/remove', 'ServersController@removeMember' );

	// TASK
    Route::get('tasks', 'TasksController@getAllUserOpenTasks');
    Route::post('tasks/{platform_id}/{server_id}', 'TasksController@storeTask');
    Route::delete('tasks/{id}', 'TasksController@removeTask');
    Route::put('tasks/{id}', 'TasksController@updateTask');

	// CREDENTIALS
    Route::get('credentials/{id}','CredentialsController@getServerCredentials');
    Route::post('credentials', 'CredentialsController@storeCredential');
    Route::put('credentials/{id}', 'CredentialsController@updateCredential');
    Route::delete('credentials/{id}', 'CredentialsController@removeCredential');
});

//----------------- Admin routes
Route::get('admin','AdminController@index');
Route::get('vusers','UserAdminController@index')->name('vusers');
Route::get('vservers','UserAdminController@index1')->name('vservers');
Route::get('vplatforms','UserAdminController@index2')->name('vplatforms');
Route::get('vtasks','UserAdminController@index3')->name('vtasks');


Route::get('task-list', 'TasksController@list')->name('task.list');
Route::post('task-import', 'TasksController@tasksImport')->name('task.import');

Route::get('imp', 'MaatwebsiteDemoController@importExport');  
Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');  
Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');  


Route::get('chart', 'ChartController@index');


Route::get('events', 'EventController@index')->name('events.index');
Route::post('events', 'EventController@addEvent')->name('events.add');









