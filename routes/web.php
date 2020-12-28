<?php
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

Route::get('/', 'HomeController@index')->name('home');


Auth::routes();
Route::get('posts','PostController@index')->name('all.posts');
Route::get('post/{slug}','PostController@details')->name('post.details');
Route::Post('/subcriber','SubscriberController@store')->name('subscriber');

Route::group(['middleware' => ['auth']], function () {
    Route::post('favourite/{post}/add','FavouriteController@add' )->name('post.favourite');
    Route::post('comment/{post}','CommentController@store' )->name('comment.store');
});

Route::group(['as'=>'admin.', 'prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('setting','SettingsController@index')->name('setting');
        Route::put('profile-update','SettingsController@ProfileUpdate')->name('profile.update');
        Route::put('password-update','SettingsController@PasswordUpdate')->name('password.update');
        Route::resource('tag', 'TagController');
        Route::resource('category', 'CategoryController');
        Route::resource('post','PostController');
        Route::put('post/{id}/approve', 'PostController@approve' )->name('post.approve');
        Route::get('pending/post', 'PostController@pending' )->name('pending.post');
         Route::get('favourite','FavouriteController@index')->name('favourite.post');
         Route::get('comments','CommentController@index')->name('comment.index');
         Route::delete('comments/{id}','CommentController@destroy' )->name('comment.destroy');
        Route::get('subscribers','SubscriberController@index')->name('subscriber.index');
        Route::delete('subscribers/{id}','SubscriberController@destroy')->name('subscriber.destroy');
      
});
Route::group(['as'=>'author.', 'prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('setting','SettingController@index')->name('setting');
        Route::put('profile-update','SettingController@ProfileUpdate')->name('profile.update');
        Route::put('password-update','SettingController@PasswordUpdate')->name('password.update');
        Route::get('favourite','FavouriteController@index')->name('favourite.post');
        Route::resource('post','PostController');


});