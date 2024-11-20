<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Organization\Blog\Blog;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\User\Rate\RateController;
use App\Http\Middleware\CheckWebsiteLinkMiddleware;
use App\Http\Controllers\User\Group\GroupController;
use App\Http\Controllers\User\Stage\StageController;
use App\Http\Controllers\Global\DisabilityController;
use App\Http\Controllers\User\Course\CourseController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserLogoutController;
use App\Http\Controllers\User\Reports\ReportsController;
use App\Http\Controllers\User\Session\SessionController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Auth\UserCheckCodeController;
use App\Http\Controllers\User\Blog\FetchUserBlogController;
use App\Http\Controllers\User\Exam\FetchUserExamController;
use App\Http\Controllers\User\Auth\UserCheckEmailController;
use App\Http\Controllers\User\Contact\UserContactController;
use App\Http\Controllers\User\Profile\UserProfileController;
use App\Http\Controllers\User\Library\FetchLibraryController;
use App\Http\Controllers\User\Attendance\AttendanceController;
use App\Http\Controllers\Global\Live100MSIntegrationController;
use App\Http\Controllers\User\Auth\UserResetPasswordController;
use App\Http\Controllers\User\Auth\UserChangePasswordController;
use App\Http\Controllers\User\Competition\CompetitionController;
use App\Http\Controllers\User\Exam\FetchUserExamResultController;
use App\Http\Controllers\User\Exam\FetchUserExamQuestionController;
use App\Http\Controllers\User\Library\FetchLibraryDetailsController;
use App\Http\Controllers\User\Group\FetchUserSubscriptionGroupController;
use App\Http\Controllers\User\ExamResultAnswer\ExamResultAnswerController;
use App\Http\Controllers\User\Course\FetchUserSubscriptionCourseController;
use App\Http\Controllers\User\LibraryCategory\FetchLibraryCategoryController;

// AUTH
Route::middleware(CheckWebsiteLinkMiddleware::class)->group(function () {
    Route::post('user_register', UserRegisterController::class);
});
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
    //CONTACT
    Route::controller(UserContactController::class)->group(function () {
        Route::post('user_add_contact', 'store');
    });
    //PROFILE
    Route::controller(UserProfileController::class)->group(function () {
        Route::post('show_user_profile', 'show');
        Route::post('update_user_profile', 'update');
    });

    // Attendance end point
    Route::controller(AttendanceController::class)->group(function () {
        Route::post('user_attendance', 'attendance');
        Route::post('fetch_student_attendance', 'fetch_attendance');
        Route::post('user_leave', 'leave');
    });
    //LIVE
    Route::controller(Live100MSIntegrationController::class)->group(function () {
        Route::post('user_join_room',  'join_room');
    });

    // Rate end point
    Route::controller(RateController::class)->group(function () {
        Route::post('user_fetch_rates', 'fetch_rates');
        Route::post('user_add_rate', 'add_rate');
        Route::post('user_fetch_rate_details', 'fetch_rate_details');
        Route::post('user_edit_rate', 'edit_rate');
        Route::post('user_delete_rate', 'delete_rate');
    });
    //REPORTS
    Route::controller(ReportsController::class)->group(function () {
        Route::post('user_fetch_competiton_report', 'competitionReport');
    });
    /**
     * END POINT START
     */
    Route::controller(CompetitionController::class)->group(function () {
        Route::post('user_fetch_competition_details', 'fetch_competition_details');
        Route::post('user_fetch_competitions', 'fetch_competitions');
        Route::post('join_competition' , 'join_competition');
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
