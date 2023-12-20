<?php

use Illuminate\Support\Facades\Route;

// Dashboard
//Route::get('/', 'HomeController@index')->name('home');
Route::group(['namespace' => 'Admin'], function() {

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');


        // Passwords
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
      //Message Page
        Route::get('success', 'Auth\RegisterController@success')->name('admin.success.msg');
        Route::get('error', 'Auth\RegisterController@error')->name('admin.error.msg');
        Route::post('get-sub-category','Modules\Skill\SkillController@getSubCategory')->name('get.sub.category');
        Route::group(['middleware'=>'admin.auth'], function(){

        //Dashboard
       Route::get('dashboard', 'Modules\Dashboard\DashboardController@dashboard')->name('admin.dashboard');
       Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

       //Profile
       Route::get('edit-admin-profile','Modules\Profile\ProfileController@editProfile')->name('edit.admin.profile');
       Route::post('update-admin-profile','Modules\Profile\ProfileController@editProfile')->name('update.admin.profile');
       Route::get('edit-admin-password','Modules\Profile\ProfileController@updatePassword')->name('edit.admin.password');
       Route::post('update-admin-password','Modules\Profile\ProfileController@updatePassword')->name('update.admin.password');

       //Sub-admins
       Route::get('manage-subadmin','Modules\Subadmin\SubadminController@manageSubadmin')->name('manage.subadmin');
       Route::get('create-subadmin/{id?}','Modules\Subadmin\SubadminController@createSubadmin')->name('create.subadmin');
       Route::post('store-subadmin','Modules\Subadmin\SubadminController@createSubadmin')->name('store.subadmin');
       Route::get('active-subadmin/{id}','Modules\Subadmin\SubadminController@activeSubadmin')->name('active.subadmin');
       Route::get('delete-subadmin/{id}','Modules\Subadmin\SubadminController@deleteSubadmin')->name('delete.subadmin');
       Route::post('email-check','Modules\Subadmin\SubadminController@adminEmailCheck')->name('admin.email.check');


        //User
        Route::get('manage-user','Modules\User\UserController@manageUser')->name('manage.user');
        Route::get('view-user/{id}','Modules\User\UserController@viewUser')->name('view.user');
        Route::get('edit-user/{id}','Modules\User\UserController@editUser')->name('edit.user');
        Route::post('update-user/{id}','Modules\User\UserController@updateUser')->name('update.user');
        Route::post('user-mobile-check', 'Modules\User\UserController@userMobileCheck')->name('admin.User.mobile.check');
        Route::post('user-email-check', 'Modules\User\UserController@userEmailCheck')->name('admin.User.email.check');

        // Verify user Routs....
        Route::get('Verify-user/{id}','Modules\User\UserController@verifyUser')->name('verify.user');

        Route::get('change-user-status/{id}','Modules\User\UserController@changeStatus')->name('change.User.status');
        Route::get('delete-user/{id}','Modules\User\UserController@deleteUser')->name('delete.user');

        Route::post('update-user-name','Modules\User\UserController@updateUsername')->name('update.username');
        Route::get('verification-list','Modules\User\UserController@verification')->name('verification.list');

        Route::get('approve-verification/{id}','Modules\User\UserController@approveGoveID')->name('approve.goveid');
        Route::get('reject-verification/{id}','Modules\User\UserController@rejectGoveID')->name('reject.goveid');

        //Email Template
        Route::get('email-template','Modules\EmailTemplate\EmailTemplateController@emailTemplateList')->name('template.list');
        Route::get('email-template-edit/{id}','Modules\EmailTemplate\EmailTemplateController@emailTemplateEdit')->name('template.edit');
        Route::post('email-template-update','Modules\EmailTemplate\EmailTemplateController@emailTemplateUpdate')->name('template.update');

        //Package
        Route::get('manage-package','Modules\Package\PackageController@managePackage')->name('manage.package');
        Route::get('edit-package/{id?}/{type?}','Modules\Package\PackageController@editPackage')->name('edit.package');
        Route::post('update-package','Modules\Package\PackageController@updatePackage')->name('update.package');
        Route::get('view-package/{id?}/{type?}','Modules\Package\PackageController@editPackage')->name('view.package');

        //Payment
        Route::get('manage-payment','Modules\Payment\PaymentController@managePayment')->name('manage.payment');
        Route::get('view-payment/{id?}','Modules\Payment\PaymentController@viewPayment')->name('admin.view.payment');
        Route::post('withdraw-status','Modules\Payment\PaymentController@withdrawStatus')->name('withdraw.status');

        //site setting
        Route::get('privacy-policy-update','Modules\SiteSetting\SiteSettingController@privacyPolicy')->name('privacy.policy');
        Route::get('terms-and-conditions-update','Modules\SiteSetting\SiteSettingController@termsAndConditions')->name('terms.and.conditions');
        Route::get('cookies-update','Modules\SiteSetting\SiteSettingController@cookies')->name('cookies');
        Route::get('copyright-policy-update','Modules\SiteSetting\SiteSettingController@copyrightPolicy')->name('copyright.policy');

        Route::post('site-setting-update','Modules\SiteSetting\SiteSettingController@siteSettingUpdate')->name('site.setting.update');

        //Blog Routs
        Route::get('manage-blog-categories','Modules\Blog\BlogController@manageBlogCategories')->name('manage.blog.categories');
        Route::get('create-blog-categories/{id?}','Modules\Blog\BlogController@createBlogCategories')->name('create.blog.category');

        Route::post('store-blog-categories','Modules\Blog\BlogController@saveBlogCategories')->name('store.blog.category');
        Route::post('blog-cata-check', 'Modules\Blog\BlogController@chkBlogCata')->name('blog.chata.chk');

        Route::post('unique-blog-category-check','Modules\Blog\BlogController@chkBlogCategoryExist')->name('unique.blog.category.check');
        Route::get('delete-blog-categories/{id?}','Modules\Blog\BlogController@deleteBlogCategories')->name('delete.blog.category');

        Route::get('edit-blog-categories/{id?}','Modules\Blog\BlogController@editBlogCategories')->name('edit.blog.category');

        Route::get('manage-blog','Modules\Blog\BlogController@manageBlog')->name('manage.blog');
        Route::get('create-blog','Modules\Blog\BlogController@createBlog')->name('create.blog');
        Route::post('store-blog','Modules\Blog\BlogController@storeBlog')->name('store.blog');
        Route::get('delete-blog/{id?}','Modules\Blog\BlogController@deleteBlog')->name('delete.blog');
        Route::get('edit-blog/{id?}','Modules\Blog\BlogController@editBlog')->name('edit.blog');

        //Category
        Route::get('manage-category','Modules\Category\CategoryController@manageCategory')->name('manage.category');
        Route::get('create-category/{id?}','Modules\Category\CategoryController@createCategory')->name('create.category');
        Route::post('store-category','Modules\Category\CategoryController@createCategory')->name('store.category');

        Route::get('manage-sub-category','Modules\Category\CategoryController@manageSubCategory')->name('manage.sub.category');
        Route::get('create-sub-category/{id?}','Modules\Category\CategoryController@createCategory')->name('create.sub.category');
        Route::post('store-sub-category','Modules\Category\CategoryController@createCategory')->name('store.sub.category');

        Route::get('change-category-status/{id}/{ans?}','Modules\Category\CategoryController@changeStatus')->name('change.category.status');
        Route::get('delete-category/{id}','Modules\Category\CategoryController@deleteCategory')->name('delete.category');
        Route::post('unique-category-check','Modules\Category\CategoryController@chkCategoryExist')->name('unique.category.check');

        //faq
        Route::get('manage-faq','Modules\Faq\FaqController@listing')->name('manage.faq');
        Route::post('manage-faq','Modules\Faq\FaqController@listing')->name('manage.faq.post');
        Route::get('create-faq/{id?}','Modules\Faq\FaqController@create')->name('create.faq');
        Route::get('delete-faq/{id}','Modules\Faq\FaqController@delete')->name('delete.faq');
        Route::post('store-faq','Modules\Faq\FaqController@store')->name('store.faq');

        //logo homepage
        Route::get('manage-logo','Modules\Contant\ContantController@manageLogo')->name('manage.logo');
        Route::get('create-logo/{id?}','Modules\Contant\ContantController@createLogo')->name('create.logo');
        Route::post('store-logo','Modules\Contant\ContantController@storeLogo')->name('store.logo');
        Route::get('delete-logo/{id}','Modules\Contant\ContantController@deleteLogo')->name('delete.logo');
        //homepage accouncement
        Route::get('homepage-accouncement','Modules\Contant\ContantController@homepageAccouncement')->name('homepage.accouncement');
        Route::post('homepage-accouncement','Modules\Contant\ContantController@homepageAccouncement')->name('homepage.accouncement.post');
        Route::get('about-us-update','Modules\Contant\ContantController@aboutUs')->name('about.us');
        Route::get('faq-message-update','Modules\Contant\ContantController@faqMessage')->name('faq.message');
        Route::post('faq-message-update','Modules\Contant\ContantController@faqMessage')->name('faq.message.post');
        Route::get('footer-section','Modules\Contant\ContantController@footerSection')->name('footer.section');
        Route::post('footer-section','Modules\Contant\ContantController@footerSection')->name('footer.section.post');

        //Will
        Route::get('manage-will/{id?}','Modules\Will\WillController@manageWill')->name('manage.will');
        Route::get('will-location-search-enquiries','Modules\Will\WillController@willLocationSearchEnquiries')->name('will-location-search-enquiries');
        Route::any('suggest-will-change/{id?}','Modules\Will\WillController@suggestChange')->name('suggest.will.change');
        Route::get('approve-will/{id?}','Modules\Will\WillController@approveWill')->name('approve.will');
        Route::get('download-pdf/{id?}','Modules\Will\WillController@generatePDF')->name('admin.pdf.download');
        Route::get('view-will/{id?}','Modules\Will\WillController@viewWill')->name('view.will');

        //Consultation & Contact request
        Route::get('manage-consultation','Modules\Consultation\ConsultationController@manageConsultation')->name('manage.consultation');

        //Reports
        Route::get('reports-on-signup','Modules\Reports\ReportsController@signUpReports')->name('reports.on.signup');
        Route::get('reports-on-services','Modules\Reports\ReportsController@servicesReports')->name('reports.on.services');
        Route::get('reports-on-users','Modules\Reports\ReportsController@userReports')->name('reports.on.users');

        });

});



// Register
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');



// Confirm Password
// Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
