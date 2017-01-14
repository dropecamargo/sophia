 <?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Routes Auth
|--------------------------------------------------------------------------
*/
Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

/*
|--------------------------------------------------------------------------
| Secure Routes Application
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function()
{
	Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

	/*
	|-------------------------
	| Admin Routes
	|-------------------------
	*/
	Route::group(['prefix' => 'terceros'], function()
	{
		Route::get('dv', ['as' => 'terceros.dv', 'uses' => 'Admin\TerceroController@dv']);
		Route::get('rcree', ['as' => 'terceros.rcree', 'uses' => 'Admin\TerceroController@rcree']);
		Route::get('search', ['as' => 'terceros.search', 'uses' => 'Admin\TerceroController@search']);
	});
	Route::resource('terceros', 'Admin\TerceroController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);

	Route::resource('actividades', 'Admin\ActividadController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
	Route::resource('departamentos', 'Admin\DepartamentoController', ['only' => ['index', 'show']]);
	Route::resource('municipios', 'Admin\MunicipioController', ['only' => ['index']]);
	Route::resource('sucursales', 'Admin\SucursalController', ['except' => ['destroy']]);
	Route::resource('estados', 'Admin\EstadoController', ['except' => ['destroy']]);


	/*
	|-------------------------
	| Inventario Routes
	|-------------------------
	*/
	Route::resource('modelos','Inventario\ModeloController', ['except' => ['destroy']]);
	Route::resource('marcas', 'Inventario\MarcaController', ['except' => ['destroy']]);
	Route::resource('tipos', 'Inventario\TipoController', ['except' => ['destroy']]);
	Route::resource('contadores', 'Inventario\ContadorController', ['except' => ['destroy']]);

	/*
	|-------------------------
	| Tecnico
	|-------------------------
	*/
	Route::resource('tiposorden', 'Tecnico\TipoOrdenController', ['except' => ['destroy']]);
});

