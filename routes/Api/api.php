<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Global\CityController;
use App\Http\Controllers\Global\CountryController;
use App\Http\Controllers\Organization\Blog\BlogController;
use App\Http\Controllers\Organization\Competition\CompetitionController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\ContactController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchBlogController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchHeaderController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchPolicyController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchScreenController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchOpinionController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchPartnerController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchPrivacyController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchServiceController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchStatisticController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchSubHeaderController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchCompetitionController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchCommonQuestionController;
use App\Http\Controllers\Organization\Landingpage\EndPoint\FetchServiceFeatureController;


Route::post('user/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/logout', [AuthController::class, 'logout']);
});
//
// Country Routes

Route::post('fetch_countries', [CountryController::class, 'index'])->name('countries.index');
Route::post('add_country', [CountryController::class, 'store'])->name('countries.store');
Route::post('fetch_country_details', [CountryController::class, 'show'])->name('countries.show');
Route::post('edit_country', [CountryController::class, 'update'])->name('countries.update');
Route::post('delete_country', [CountryController::class, 'destroy'])->name('countries.destroy');


// City Routes

Route::post('fetch_cities', [CityController::class, 'index'])->name('cities.index');
Route::post('add_city', [CityController::class, 'store'])->name('cities.store');
Route::post('fetch_city_details', [CityController::class, 'show'])->name('cities.show');
Route::post('edit_city', [CityController::class, 'update'])->name('cities.update');
Route::post('delete_city', [CityController::class, 'destroy'])->name('cities.destroy');
/**
 * lANDINGPAGE END POINT START
 */

//HEADER
Route::get('landing_page_fetch_headers', FetchHeaderController::class);
//SUB HEADER
Route::get('landing_page_fetch_sub_headers', FetchSubHeaderController::class);
//STATISTIC
Route::get('landing_page_fetch_Statistics', FetchStatisticController::class);
//PARTNER
Route::get('landing_page_fetch_partners', FetchPartnerController::class);
//SERVICE
Route::get('landing_page_fetch_services', FetchServiceController::class);
//SERVICE FEATURE
Route::get('landing_page_fetch_service_features', FetchServiceFeatureController::class);
//OPINION
Route::get('landing_page_fetch_opinions', FetchOpinionController::class);
//SCREEN
Route::get('landing_page_fetch_screens', FetchScreenController::class);
//COMPETITION
Route::controller(FetchCompetitionController::class)->group(function () {
    Route::get('landing_page_fetch_competitions', 'landing_page_fetch_competitions');
    Route::post('landing_page_fetch_competition_details', 'landing_page_fetch_competition_details');
});
//BLOG
Route::controller(FetchBlogController::class)->group(function () {
    Route::get('landing_page_fetch_blogs', 'landing_page_fetch_blogs');
    Route::post('landing_page_fetch_blog_details', 'landing_page_fetch_blog_details');
});

//COMMON QUESTION
Route::get('landing_page_fetch_common_questions', FetchCommonQuestionController::class);
//PRIVACY
Route::get('landing_page_fetch_privacy', FetchPrivacyController::class);
//POLICY
Route::get('landing_page_fetch_policy', FetchPolicyController::class);

// contact

Route::post('landing_page_add_contact', [ContactController::class, 'landing_page_add_contact']);
/**
 * lANDINGPAGE END POINT END
 */
