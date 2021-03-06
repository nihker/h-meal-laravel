<?php


Route::get('/', 'Auth\AuthController@getLogin');

Route::group(['middleware' => 'auth'], function () 
{
	// Index Welcome
	Route::get('app', 'TaskController@index');
	Route::post('app/task/create', 'TaskController@create');
	Route::post('app/task/filter', 'TaskController@filter');
	Route::delete('app/task/delete/{id}','TaskController@destroy' );
	Route::put('app/task/update/{id}', 'TaskController@update');
	
	// Chart 
	Route::get('app/chart/index', 'ChartController@index');
	Route::post('app/chart/index', 'ChartController@update');

	//Admin dashboard and controll Users 
	Route::get('app/user/list', 'AdminController@showUserList');
	Route::post('app/user/add', 'AdminController@addUser');
	Route::delete('app/user/delete/{id}', 'AdminController@destroy');
	Route::put('app/user/update/{id}', 'AdminController@update');


	// Patient
	Route::get('app/patient/list', 'PatientController@index');
	Route::post('app/patient/add', 'PatientController@store');
	Route::delete('app/patient/delete/{id}', 'PatientController@destroy');
	Route::put('app/patient/update/{id}', 'PatientController@update');
	Route::get('app/patient/table', 'PatientController@tableShow');


	// Food
	Route::get('app/food/list', 'FoodController@index');
	Route::post('app/food/add', 'FoodController@store');
	Route::delete('app/food/delete/{id}', 'FoodController@destroy');
	Route::put('app/food/update/{id}', 'FoodController@update');
	//Route::get('app/food/quantity/{id}', 'FoodController@upQuantity');



	// Patient details 
	Route::get('app/patient/detail/{id}','PatientDetailController@showDetails' );

	Route::post('app/patient/store_day_v/{id}', 'PatientDetailController@storeDayVisits');
	Route::delete('app/patient/day_visit_delete/{id}', 'PatientDetailController@destroyds');
	Route::put('app/patient/day_visit_edit/{id}', 'PatientDetailController@editds');

	Route::post('app/patient/store_m_sugar/{id}', 'PatientDetailController@storeMsugar');
	Route::delete('app/patient/m_sugar_delete/{id}', 'PatientDetailController@destroyms');
	Route::put('app/patient/m_sugar_edit/{id}', 'PatientDetailController@editdms');

	Route::post('app/patient/store_visits/{id}', 'PatientDetailController@storeVisits');
	Route::delete('app/patient/visits_delete/{id}', 'PatientDetailController@destroyv');
	Route::put('app/patient/visits_edit/{id}', 'PatientDetailController@editv');

	Route::get('/ajax-subfood', function(){
		$cat_id = Input::get('cat_id');

		$subcategory = App\Food::where('food_category_id','=',$cat_id)->where('quantity','>','0')->get();

		return Response::json($subcategory);
	});
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');




Route::get('/users', function()
{

   $users = new \App\User;

   return $users::all();
});

