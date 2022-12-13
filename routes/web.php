<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin/trash/{{trash}}', 'MailboxController@index_detail');
Route::get('404', 'HomeController@pagenotfound');
Route::get('/', function () {
    return view('welcome');
});
// Route::get('pagenotfound', ['as'=>'notfound','uses'=>'HomeController@pagenotfound']);
Route::get('/test', function () {
    event(new App\Events\MyEvent('1'));
    return redirect('user_dashboard');
});


Auth::routes();

	Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['is_admin']], function(){
		Route::get('attendances/{attendances}/detail', 'AttendancesController@detail');
		Route::get('attendances/{attendances}/detailemploye', 'AttendancesController@detailemployee');
		
		Route::get('attendances/my/{my}', 'AttendancesController@mydetail');
		Route::get('attendances/updatetimeout/{my}', 'AttendancesController@updatetimeout');
		
		Route::resource('attendances', 'AttendancesController');
        
        Route::get('/attendances/create/{create}', 'AttendancesController@create');

		Route::get('employees/{employees}/detail', 'EmployeesController@detail');
		Route::put('employees/{employees}/status', 'EmployeesController@status');
		Route::resource('employees', 'EmployeesController');

		Route::put('departments/{departments}/status', 'DepartmentsController@status');
		Route::resource('departments', 'DepartmentsController');

		Route::put('timeschedules/{timeschedules}/status', 'TimeSchedulesController@status');
		Route::resource('timeschedules', 'TimeSchedulesController');

		Route::put('shifts/{shifts}/status', 'ShiftsController@status');
		Route::resource('shifts', 'ShiftsController');

		Route::put('breaktimes/{breaktimes}/status', 'BreakTimesController@status');
		Route::resource('breaktimes', 'BreakTimesController');

		Route::get('/leavesupdate_status', 'LeavesController@leavesupdate_status');
		Route::get('leaves/{leaves}/detail', 'LeavesController@detail');
		Route::put('leaves/{leaves}/status', 'LeavesController@status');
		Route::get('leaves/create/{leaves}', 'LeavesController@create');
		Route::get('leaves/{leaves}', 'LeavesController@index');
		Route::resource('leaves', 'LeavesController');

		Route::resource('profile', 'HomeController');

		Route::put('/view/{view}', 'DashboardController@view');
		Route::get('/get', 'DashboardController@get');
		
		Route::post('image/upload/store','DashboardController@fileStore');
		Route::post('image/delete','DashboardController@fileDestroy');
		Route::get('dashboard', 'DashboardController@index');
		Route::get('/mailbox/{id}/index_detail', 'MailboxController@index_detail');
		Route::get('/mailbox/{id}/sent_detail', 'MailboxController@sent_detail');
		Route::get('mailbox/{mailbox}/forward', 'MailboxController@forward');
		Route::post('mailbox/{mailbox}/forward_store', 'MailboxController@forward_store');
		Route::post('/mailbox/farward', 'MailboxController@farward');
		// for mails view
		Route::delete('trashfalse', 'MailboxController@trashfalse');
		// Route::delete('trashtrue', 'MailboxController@trashtrue');
		
		Route::get('mailbox/sent', 'MailboxController@index');
		Route::get('mailbox/trash', 'MailboxController@index');
		Route::put('mailbox/{mailbox}/status', 'MailboxController@status');
		Route::resource('mailbox', 'MailboxController');
		Route::get('/mailbox/create', 'MailboxController@index');
		Route::get('taskdetail/{id}', 'TaskController@detail');
		Route::get('taskedit/{id}', 'TaskController@edit');
		Route::put('taskupdate/{id}', 'TaskController@taskupdate');
		Route::get('taskdelete/{id}', 'TaskController@taskdelete');
		Route::get('/task/status', 'TaskController@update');
		Route::get('/task', 'TaskController@index');

		Route::get('deletemail/{deletemail}', 'MailboxController@mail_delete');
		Route::get('deletsentemail/{deletsentemail}', 'MailboxController@deletsentemail');
		Route::get('fetchmail', 'MailboxController@fetchmail');
		Route::get('/taskupdate_status', 'TaskController@statusupdate');
		Route::get('/mailupdate_status', 'MailboxController@mailupdate_status');
		Route::get('/replyupdate_status', 'MailboxController@replyupdate_status');
		Route::post('/mailbox/reply', 'MailboxController@reply');
	});
		Route::post('/admin/leavefetch','Admin\LeavesController@leavefetch');
		Route::post('/userleavefetch','UserLeaveController@leavefetch');
		// Route::post('/admin/fetch','Admin\TaskController@fetch');
		Route::get('/admin/update_fetch','Admin\TaskController@update_fetch');
		Route::get('/admin/taskupdate','Admin\TaskController@taskupdate');
		Route::get('/admin/fetchtask','Admin\TaskController@fetchtask');
		Route::get('/task/status', 'TaskController@update');
		Route::post('/admin/task', 'Admin\TaskController@store');
		Route::get('/taskupdate_status', 'TaskController@statusupdate');
		Route::get('/mailupdate_status', 'MailboxController@mailupdate_status');

		Route::get('change_password', 'Auth\ChangePasswordController@index')->name('change.password');
		Route::post('change_password/update', 'Auth\ChangePasswordController@ChangePassword')->name('update.password');
		Route::delete('myproducts/{id}', 'MailboxController@destroyy');
		Route::delete('trashfalse', 'MailboxController@trashfalse');
		Route::delete('delete_trash_all', 'MailboxController@delete_trash_all');
		Route::delete('trashtrue', 'MailboxController@trashtrue');
		Route::delete('senttrashtrue', 'MailboxController@senttrashtrue');
		Route::delete('UnduAll', 'MailboxController@unduAll');
		Route::get('/mail_notification', 'MailboxController@mail_notification');
		Route::get('/search', 'MailboxController@fetch');


		// Route::get('/admin/mailbox/{id}/index_detail', 'MailboxController@index_detail');


		Route::group(['middleware' => ['is_user']], function(){

			Route::get('/admin/mailbox/{mailbox}/forward', 'MailboxController@forward');
			Route::post('/admin/mailbox/{mailbox}/forward_store', 'MailboxController@forward_store');
			Route::get('user_attendance/{employee_id}', 'UserAttendanceController@index');
			Route::get('user_attendance/create/{employee_id}', 'UserAttendanceController@create');
			Route::post('user_attendance/store/{employee_id}', 'UserAttendanceController@store');
			Route::get('user_attendance/{id}/edit', 'UserAttendanceController@edit');
			Route::put('user_attendance/{id}/update', 'UserAttendanceController@update')->name('update.attendance');
			Route::delete('user_attendance/{employee_id}', 'UserAttendanceController@destroy');
			Route::post('/mailbox/reply', 'MailboxController@reply');

			/*USER LEAVE ROUTE*/
			Route::get('user_leave/{employee_id}', 'UserLeaveController@index');
			Route::get('user_leave/create/{employee_id}', 'UserLeaveController@create');
			Route::post('user_leave/store/{employee_id}', 'UserLeaveController@store');
			Route::get('user_leave/{user_leave}/edit', 'UserLeaveController@edit');
			Route::put('user_leave/{user_leave}', 'UserLeaveController@update');
			Route::delete('user_leave/{user_leave}', 'UserLeaveController@destroy');
			Route::get('user_leave/{leaves}/detail', 'UserLeaveController@detail');
			Route::get('/leavesupdate_status', 'UserLeaveController@leavesupdate_status');

			Route::get('deletemail/{deletemail}', 'MailboxController@mail_delete');
			Route::get('/mailbox/{id}/index_detail', 'MailboxController@index_detail');
			Route::get('/mailbox/{id}/sent_detail', 'MailboxController@sent_detail');
			Route::get('/mailbox/{id}/trash_detail', 'MailboxController@trash_detail');
			Route::delete('/mailbox/sent_delete/{id}', 'MailboxController@destroy_mailsent')->name('sent.delete');
			Route::post('/mailbox/farward', 'MailboxController@farward');
			Route::get('deletsentemail/{deletsentemail}', 'MailboxController@deletsentemail');
			Route::get('/task', 'TaskController@index');
			Route::get('/data', 'MailboxController@data');

			// for mails view
			Route::get('/mailbox/sent', 'MailboxController@index');
			Route::get('/mailbox/trash', 'MailboxController@index');
			Route::get('/mailbox', 'MailboxController@index');
			Route::get('/mailbox/create', 'MailboxController@index');
			Route::post('/mailbox/store', 'MailboxController@store');
			Route::put('/mailbox/{mailbox}/status', 'MailboxController@index');
			// Route::resource('/mailbox', 'MailboxController');

			/*USER PROFILE*/
			Route::get('user_profile', 'HomeController@profile');
			Route::get('user_profile/{user_profile}/edit', 'HomeController@edit');
			Route::put('user_profile/{user_profile}', 'HomeController@update');
			Route::put('/view/{view}', 'UserLeaveController@view');

			Route::get('user_dashboard', 'HomeController@index');
		});




// Route::get('/fetch','UserLeaveController@notification');