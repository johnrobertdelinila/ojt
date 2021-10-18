<?php

// Route::get('/abc', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/', 'InventoryController@logbook');
Route::resource('/store', 'InventoryController');
Route::get('/dashboard', 'InventoryController@dashboard');
Route::get('/inventory_lists', 'InventoryController@inventory_lists');
Route::get('/inventory_registration', 'InventoryController@inventory_registration');
Route::get('/inventory_edit/{id}', 'InventoryController@inventory_edit');
Route::get('/inventory_acc_edit/{id}', 'InventoryController@inventory_acc_edit');
Route::post('/inventory_acc_update/{id}', 'InventoryController@inventory_acc_update');
Route::get('/inventory_par_edit/{id}', 'InventoryController@inventory_par_edit');
Route::post('/inventory_par_update/{id}', 'InventoryController@inventory_par_update');
//dropping
Route::get('/inventory_export_excel', 'InventoryController@inventory_export_excel');
Route::get('/search_items', 'InventoryController@search_items');
Route::post('/multi_release_item', 'InventoryController@multi_release_item');
Route::get('/release_item/{id}', 'InventoryController@release_item');
Route::get('/qrcode/{id}', 'InventoryController@qrcode');
Route::get('/cashedout_item/{id}', 'InventoryController@cashedout_item');
Route::get('/cashedout_all_item/{id}', 'InventoryController@cashedout_all_item');
Route::get('/cancel_item/{id}', 'InventoryController@cancel_item');
Route::get('/pending_item/{id}', 'InventoryController@pending_item');
Route::post('/update_item', 'InventoryController@update_item');
Route::get('/sellers_lists', 'InventoryController@sellers_lists');
Route::post('/sellers_add', 'InventoryController@sellers_add');
Route::get('/deactivate_seller/{id}', 'InventoryController@deactivate_seller');
Route::get('/activate_seller/{id}', 'InventoryController@activate_seller');
Route::get('/edit_seller/{id}', 'InventoryController@edit_seller');
Route::get('/buyers_lists', 'InventoryController@buyers_lists');
Route::get('/activation', 'MyController@activation');
Route::post('/activate_system', 'MyController@activate_system');
Route::get('/maintenance_schedule', 'InventoryController@maintenance_schedule');
Route::post('/maintenance_add', 'InventoryController@maintenance_add');

//dropping
Route::get('/identifier_add', 'InventoryController@identifier_add');
Route::get('/identifier_delete/{id}', 'InventoryController@identifier_delete');
Route::get('/identifier_lists', 'InventoryController@identifier_lists');
Route::get('/users_lists', 'InventoryController@users_lists');
Route::get('/users_registration', 'InventoryController@users_registration');
// Route::get('/users_edit/{id}', 'InventoryController@users_edit');
Route::get('/users_edit_password/{id}', 'InventoryController@users_edit_password');
Route::get('/users_resetpassword/{id}', 'InventoryController@users_resetpassword');
Route::get('/users_activate/{id}', 'InventoryController@users_activate');
Route::get('/users_deactivated/{id}', 'InventoryController@users_deactivated');
Route::get('/change_password/{id}', 'InventoryController@change_password');
Route::get('/change_information/{id}', 'InventoryController@change_information');
Route::post('users_edit_password/set_overtime', 'InventoryController@set_overtime');

//travelorder
Route::get('/travel_registration', 'InventoryController@travel_registration');
Route::post('/travel_registration_process', 'InventoryController@travel_registration_process');
Route::get('/travel_lists', 'InventoryController@travel_lists');
Route::get('/travel_edit/{id}', 'InventoryController@travel_edit');
Route::post('/travel_edit/travel_edit_process', 'InventoryController@travel_edit_process');
Route::post('/user_reg', 'InventoryController@user_reg');
Route::get('/travel_filter', 'InventoryController@travel_filter');
Route::post('/announcement_reg', 'InventoryController@announcement_reg');
Route::post('/submit_evaluation', 'InventoryController@submit_evaluation');
Route::post('/classwork_reg', 'InventoryController@classwork_reg');
Route::get('/classwork_detail/{id}', 'InventoryController@classwork_detail');

//dtr
Route::get('/logbook', 'InventoryController@logbook');
Route::get('/announcement', 'InventoryController@announcement');
Route::get('/classwork', 'InventoryController@classwork');
Route::get('/evaluation', 'InventoryController@evaluation');
Route::post('/dtr_process', 'InventoryController@dtr_process');
Route::get('/dtr_lists', 'InventoryController@dtr_lists');
Route::get('/dtr_filter', 'InventoryController@dtr_filter');
Route::get('/dtr_print/{id}', 'InventoryController@dtr_print');

//Firebase
Route::get('/firebase/{username}/{password}', 'FirebaseController@index');
Route::get('/fetch_attendance/{name}', 'FirebaseController@fetchUserAttendance');
Route::get('/store_attendance/{data}', 'FirebaseController@storeAttendance');
Route::get('/fetch_all_attendance', 'FirebaseController@fetchAllAttendance');
Route::get('/change_password/{id}/{old_password}/{new_password}', 'FirebaseController@changePassword');
Route::get('/verifier/{id}/{old_password}', 'FirebaseController@verifier');

//file upload dropzone
Route::post('image/upload/store','InventoryController@fileStore');
Route::post('image/delete','InventoryController@fileDestroy');
Route::get('delete_single_file/{filename}','InventoryController@delete_single_file');
Route::post('add_remarks','InventoryController@add_remarks');

Route::post('classwork_detail/image/upload/classwork','InventoryController@fileStoreClasswork');
Route::post('classwork_detail/image/delete/classwork','InventoryController@fileDestroyClasswork');
Route::get('classwork_detail/delete_single_file/{filename}/{classwork_id}','InventoryController@delete_single_file_classwork');

//revisions upload
Route::post('revisions/upload/store','InventoryController@revisionsStore');
Route::post('revisions/delete','InventoryController@revisionsDestroy');

//livechat
Route::get('livechat_view','InventoryController@livechat_view');
Route::get('livechat_form','InventoryController@livechat_form');
Route::post('livechat_form_submit','InventoryController@livechat_form_submit')->name('livechat_form_submit.action');
Route::post('profile_picture_form','InventoryController@profile_picture_form')->name('profile_picture_form.action');

//definition
Route::get('change/{id}/{date}/{accomplishment}','InventoryController@change');

//overtime and holidays
Route::get('overtime_request','InventoryController@overtime_request');
Route::post('/overtime_request_process', 'InventoryController@overtime_request_process');
Route::get('overtime_request_delete/{id}', 'InventoryController@overtime_request_delete');
Route::get('overtime_request_approve/{id}/{id2}/{ot_start}/{ot_end}', 'InventoryController@overtime_request_approve');
Route::get('overtime_request_decline/{id}', 'InventoryController@overtime_request_decline');
Route::get('overtime_request_pending/{id}/{id2}', 'InventoryController@overtime_request_pending');

Route::get('holidays','InventoryController@holidays');
Route::post('/holidays_process', 'InventoryController@holidays_process');
Route::get('holidays/{id}', 'InventoryController@holidays_delete');

Route::get('change_mis', 'InventoryController@change_mis');
Route::post('change_mis_password', 'InventoryController@change_mis_password');
Route::post('change_mis_process', 'InventoryController@change_mis_process');

///excel
Route::get('export', 'InventoryController@export')->name('export');

Route::get('datatable_sample', 'InventoryController@datatable_sample')->name('datatable_sample');
// Route::get('importExportView', 'MyController@importExportView');
// Route::post('import', 'MyController@import')->name('import');
// asdasd