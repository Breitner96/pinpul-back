<?php

use Illuminate\Http\Request;

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@authenticate');

// Módulo de categorias
Route::resource('categories', 'CategoryController')->except(['create', 'edit']);

// Módulo de categorias by slug
Route::get('categories-slug/{slug}', 'CategoryController@slug');

// Módulo de categorias servicios
Route::resource('categories_services', 'CategoryController')->except(['create', 'edit']);

// Módulo de ciudades
Route::resource('cities', 'CityController')->except(['create', 'edit']);
Route::get('cities-country/{id}', 'CityController@cityByCountry');

// Contador por mes
Route::post('contador-mes-gratis', 'ProviderController@contadorMesGratis');

// Módulo de ciudades
Route::resource('comments', 'CommentController')->except(['create', 'edit']);

// Módulo de paises
Route::resource('countries', 'CountryController')->except(['create', 'edit']);

// Módulo ePayco
Route::post('epayco-token', 'ePaycoController@createTokenClient');
Route::post('epayco-customer', 'ePaycoController@createCustomer');
Route::post('epayco-subscription', 'ePaycoController@generateSubscription');

// Módulo de mensajería
Route::resource('messages', 'MessagesController');
Route::get('messages-providers/{id}', 'MessagesController@messagesProviders');
Route::get('get-messages-providers/{id}', 'MessagesController@listProvidersByUserId');

Route::get('get-gerencia-to-provider/{id}', 'MessagesController@getGerenciaToProvider');
Route::post('send-gerencia-to-provider', 'MessagesController@sendGerenciaToProvider');

// Módulo de permisos
Route::resource('permissions', 'PermissionController')->except(['create', 'edit']);

// Módulo de planes
Route::resource('plans', 'PlanController')->except(['create', 'edit']);

// Módulo de promociones
Route::resource('promotions', 'PromotionController')->except(['create', 'edit']);
Route::get('promotions-provider/{id}', 'PromotionController@promotionByProvider');

// Módulo de proveedores
Route::resource('providers', 'ProviderController')->except(['create', 'edit']);
// Route::get('providers-images/{id}', 'ProviderController@images');

// Módulo de proveedores servicios
Route::get('providers-slug/{name}', 'ProviderController@slug');

//Contador proveedor
Route::post('providers-slug', 'ProviderController@peopleCount');

//Contador proveedor
Route::get('providers-user/{id}', 'ProviderController@getProviderByUser');

// Listado de proveedores por estado activo
Route::get('providers-state', 'ProviderController@listProviders');

// Borrar imagen de galería en proveedores
Route::post('providers-image-delete', 'ProviderController@eliminarFotoGaleria');

// Módulo de puntuacion
Route::resource('punctuations', 'PunctuationController')->except(['create', 'edit']);
Route::post('punctuations-state', 'PunctuationController@changeStatePuntuaction');

// Módulo de puntuación de la app
Route::resource('ratings', 'RatingController')->except(['create', 'edit']);

// Register providers
Route::post('register-providers', 'AuthController@registerProvider');

// Módulo de roles
Route::resource('roles', 'RolController')->except(['create', 'edit']);

// Envío de formulario a proveedores
Route::post('send-email-provider', 'EmailControllers@contactProvider');

// Envío de formulario a pinpul
Route::post('send-email-pinpul', 'EmailControllers@contactPinpul');

// Módulo de servicios
Route::resource('services', 'ServiceController')->except(['create', 'edit']);

// Módulo de type tipo de clientes
Route::resource('type-clients', 'TypeClientController')->except(['create', 'edit']);

// Módulo de type tipo de empresa
Route::resource('type-companies', 'TypeCompanyController')->except(['create', 'edit']);

// Módulo de tipo de documento¿
Route::resource('type-documents', 'TypeDocumentController')->except(['create', 'edit']);

// Módulo de usuarios
Route::resource('users', 'UserController')->except(['create', 'edit']);




