<?php

// Route::get('/abc', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/', 'OjtController@logbook');
Route::resource('/store', 'OjtController');
Route::get('/dashboard', 'OjtController@dashboard');
Route::get('/inventory_lists', 'OjtController@inventory_lists');
Route::get('/inventory_registration', 'OjtController@inventory_registration');
Route::get('/inventory_edit/{id}', 'OjtController@inventory_edit');
Route::get('/inventory_acc_edit/{id}', 'OjtController@inventory_acc_edit');
Route::post('/inventory_acc_update/{id}', 'OjtController@inventory_acc_update');
Route::get('/inventory_par_edit/{id}', 'OjtController@inventory_par_edit');
Route::post('/inventory_par_update/{id}', 'OjtController@inventory_par_update');
//dropping
Route::get('/inventory_export_excel', 'OjtController@inventory_export_excel');
Route::get('/search_items', 'OjtController@search_items');
Route::post('/multi_release_item', 'OjtController@multi_release_item');
Route::get('/release_item/{id}', 'OjtController@release_item');
Route::get('/qrcode/{id}', 'OjtController@qrcode');
Route::get('/cashedout_item/{id}', 'OjtController@cashedout_item');
Route::get('/cashedout_all_item/{id}', 'OjtController@cashedout_all_item');
Route::get('/cancel_item/{id}', 'OjtController@cancel_item');
Route::get('/pending_item/{id}', 'OjtController@pending_item');
Route::post('/update_item', 'OjtController@update_item');
Route::get('/sellers_lists', 'OjtController@sellers_lists');
Route::post('/sellers_add', 'OjtController@sellers_add');
Route::get('/deactivate_seller/{id}', 'OjtController@deactivate_seller');
Route::get('/activate_seller/{id}', 'OjtController@activate_seller');
Route::get('/edit_seller/{id}', 'OjtController@edit_seller');
Route::get('/buyers_lists', 'OjtController@buyers_lists');
Route::get('/activation', 'MyController@activation');
Route::post('/activate_system', 'MyController@activate_system');
Route::get('/maintenance_schedule', 'OjtController@maintenance_schedule');
Route::post('/maintenance_add', 'OjtController@maintenance_add');

//dropping
Route::get('/identifier_add', 'OjtController@identifier_add');
Route::get('/identifier_delete/{id}', 'OjtController@identifier_delete');
Route::get('/identifier_lists', 'OjtController@identifier_lists');
Route::get('/users_lists', 'OjtController@users_lists');
Route::get('/users_registration', 'OjtController@users_registration');
// Route::get('/users_edit/{id}', 'OjtController@users_edit');
Route::get('/users_edit_password/{id}', 'OjtController@users_edit_password');
Route::get('/users_resetpassword/{id}', 'OjtController@users_resetpassword');
Route::get('/users_activate/{id}', 'OjtController@users_activate');
Route::get('/users_deactivated/{id}', 'OjtController@users_deactivated');
Route::get('/change_password/{id}', 'OjtController@change_password');
Route::get('/change_information/{id}', 'OjtController@change_information');
Route::post('users_edit_password/set_overtime', 'OjtController@set_overtime');

//travelorder
Route::get('/travel_registration', 'OjtController@travel_registration');
Route::post('/travel_registration_process', 'OjtController@travel_registration_process');
Route::get('/travel_lists', 'OjtController@travel_lists');
Route::get('/travel_edit/{id}', 'OjtController@travel_edit');
Route::post('/travel_edit/travel_edit_process', 'OjtController@travel_edit_process');
Route::post('/user_reg', 'OjtController@user_reg');
Route::get('/travel_filter', 'OjtController@travel_filter');
Route::post('/announcement_reg', 'OjtController@announcement_reg');
Route::post('/submit_evaluation', 'OjtController@submit_evaluation');
Route::post('/classwork_reg', 'OjtController@classwork_reg');
Route::get('/classwork_detail/{id}', 'OjtController@classwork_detail');

//dtr
Route::get('/logbook', 'OjtController@logbook');
Route::get('/announcement', 'OjtController@announcement');
Route::get('/classwork', 'OjtController@classwork');
Route::get('/evaluation', 'OjtController@evaluation');
Route::post('/dtr_process', 'OjtController@dtr_process');
Route::get('/dtr_lists', 'OjtController@dtr_lists');
Route::get('/dtr_filter', 'OjtController@dtr_filter');
Route::get('/dtr_print/{id}', 'OjtController@dtr_print');

//Firebase
Route::get('/firebase/{username}/{password}', 'FirebaseController@index');
Route::get('/fetch_attendance/{name}', 'FirebaseController@fetchUserAttendance');
Route::get('/store_attendance/{data}', 'FirebaseController@storeAttendance');
Route::get('/fetch_all_attendance', 'FirebaseController@fetchAllAttendance');
Route::get('/change_password/{id}/{old_password}/{new_password}', 'FirebaseController@changePassword');
Route::get('/verifier/{id}/{old_password}', 'FirebaseController@verifier');

//file upload dropzone
Route::post('image/upload/store','OjtController@fileStore');
Route::post('image/delete','OjtController@fileDestroy');
Route::get('delete_single_file/{filename}','OjtController@delete_single_file');
Route::post('add_remarks','OjtController@add_remarks');

Route::post('classwork_detail/image/upload/classwork','OjtController@fileStoreClasswork');
Route::post('classwork_detail/image/delete/classwork','OjtController@fileDestroyClasswork');
Route::get('classwork_detail/delete_single_file/{filename}/{classwork_id}','OjtController@delete_single_file_classwork');

//revisions upload
Route::post('revisions/upload/store','OjtController@revisionsStore');
Route::post('revisions/delete','OjtController@revisionsDestroy');

//livechat
Route::get('livechat_view','OjtController@livechat_view');
Route::get('livechat_form','OjtController@livechat_form');
Route::post('livechat_form_submit','OjtController@livechat_form_submit')->name('livechat_form_submit.action');
Route::post('profile_picture_form','OjtController@profile_picture_form')->name('profile_picture_form.action');

//definition
Route::get('change/{id}/{date}/{accomplishment}','OjtController@change');

//overtime and holidays
Route::get('overtime_request','OjtController@overtime_request');
Route::post('/overtime_request_process', 'OjtController@overtime_request_process');
Route::get('overtime_request_delete/{id}', 'OjtController@overtime_request_delete');
Route::get('overtime_request_approve/{id}/{id2}/{ot_start}/{ot_end}', 'OjtController@overtime_request_approve');
Route::get('overtime_request_decline/{id}', 'OjtController@overtime_request_decline');
Route::get('overtime_request_pending/{id}/{id2}', 'OjtController@overtime_request_pending');

Route::get('holidays','OjtController@holidays');
Route::post('/holidays_process', 'OjtController@holidays_process');
Route::get('holidays/{id}', 'OjtController@holidays_delete');

Route::get('change_mis', 'OjtController@change_mis');
Route::post('change_mis_password', 'OjtController@change_mis_password');
Route::post('change_mis_process', 'OjtController@change_mis_process');

///excel
Route::get('export', 'OjtController@export')->name('export');

Route::get('datatable_sample', 'OjtController@datatable_sample')->name('datatable_sample');
// Route::get('importExportView', 'MyController@importExportView');
// Route::post('import', 'MyController@import')->name('import');
// asdasd