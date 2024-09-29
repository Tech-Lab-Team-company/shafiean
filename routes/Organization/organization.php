<?php

use Illuminate\Support\Facades\Route;
use App\Models\Organization\Blog\BlogCategory;
use App\Models\Organization\Exam\ExamQuestion;
use App\Http\Controllers\Global\StageController;
use App\Http\Controllers\Global\GlobalController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\DisabilityTypeController;
use App\Http\Controllers\Organization\Auth\AuthController;
use App\Http\Controllers\Organization\Blog\BlogController;
use App\Http\Controllers\Organization\Exam\ExamController;
use App\Http\Controllers\Organization\Term\TermController;
use App\Http\Controllers\Organization\User\UserController;
use App\Http\Controllers\Organization\Group\GroupController;
use App\Http\Controllers\Organization\Answer\AnswerController;
use App\Http\Controllers\Organization\Course\CourseController;
use App\Http\Controllers\Organization\JobType\JobTypeController;
use App\Http\Controllers\Organization\Library\LibraryController;
use App\Http\Controllers\Organization\Teacher\TeacherController;
use App\Http\Controllers\Organization\Blog\BlogHashtagController;
use App\Http\Controllers\Organization\Blog\BlogCategoryController;
use App\Http\Controllers\Organization\Employee\EmployeeController;
use App\Http\Controllers\Organization\Exam\ExamQuestionController;
use App\Http\Controllers\Organization\Question\QuestionController;
use App\Http\Controllers\Organization\Relation\RelationController;
use App\Http\Controllers\Organization\Competition\CompetitionController;
use App\Http\Controllers\Organization\UserRelation\UserRelationController;
use App\Http\Controllers\Organization\Competition\CompetitionRewardController;

//AUTH
Route::controller(AuthController::class)->group(function () {
    Route::post('organization-register', 'register');
    Route::post('organization-login', 'login');
    Route::post('organization-check-email', 'checkEmail');
    Route::post('organization-check-code', 'checkCode');
    Route::post('organization-reset-password', 'resetPassword');
});

Route::middleware('auth:organization')->group(function () {
    // Disability_types Routes

    Route::post('fetch_disabilities', [DisabilityTypeController::class, 'index']);
    Route::post('add_disability', [DisabilityTypeController::class, 'store']);
    Route::post('fetch_disability_details', [DisabilityTypeController::class, 'show']);
    Route::post('edit_disability', [DisabilityTypeController::class, 'update']);
    Route::post('delete_disability', [DisabilityTypeController::class, 'destroy']);
    // Stages Routes
    Route::post('fetch_stages', [StageController::class, 'index']);
    Route::post('add_stage', [StageController::class, 'store']);
    Route::post('fetch_stage_details', [StageController::class, 'show']);
    Route::post('edit_stage', [StageController::class, 'update']);
    Route::post('delete_stage', [StageController::class, 'destroy']);
    Route::post('change_stage_active_status', [StageController::class, 'changeActiveStatus']);
    //EXAM QUESTION
    Route::controller(ExamQuestionController::class)->group(function () {
        Route::post('fetch_exam_questions', 'index');
        Route::post('add_exam_question', 'store');
        Route::post('fetch_exam_question_details', 'show');
        Route::post('edit_exam_question', 'update');
        Route::post('delete_exam_question', 'delete');
    });
    //ANSWER
    Route::controller(AnswerController::class)->group(function () {
        Route::post('fetch_answers', 'index');
        Route::post('add_answer', 'store');
        Route::post('fetch_answer_details', 'show');
        Route::post('edit_answer', 'update');
        Route::post('delete_answer', 'delete');
    });
    //EXAM
    Route::controller(ExamController::class)->group(function () {
        Route::post('fetch_exams', 'index');
        Route::post('add_exam', 'store');
        Route::post('fetch_exam_details', 'show');
        Route::post('edit_exam', 'update');
        Route::post('delete_exam', 'delete');
    });
    //QUESTION
    Route::controller(QuestionController::class)->group(function () {
        Route::post('fetch_questions', 'index');
        Route::post('add_question', 'store');
        Route::post('fetch_question_details', 'show');
        Route::post('edit_question', 'update');
        Route::post('delete_question', 'delete');
    });
    //BLOG
    Route::controller(BlogController::class)->group(function () {
        Route::post('fetch_blogs', 'index');
        Route::post('add_blog', 'store');
        Route::post('fetch_blog_details', 'show');
        Route::post('edit_blog', 'update');
        Route::post('delete_blog', 'delete');
    });
    //BLOG HASHTAG
    Route::controller(BlogHashtagController::class)->group(function () {
        Route::post('fetch_blog_hashtags', 'index');
        Route::post('add_blog_hashtag', 'store');
        Route::post('fetch_blog_hashtag_details', 'show');
        Route::post('edit_blog_hashtag', 'update');
        Route::post('delete_blog_hashtag', 'delete');
    });
    //BLOG CATEGORY
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::post('fetch_blog_categories', 'index');
        Route::post('add_blog_category', 'store');
        Route::post('fetch_blog_category_details', 'show');
        Route::post('edit_blog_category', 'update');
        Route::post('delete_blog_category', 'delete');
    });
    //COMPETITON REWARD
    Route::controller(CompetitionRewardController::class)->group(function () {
        Route::post('fetch_competition_rewards', 'index');
        Route::post('add_competition_reward', 'store');
        Route::post('fetch_competition_reward_details', 'show');
        Route::post('edit_competition_reward', 'update');
        Route::post('delete_competition_reward', 'delete');
    });
    //COMPETITON
    Route::controller(CompetitionController::class)->group(function () {
        Route::post('fetch_competitions', 'index');
        Route::post('add_competition', 'store');
        Route::post('fetch_competition_details', 'show');
        Route::post('edit_competition', 'update');
        Route::post('delete_competition', 'delete');
    });
    //LIBRARY
    Route::controller(LibraryController::class)->group(function () {
        Route::post('fetch_libraries', 'index');
        Route::post('add_library', 'store');
        Route::post('fetch_library_details', 'show');
        Route::post('edit_library', 'update');
        Route::post('delete_library', 'delete');
    });
    //JOB TYPE
    Route::controller(JobTypeController::class)->group(function () {
        Route::post('fetch_job_types', 'index');
        Route::post('add_job_type', 'store');
        Route::post('fetch_job_type_details', 'show');
        Route::post('edit_job_type', 'update');
        Route::post('delete_job_type', 'delete');
    });
    //USER RELATION
    Route::controller(UserRelationController::class)->group(function () {
        Route::post('fetch_user_relations', 'index');
        Route::post('add_user_relation', 'store');
        Route::post('fetch_user_relation_details', 'show');
        Route::post('edit_user_relation', 'update');
        Route::post('delete_user_relation', 'delete');
    });
    //RELATION
    Route::controller(RelationController::class)->group(function () {
        Route::post('fetch_relations', 'index');
        Route::post('add_relation', 'store');
        Route::post('fetch_relation_details', 'show');
        Route::post('edit_relation', 'update');
        Route::post('delete_relation', 'delete');
    });
    //USER
    Route::controller(UserController::class)->group(function () {
        Route::post('fetch_users', 'index');
        Route::post('add_user', 'store');
        Route::post('fetch_user_details', 'show');
        Route::post('edit_user', 'update');
        Route::post('delete_user', 'delete');
    });
    //AUTH
    Route::controller(AuthController::class)->group(function () {
        Route::post('organization-logout', 'logout');
        Route::post('organization-change-password', 'changePassword');
    });
    //EMPLOYEE
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('fetch_employees', 'fetch_employees');
        Route::post('add_employee', 'add_employee');
        Route::post('fetch_employee_details', 'fetch_employee_details');
        Route::post('edit_employee', 'update_employee');
        Route::post('delete_employee', 'delete_employee');
        Route::post('edit_employee_password', 'edit_employee_password');
    });
    //COURSE
    Route::controller(CourseController::class)->group(function () {
        Route::post('fetch_courses', 'fetch_courses');
        Route::post('add_course', 'add_course');
        Route::post('fetch_course_details', 'fetch_course_details');
        Route::post('edit_course', 'edit_course');
        Route::post('delete_course', 'delete_course');
        Route::post('change_course_active_status', 'change_course_active_status');
        Route::post('add_course_stage', 'add_course_stage');
    });
    //GROUP
    Route::controller(GroupController::class)->group(function () {
        Route::post('fetch_groups', 'fetch_groups');
        Route::post('add_group', 'add_group');
        Route::post('fetch_group_details', 'fetch_group_details');
        Route::post('edit_group', 'edit_group');
        Route::post('delete_group', 'delete_group');
        Route::post('change_group_active_status', 'change_group_active_status');
    });
    //CURRICULUM
    Route::controller(CurriculumController::class)->group(function () {
        Route::post('organization_fetch_curriculums',  'index');
    });
});

//GLOBAL
Route::controller(GlobalController::class)->group(function () {
    Route::post('fetch_days',  'fetch_days');
});
//TEACHER
Route::prefix('teachers')->group(function () {
    Route::post('/', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/{id}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::put('/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});
//TERM
Route::prefix('terms')->group(function () {
    Route::get('/', [TermController::class, 'index'])->name('terms.index');
    Route::post('/', [TermController::class, 'store'])->name('terms.store');
    Route::get('/{id}', [TermController::class, 'show'])->name('terms.show');
    Route::put('/{id}', [TermController::class, 'update'])->name('terms.update');
    Route::delete('/{id}', [TermController::class, 'destroy'])->name('terms.destroy');
});
