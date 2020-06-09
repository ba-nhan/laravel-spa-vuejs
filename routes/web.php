<?php


Route::get('/', function () {
    return view('welcome');
});



Route::post('luuhosobn', 	'BenhNhanController@postSetting');
Route::get('hosobn', 		'BenhNhanController@hoso');
Route::get('checkInfoBN', 	'BenhNhanController@checkNotInfo');
Route::get('lichsukbbn', 	'BenhNhanController@lichsukbbn');

Route::get('trinhdo', 		'BacSiController@trinhdo');
Route::get('chuyenkhoa', 	'BacSiController@chuyenkhoa');
Route::get('tinh', 			'BacSiController@tinh');
Route::post('noicongtac', 	'BacSiController@noict');
Route::post('luuhosobs', 	'BacSiController@luuhoso');
Route::get('hosobs', 		'BacSiController@hoso');
Route::get('checkInfoBS', 	'BacSiController@checkNotInfo');
Route::get('hienthiDSKB',	'BacSiController@hienthidanhsachkb');
Route::get('tenphongkham',	'BacSiController@tenPhongkham');
Route::post('ketqualayso',	'BacSiController@ketqualayso');
Route::post('autocomplete',	'BacSiController@autocomplete');
Route::post('luuKetquakb',	'BacSiController@luuKetquakhambenh');
Route::post('checkLuukqkb',	'BacSiController@checkLuu');
Route::post('lichsukhambenh','BacSiController@lichsukhambenh');
Route::post('loclskb',		'BacSiController@locLichsukhambenh');
Route::post('luutin',		'BacSiController@luutin');
Route::get('tenthuoc',		'BacSiController@namethuoc');
Route::get('tintuc',		'BacSiController@tintuc');



Route::post('list_clinic', 	'PageController@index');
Route::post('filter_clinic','PageController@filter_clinic');

Route::post('hosopk', 		'PhongKhamController@hoso');
Route::get('dschuyenkhoa',	'PhongKhamController@list_chuyenkhoa');
Route::post('bangtin',		'PhongKhamController@bangtin');
Route::get('phongkham',		'PhongKhamController@phongkham');

Route::post('dangkylayso', 	'LaysoController@dangky');
Route::post('show_NumKB', 	'LaysoController@show_NumKB');

Route::post('search', 		'SearchController@search');




// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');