<?php

use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImageFileController;
use App\Http\Controllers\LeadCategoryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioJoinImageFileController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user',UserController::class);
Route::resource('client',ClientController::class);
Route::resource('portfolio_category',PortfolioCategoryController::class);
Route::resource('portfolio',PortfolioController::class);
Route::resource('team_member',TeamMemberController::class);
Route::resource('image_file',ImageFileController::class);
Route::resource('portfolio_join_image_files',PortfolioJoinImageFileController::class);
Route::resource('lead_category',LeadCategoryController::class);
Route::resource('lead',LeadController::class);
Route::resource('feedback',FeedbackController::class);
Route::resource('faq',FaqController::class);
Route::post('register', [ConsumerController::class,'register']);
Route::post('login', [ConsumerController::class,'login']);
Route::post('logout', [ConsumerController::class,'logout']);
Route::post('refresh', [ConsumerController::class,'refresh']);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





