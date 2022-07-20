<?php

// Route::get('/abc', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/', 'OjtController@logbook');
Route::resource('/store', 'OjtController');
Route::get('/dashboard', 'OjtController@dashboard');

//dropping
Route::get('/identifier_add', 'OjtController@identifier_add');
Route::get('/identifier_delete/{id}', 'OjtController@identifier_delete');
Route::get('/identifier_lists', 'OjtController@identifier_lists');
Route::get('/users_lists', 'OjtController@users_lists');
Route::get('/users_registration', 'OjtController@users_registration');
Route::get('/students_registration', 'OjtController@users_registration');

// Route::get('/users_edit/{id}', 'OjtController@users_edit');
Route::get('/users_edit_password/{id}', 'OjtController@users_edit_password');
Route::get('/users_resetpassword/{id}', 'OjtController@users_resetpassword');
Route::get('/users_activate/{id}', 'OjtController@users_activate');
Route::get('/users_deactivated/{id}', 'OjtController@users_deactivated');
Route::get('/change_password/{id}', 'OjtController@change_password');
Route::get('/change_information/{id}', 'OjtController@change_information');
Route::post('users_edit_password/set_overtime', 'OjtController@set_overtime');

Route::post('/user_reg', 'OjtController@user_reg');
Route::post('/announcement_reg', 'OjtController@announcement_reg');
Route::post('/submit_evaluation', 'OjtController@submit_evaluation');
Route::post('/classwork_reg', 'OjtController@classwork_reg');
Route::get('/classwork_detail/{id}', 'OjtController@classwork_detail');

//dtr
Route::get('/logbook', 'OjtController@logbook');
Route::get('/solution', 'OjtController@solution');
Route::get('/announcement', 'OjtController@announcement');
Route::get('/classwork', 'OjtController@classwork');
Route::get('/evaluation', 'OjtController@evaluation');
Route::post('/dtr_process', 'OjtController@dtr_process');
Route::get('/dtr_lists', 'OjtController@dtr_lists');
Route::get('/dtr_filter', 'OjtController@dtr_filter');
Route::get('/dtr_print/{id}', 'OjtController@dtr_print');

Route::post('profile_picture_form','OjtController@profile_picture_form')->name('profile_picture_form.action');

Route::get('/logbook', 'OjtController@logbook')->name('show_logbook');

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