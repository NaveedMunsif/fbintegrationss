<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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




Route::get('/our-privacy-policy', function () {
    return view('privacy_policy');
})->name('privacy_policy');


Auth::routes();

Route::group(['middleware' => ['auth', 'forSetting']], function () {

    Route::get('/', 'GraphController@retrievePageInsight')->name('home');
    Route::get('/home', 'GraphController@retrievePageInsight')->name('home');
    Route::resource('post', 'PostController');

});
Route::middleware('auth')->group(function () {
    Route::get('/setting', function () {
        return view('profile.setting');
    })->name('setting');

    Route::get('/notes', function () {
        return view('notes');
    })->name('notes');
    Route::resource('profile', ProfileController::class);
    Route::post('/getall', 'PostController@getall')->name('getall');
    Route::post('/getmodal', 'PostController@getmodal')->name('getmodal');

     Route::get('profile-view', 'ProfileController@index')->name('profileview');
    Route::get('/facebook', 'ProfileController@redirectToFacebookProvider')->name('facebook');
    Route::get('facebook/callback', 'ProfileController@handleProviderFacebookCallback');
    Route::post('facebook_page_id', 'GraphController@facebook_page_id')->name('facebook_page_id');


    //NOTES SAVE
    Route::get('addnote', 'AdminController@addnote')->name('addnote');
    Route::get('getnotes', 'AdminController@getnotes')->name('getnotes');

    //DELETE A NOTES
    Route::get('delete/{id}', 'AdminController@delete')->name('delete');


    Route::get('/userprofiles/{id}' , 'AdminController@alluserprofiles')->name('userprofiles');

    Route::get('alluserlist', 'AdminController@alluserlist')->name('alluserlist');

    Route::post('pagecategory', 'AdminController@pagecategory')->name('pagecategory');

    Route::post('companyname', 'ProfileController@companyname')->name('companyname');
    Route::get('admin_home', 'AdminController@adminhome')->name('admin_home');

    Route::post('page', 'GraphController@publishToPage')->name('page');
    Route::post('/delete/post', 'GraphController@postDelete')->name('post.delete');

    //Admin add, new user

    Route::post('/add new user', 'AdminController@addnewuser')->name('add_new_user');
    Route::get('/user-view', 'AdminController@userView')->name('user_view');
    Route::get('/user-edit', 'AdminController@userEdit')->name('user_edit');
    Route::get('/user-delete-list', 'AdminController@deletedUserList')->name('deletedUserList');
});


