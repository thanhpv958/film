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

Route::get('/', 'HomeController@index');

Route::prefix('admin')->middleware('CheckRole')->group(function () {
    Route::get('/', 'HomeController@indexAdmin');

    Route::resource('theaters', 'TheaterController')->except(['show']);
    Route::resource('ticketprices', 'TicketPriceController')->except(['show']);
    Route::resource('rooms', 'RoomController')->except(['show']);
    Route::resource('films', 'FilmController')->except(['show']);
    Route::resource('comments', 'CommentController');
    Route::resource('calendars', 'CalendarController')->except(['show']);
    Route::resource('news', 'NewsController');
    Route::get('stafs', 'UserController@showStaf');
    Route::get('customers', 'UserController@showCustomer');
    Route::resource('users', 'UserController');
    Route::resource('user-tickets', 'UserTicketController');

    //ajax
    Route::get('calendars/ajaxRoom/{theater_id}', 'CalendarController@ajaxRoom');
});

Route::get('theaters', 'TheaterController@show');
Route::get('ajaxTheater/{id}', 'TheaterController@ajaxShow');

//Calendar
Route::get('calendars/{id}', 'CalendarController@show');
Route::get('ajaxCalendar/{id}', 'CalendarController@ajaxShow');

//news
Route::get('news', 'NewsController@news')->name('news');
Route::get('news-detail/{id}', 'NewsController@newsDetail')->name('newsDetail');

//promotions
Route::get('promotions', 'NewsController@promotions')->name('promotions');
Route::get('promotion-detail/{id}', 'NewsController@promotionDetail')->name('promotionDetail');
Route::get('theater', 'TheaterController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('booking-tickets/{calTime}', 'BookingController@getBookTicket')->middleware('login');
Route::get('booking-ticketsBooked/{calTime}', 'BookingController@getSeatBooked')->middleware('login');
Route::post('booking-tickets/{calTime}', 'BookingController@postBookTicket');

//Route::get('user', 'UserController@user')->name('user');
Route::get('user/{id}', 'UserController@getPageEditUser')->middleware('ViewUserPage')->name('user');
Route::put('user/{id}', 'UserController@postPageEditUser');

//comment
Route::delete('commentsDelPage/{id}', 'CommentController@destroyPage');
