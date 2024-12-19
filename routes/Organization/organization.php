<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Global\StageController;
use App\Http\Controllers\Global\GlobalController;
use App\Http\Middleware\CheckWebsiteLinkMiddleware;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Global\DisabilityController;
use App\Http\Controllers\Admin\DisabilityTypeController;
use App\Http\Controllers\Organization\Auth\AuthController;
use App\Http\Controllers\Organization\Blog\BlogController;
use App\Http\Controllers\Organization\Exam\ExamController;
use App\Http\Controllers\Organization\Rate\RateController;
use App\Http\Controllers\Organization\User\UserController;
use App\Http\Controllers\Admin\AdminHomeStatisticController;
use App\Http\Controllers\Organization\Group\GroupController;
use App\Http\Controllers\Organization\Surah\SurahController;
use App\Http\Controllers\Organization\Answer\AnswerController;
use App\Http\Controllers\Organization\Course\CourseController;
use App\Http\Controllers\Global\Live100MSIntegrationController;
use App\Http\Controllers\Organization\User\FetchUserController;
use App\Http\Controllers\Organization\Contact\ContactController;
use App\Http\Controllers\Organization\JobType\JobTypeController;
use App\Http\Controllers\Organization\Library\LibraryController;
use App\Http\Controllers\Organization\Reports\ReportsController;
use App\Http\Controllers\Organization\Blog\BlogHashtagController;
use App\Http\Controllers\Organization\Exam\ExamStudentController;
use App\Http\Controllers\Organization\Group\FetchGroupController;
use App\Http\Controllers\Organization\Blog\BlogCategoryController;
use App\Http\Controllers\Organization\Employee\EmployeeController;
use App\Http\Controllers\Organization\Exam\ExamQuestionController;
use App\Http\Controllers\Organization\Question\QuestionController;
use App\Http\Controllers\Organization\Relation\RelationController;
use App\Http\Controllers\User\Subscription\SubscriptionController;
use App\Http\Controllers\Organization\Landingpage\HeaderController;
use App\Http\Controllers\Organization\Landingpage\PolicyController;
use App\Http\Controllers\Organization\Landingpage\ScreenController;
use App\Http\Controllers\Organization\Parent\FetchParentController;
use App\Http\Controllers\Organization\Season\FetchSeasonController;
use App\Http\Controllers\Organization\Landingpage\FeatureController;
use App\Http\Controllers\Organization\Landingpage\OpinionController;
use App\Http\Controllers\Organization\Landingpage\PartnerController;
use App\Http\Controllers\Organization\Landingpage\PrivacyController;
use App\Http\Controllers\Organization\Landingpage\ServiceController;
use App\Http\Controllers\Organization\Country\FetchCountryController;
use App\Http\Controllers\Organization\JobType\FetchJobTypeController;
use App\Http\Controllers\Organization\Student\FetchStudentController;
use App\Http\Controllers\Organization\Attendance\AttendanceController;
use App\Http\Controllers\Organization\Blog\FetchBlogHashtagController;

use App\Http\Controllers\Organization\ExamResult\ExamResultController;

use App\Http\Controllers\Organization\Landingpage\StatisticController;
use App\Http\Controllers\Organization\Landingpage\SubheaderController;
use App\Http\Controllers\Organization\Blog\FetchBlogCategoryController;
use App\Http\Controllers\Organization\Relation\FetchRelationController;
use App\Http\Controllers\Organization\Surah\SurahApiProviderController;
use App\Http\Controllers\Organization\Competition\CompetitionController;
use App\Http\Controllers\Organization\BloodType\FetchBloodTypeController;
use App\Http\Controllers\Organization\Teacher\TeacherStatisticController;
use App\Http\Controllers\Organization\QuestionBank\QuestionBankController;
use App\Http\Controllers\Organization\UserRelation\UserRelationController;
use App\Http\Controllers\Organization\Curriculum\FetchCurriculumController;
use App\Http\Controllers\Organization\Landingpage\CommonQuestionController;
use App\Http\Controllers\Organization\Landingpage\ServiceFeatureController;
use App\Http\Controllers\Organization\MainSession\FetchMainSessionController;
use App\Http\Controllers\Organization\Competition\CompetitionRewardController;
use App\Http\Controllers\Organization\QuestionBank\FetchQuestionBankContoller;
use App\Http\Controllers\Organization\Home\OrganizationHomeStatisticController;
use App\Http\Controllers\Organization\ApplicationInfo\ApplicationInfoController;
use App\Http\Controllers\Organization\Curriculum\FetchCurriculumStageController;
use App\Http\Controllers\Organization\LibraryCategory\LibraryCategoryController;
use App\Http\Controllers\Organization\Competition\AssignCompetitionRewardController;

//AUTH
Route::controller(AuthController::class)->group(function () {
    Route::post('organization-register', 'register');
    Route::post('organization-login', 'login');
    Route::post('organization-check-email', 'checkEmail');
    Route::post('organization-check-code', 'checkCode');
    Route::post('organization-reset-password-check-code', 'resetPasswordcheckCode');
    Route::post('organization-reset-password', 'resetPassword');
});

Route::middleware('auth:organization')->group(function () {
    // Route::get('fetch_surah', [SurahApiProviderController::class, 'fetchSurah']);
    //EXAM STUDENT
    // Route::controller(ExamStudentController::class)->group(function () {
    //     Route::post('fetch_exam_students', 'index');
    //     Route::post('add_exam_student', 'store');
    //     Route::post('fetch_exam_student_details', 'show');
    //     Route::post('edit_exam_student', 'update');
    //     Route::post('delete_exam_student', 'delete');
    // });
    //EXAM QUESTION
    // Route::controller(ExamQuestionController::class)->group(function () {
    //     Route::post('fetch_exam_questions', 'index');
    //     Route::post('add_exam_question', 'store');
    //     Route::post('fetch_exam_question_details', 'show');
    //     Route::post('edit_exam_question', 'update');
    //     Route::post('delete_exam_question', 'delete');
    // });
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
    //QUESTION BANK
    Route::controller(QuestionBankController::class)->group(function () {
        Route::post('fetch_question_banks', 'index');
        Route::post('add_question_bank', 'store');
        Route::post('fetch_question_bank_details', 'show');
        Route::post('edit_question_bank', 'update');
        Route::post('delete_question_bank', 'delete');
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
    //LIBRARY CATEGORY
    Route::controller(LibraryCategoryController::class)->group(function () {
        Route::post('fetch_library_categories', 'index');
        Route::post('add_library_category', 'store');
        Route::post('fetch_library_category_details', 'show');
        Route::post('edit_library_category', 'update');
        Route::post('delete_library_category', 'delete');
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
        Route::post('fetch_teachers', 'fetch_teachers');
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
    //CONTACT
    Route::controller(ContactController::class)->group(function () {
        Route::post('fetch_contacts', 'index');
    });
    Route::post('fetch_subscripe_groups', [SubscriptionController::class, 'index']);
    Route::post('add_subscripe_group', [SubscriptionController::class, 'store']);
    Route::post('fetch_subscripe_group_details', [SubscriptionController::class, 'show']);
    Route::post('delete_subscripe_group', [SubscriptionController::class, 'delete']);
    //EXAM RESULT
    Route::controller(ExamResultController::class)->group(function () {
        Route::post('fetch_exam_results', 'index');
        Route::post('show_exam_result_answers', 'show');
    });
    //APPLICATION INFO
    Route::controller(ApplicationInfoController::class)->group(function () {
        Route::post('fetch_application_info', 'show');
        Route::post('store_application_info', 'store');
    });


    // Attendance end point
    Route::controller(AttendanceController::class)->group(function () {
        Route::post('organization_attendance', 'attendance');
        Route::post('fetch_attendance', 'fetch_attendance');
        Route::post('organization_leave', 'leave');
        Route::post('fetch_session_attendance', 'fetch_session_attendance');
    });


    // Rate end point

    Route::controller(RateController::class)->group(function () {
        Route::post('fetch_rates', 'fetch_rates');
        Route::post('add_rate', 'add_rate');
        Route::post('fetch_rate_details', 'fetch_rate_details');
        Route::post('edit_rate', 'edit_rate');
        Route::post('delete_rate', 'delete_rate');
    });
    //ORGANIZATION STATISTIC
    Route::controller(OrganizationHomeStatisticController::class)->group(
        function () {
            Route::post('organization_fetch_count_statistics', 'fetchCounts');
            Route::post('organization_fetch_latest_students_statistics', 'fetchLatestStudents');
            Route::post('organization_fetch_most_active_groups_statistics', 'fetchMostActiveGroups');
            Route::post('organization_fetch_best_places_interacted_with_organization_statistics', 'fetchBestPlacesInteractedWithOrganization');
            Route::post('organization_fetch_interacted_rate_with_organization_statistics', 'fetchInteractedRateWithOrganization');
        }
    );
    //TEACHER STATISTIC
    Route::controller(TeacherStatisticController::class)->group(
        function () {
            Route::post('teacher_fetch_count_statistics', 'fetchCounts');
            Route::post('teacher_group', 'teacherGroup');
            Route::post('teacher_fetch_main_sessions', 'fetchMainsessions');
            Route::post('teacher_exams', 'fetchExams');
        }
    );
    /**
     * END POINT START
     */

    //CURRICULUM
    Route::controller(CurriculumController::class)->group(function () {
        Route::post('organization_fetch_curriculums',  'index');
    });
    //DISABILITY
    Route::post('organization_fetch_disabilities', [DisabilityController::class, 'fetch_disabilities']);
    //STAGE
    Route::post('organization_fetch_stages', [StageController::class, 'index']);
    //EXAM STUDENT
    Route::post('organization_fetch_exam_students', [GlobalController::class, 'fetch_exam_students']);
    //QUESTION BANK
    Route::get('organization_fetch_question_banks', FetchQuestionBankContoller::class);
    //JOB TYPE
    Route::get('organization_fetch_job_types', FetchJobTypeController::class);
    //BLOOD TYPE
    Route::get('organization_fetch_blood_types', FetchBloodTypeController::class);
    //COUNTRY
    Route::get('organization_fetch_countries', FetchCountryController::class);
    //GROUP
    Route::get('organization_fetch_groups', FetchGroupController::class);
    //SEASON
    Route::get('organization_fetch_seasons', FetchSeasonController::class);
    //CRUCULUM
    Route::get('organization_fetch_curriculums', FetchCurriculumController::class);
    //BLOG HASHTAG
    Route::get('organization_fetch_blog_hashtags', FetchBlogHashtagController::class);
    //BLOG CATEGORY
    Route::get('organization_fetch_blog_categories', FetchBlogCategoryController::class);
    //YEAR
    Route::get('organization_fetch_years', [GlobalController::class, "fetch_years"]);
    //COURSE
    Route::post('organization_fetch_curriculum_stages', FetchCurriculumStageController::class);
    //STUDENT
    Route::post('organization_fetch_students', FetchStudentController::class);
    //MAIN SESSION
    Route::post('organization_fetch_main_sessions', FetchMainSessionController::class);
    //COMPETITON REWARD
    Route::post('assign_competition_reward', [AssignCompetitionRewardController::class, 'assignUser']);
    //USER
    Route::post('organization_fetch_users', FetchUserController::class);
    //PARENT
    Route::post('organization_fetch_parents', FetchParentController::class);
    //RELATION
    Route::post('organization_fetch_relations', FetchRelationController::class);
    //RELATION
    Route::post('organization_fetch_relations', FetchRelationController::class);
    //SURAH
    Route::post('organization_fetch_surahs', [SurahController::class, 'fetchSurahs']);
    Route::post('organization_fetch_stage_surahs', [SurahController::class, 'fetchStageSurahs']);
    //AYAH
    Route::post('organization_fetch_surah_ayahs ', [SurahController::class, 'fetchSurahAyahs']);


    /**
     * END POINT END
     */

    // ***********************************************************************************************************************************
    //**************************************************** lANDINGPAGE START *************************************************************
    // ***********************************************************************************************************************************

    Route::controller(HeaderController::class)->group(function () {
        Route::post('organization_fetch_headers',  'organization_fetch_headers');
        Route::post('organization_add_header',  'organization_add_header');
        Route::post('organization_fetch_header_details',  'organization_fetch_header_details');
        Route::post('organization_edit_header',  'organization_edit_header');
        Route::post('organization_delete_header',  'organization_delete_header');
    });
    Route::controller(SubheaderController::class)->group(function () {
        Route::post('organization_fetch_subheaders',  'organization_fetch_subheaders');
        Route::post('organization_add_subheader',  'organization_add_subheader');
        Route::post('organization_fetch_subheader_details',  'organization_fetch_subheader_details');
        Route::post('organization_edit_subheader',  'organization_edit_subheader');
        Route::post('organization_delete_subheader',  'organization_delete_subheader');
    });
    Route::controller(FeatureController::class)->group(function () {
        Route::post('organization_fetch_features',  'organization_fetch_features');
        Route::post('organization_add_feature',  'organization_add_feature');
        Route::post('organization_fetch_feature_details',  'organization_fetch_feature_details');
        Route::post('organization_edit_feature',  'organization_edit_feature');
        Route::post('organization_delete_feature',  'organization_delete_feature');
    });
    Route::controller(ServiceFeatureController::class)->group(function () {
        Route::post('organization_fetch_service_features',  'organization_fetch_service_features');
        Route::post('organization_add_service_feature',  'organization_add_service_feature');
        Route::post('organization_fetch_service_feature_details',  'organization_fetch_service_feature_details');
        Route::post('organization_edit_service_feature',  'organization_edit_service_feature');
        Route::post('organization_delete_service_feature',  'organization_delete_service_feature');
    });
    //SERVICE
    Route::controller(ServiceController::class)->group(function () {
        Route::post('fetch_services', 'index');
        Route::post('add_service', 'store');
        Route::post('fetch_service_details', 'show');
        Route::post('edit_service', 'update');
        Route::post('delete_service', 'delete');
    });
    //SCREEN
    Route::controller(ScreenController::class)->group(function () {
        Route::post('fetch_screens', 'index');
        Route::post('add_screen', 'store');
        Route::post('fetch_screen_details', 'show');
        Route::post('edit_screen', 'update');
        Route::post('delete_screen', 'delete');
    });
    //STATISTIC
    Route::controller(StatisticController::class)->group(function () {
        Route::post('fetch_statistics', 'index');
        Route::post('add_statistic', 'store');
        Route::post('fetch_statistic_details', 'show');
        Route::post('edit_statistic', 'update');
        Route::post('delete_statistic', 'delete');
    });
    //PARTNER
    Route::controller(PartnerController::class)->group(function () {
        Route::post('fetch_partners', 'index');
        Route::post('add_partner', 'store');
        Route::post('fetch_partner_details', 'show');
        Route::post('edit_partner', 'update');
        Route::post('delete_partner', 'delete');
    });
    //OPINION
    Route::controller(OpinionController::class)->group(function () {
        Route::post('fetch_opinions', 'index');
        Route::post('add_opinion', 'store');
        Route::post('fetch_opinion_details', 'show');
        Route::post('edit_opinion', 'update');
        Route::post('delete_opinion', 'delete');
    });
    //COMMIN QUESTIONS
    Route::controller(CommonQuestionController::class)->group(function () {
        Route::post('fetch_common_questions', 'index');
        Route::post('add_common_question', 'store');
        Route::post('fetch_common_question_details', 'show');
        Route::post('edit_common_question', 'update');
        Route::post('delete_common_question', 'delete');
    });
    //PRIVACY
    Route::controller(PrivacyController::class)->group(function () {
        Route::post('fetch_privacies', 'index');
        Route::post('add_privacy', 'store');
        Route::post('fetch_privacy_details', 'show');
        Route::post('edit_privacy', 'update');
        Route::post('delete_privacy', 'delete');
    });
    //POLICY
    Route::controller(PolicyController::class)->group(function () {
        Route::post('fetch_policies', 'index');
        Route::post('add_policy', 'store');
        Route::post('fetch_policy_details', 'show');
        Route::post('edit_policy', 'update');
        Route::post('delete_policy', 'delete');
    });
    // ***********************************************************************************************************************************
    //**************************************************** lANDINGPAGE END *************************************************************
    // ***********************************************************************************************************************************



    // ***********************************************************************************************************************************
    //**************************************************** Live100MS Start *************************************************************
    // ***********************************************************************************************************************************

    Route::controller(Live100MSIntegrationController::class)->group(function () {
        Route::post('create_room',  'create_room');
        Route::post('join_room',  'join_room');
    });
});



//GLOBAL
Route::controller(GlobalController::class)->group(function () {
    Route::post('fetch_days',  'fetch_days');
});
