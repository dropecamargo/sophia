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

		Route::resource('contactos', 'Admin\ContactoController', ['only' => ['index', 'store', 'update']]);
		
	});

	/*
	|--------------------------
	| Admin Routes
	|--------------------------
	*/
	Route::resource('terceros', 'Admin\TerceroController', ['except' => ['destroy']]);
	Route::resource('actividades', 'Admin\ActividadController', ['except' => ['destroy']]);
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

	Route::group(['prefix' => 'productos'], function()
	{
		Route::get('search', ['as' => 'productos.search', 'uses' => 'Inventario\ProductoController@search']);

		Route::resource('sirveas', 'Inventario\SirveaController', ['only' => ['index', 'store', 'destroy']]);
		Route::resource('productoscontador', 'Inventario\ProductoContadorController', ['only' => ['index', 'store', 'destroy']]);
	});

	Route::resource('productos', 'Inventario\ProductoController', ['except' => ['destroy']]);
	
	/*
	|-------------------------
	| Tecnico Routes
	|-------------------------
	*/	

	Route::group(['prefix'=>'contratos'],function()
	{
		Route::resource('danoc','Tecnico\ContratoDanoController',['only'=>['index', 'store', 'destroy']]);
	});


	//modulos
	Route::group(['prefix'=>'ordenes'],function()
	{
		Route::resource('visitas','Tecnico\VisitaController',['only'=>['index', 'store', 'destroy']]);
		Route::resource('visitasp','Tecnico\VisitapController',['only'=>['index', 'store', 'destroy']]);
		Route::resource('contadoresp','Tecnico\ContadorespController',['only'=>['index']]);
	});

	Route::resource('contratos', 'Tecnico\ContratoController', ['except' => ['destroy']]);
	Route::resource('ordenes', 'Tecnico\OrdenController', ['except' => ['destroy']]);
	//referencias
	Route::resource('tiposorden', 'Tecnico\TipoOrdenController', ['except' => ['destroy']]);
	Route::resource('solicitantes', 'Tecnico\SolicitanteController', ['except' => ['destroy']]);
	Route::resource('danos', 'Tecnico\DanoController', ['except' => ['destroy']]);
	Route::resource('prioridades', 'Tecnico\PrioridadController', ['except' => ['destroy']]);
	Route::resource('zonas', 'Tecnico\ZonaController', ['except' => ['destroy']]);

	Route::group(['prefix'=>'asignaciones'], function()
	{
		Route::resource('detalle','Tecnico\Asignacion2Controller', ['only'=>['index','store']]);
		Route::resource('contratos','Tecnico\ContratoController', ['only'=>['index']]);
	});
	Route::resource('asignaciones', 'Tecnico\Asignacion1Controller', ['except' => ['edit','destroy']]);
});

