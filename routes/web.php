<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

Route::get('register', [AuthController::class,'register_page'])->name('register');
Route::post('register', [AuthController::class,'register'])->name('register');
Route::get('login', [AuthController::class,'login_page'])->name('login');
Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('logout', [AuthController::class,'logout'])->name('logout');

Route::get('profile', [AuthController::class,'profile'])->name('profile');
Route::post('profile', [AuthController::class,'update_profile']);


Route::get('/',[HomepageController::class,'index'])->name('home');

//For authenticated users
Route::middleware('auth')->group(function() 
{
  //List all urls
  Route::get('/urls',[UrlController::class,'index'])->name('urls');
//view individual urls
Route::get('/urls/view/{id}',[UrlController::class,'review'])->name('urls.review');
//Create a new url
Route::get('/urls/create',[UrlController::class,'create'])->name('urls.create');
//Store a new url
Route::post('/urls/create',[UrlController::class,'store']);
//Edit existing Url
Route::get('/urls/edit/{id}',[UrlController::class,'edit'])->name('hi');
//Update existing url
Route::post('/urls/edit/{id}',[UrlController::class,'update']) ;

Route::post('/urls/delete/{id}',[UrlController::class,'delete'])->name('urls.delete');
});

//Routes for short urls
Route::get('/{short_url}',[UrlController::class, 'redirect']);

//File upload
Route::get('upload-file',[HomepageController::class],'upload_file')->name('hs');
Route::post('upload-file',[HomepageController::class],'upload');
// Route::get('upload',function(){
//   return view('file');
// });














// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/contact',[HomepageController::class,'contact']);

//Grouping Routes
// Route::prefix('blog')->group(function () {   
// });
// Route::group(['prefix'=>'blog'],function(){
// });

// Route::middleware('test')->get('/contact', function(){
//     return view('contact');
// });

// Route::middleware('test')->get('urls', function(){
//     return view('urls');
// });

// Route::middleware('test')->get('/middleware-test',function(){
//     return 'hey';

// }); 

