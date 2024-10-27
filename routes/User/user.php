<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Group\GroupController;
use App\Http\Controllers\User\Stage\StageController;
use App\Http\Controllers\Global\DisabilityController;
use App\Http\Controllers\User\Course\CourseController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserLogoutController;
use App\Http\Controllers\User\Session\SessionController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Auth\UserCheckCodeController;
use App\Http\Controllers\User\Blog\FetchUserBlogController;
use App\Http\Controllers\User\Exam\FetchUserExamController;
use App\Http\Controllers\User\Auth\UserCheckEmailController;
use App\Http\Controllers\User\Library\FetchLibraryController;
use App\Http\Controllers\User\Auth\UserResetPasswordController;
use App\Http\Controllers\User\Auth\UserChangePasswordController;
use App\Http\Controllers\User\Competition\CompetitionController;
use App\Http\Controllers\User\Exam\FetchUserExamResultController;
use App\Http\Controllers\User\Subscription\SubscriptionController;
use App\Http\Controllers\User\Exam\FetchUserExamQuestionController;
use App\Http\Controllers\User\Library\FetchLibraryDetailsController;
use App\Http\Controllers\User\Group\FetchUserSubscriptionGroupController;
use App\Http\Controllers\User\ExamResultAnswer\ExamResultAnswerController;
use App\Http\Controllers\User\Course\FetchUserSubscriptionCourseController;
use App\Http\Controllers\User\LibraryCategory\FetchLibraryCategoryController;
use App\Http\Controllers\User\Library\LibraryController as UserLibraryController;

// AUTH
Route::post('user_register', UserRegisterController::class);
Route::post('user_login', UserLoginController::class)->name('user_login');
Route::post('user_reset_password', UserResetPasswordController::class);
Route::post('user_check_code', UserCheckCodeController::class);
Route::post('user_check_email', UserCheckEmailController::class);
Route::get('user_fetch_disabilities', [DisabilityController::class, 'fetch_disabilities']);
Route::middleware('auth:user')->group(function () {
    // AUTH
    Route::post('user_logout', UserLogoutController::class);
    Route::post('user_change_password', UserChangePasswordController::class);

    //EXAM RESULT ANSWER
    Route::controller(ExamResultAnswerController::class)->group(function () {
        Route::post('add_exam_result_answer', 'store');
        Route::post('fetch_exam_result_answers', 'fetchExamResultAnswers');
    });
    /**
     * END POINT START
     */
    Route::controller(CompetitionController::class)->group(function () {
        Route::post('user_fetch_competition_details', 'fetch_competition_details');
        Route::post('user_fetch_competitions', 'fetch_competitions');
    });
    Route::post('user_fetch_courses', [CourseController::class, 'fetch_courses']);
    Route::post('user_fetch_groups', [GroupController::class, 'fetch_groups']);
    Route::post('user_fetch_stages', [StageController::class, 'fetch_stages']);
    Route::post('user_fetch_sessions', [SessionController::class, 'fetch_sessions']);
    //SUBSCRIPTION GROUP
    Route::post('fetch_user_subscription_group', FetchUserSubscriptionGroupController::class);
    //SUBSCRIPTION COURSE
    Route::post('fetch_user_subscription_course', FetchUserSubscriptionCourseController::class);
    //EXAM QUESTION
    Route::post('fetch_user_exam_questions', FetchUserExamQuestionController::class);
    //EXAM RESULT
    Route::post('fetch_user_exam_result', [FetchUserExamResultController::class, "fetchUserExamResult"]);
    Route::post('fetch_user_exam_results', [FetchUserExamResultController::class, "fetchUserExamResults"]);
    //LIBRARY CATEGORY
    Route::post('fetch_user_library_categories', [FetchLibraryCategoryController::class, "fetchLibraryCategory"]);
    //LIBRARY
    Route::post('fetch_user_library_by_category_id', [FetchLibraryController::class, "fetchLibraryByCategoryId"]);
    Route::post('user_fetch_library_details', [FetchLibraryDetailsController::class, "show"]);

    //EXAM
    Route::post('fetch_user_exams', FetchUserExamController::class);
    // //BLOG
    Route::controller(FetchUserBlogController::class)->group(function () {
        Route::post('user_fetch_blogs', 'fetchBlogs');
        Route::post('user_fetch_blog_details', 'fetchBlogDetails');
    });
    /**
     * END POINT END
     */
});
