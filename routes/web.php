<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get("/mail-design", function(){return view("mail.test_mail_design");});


Auth::routes();



Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('userhome');
// Login
Route::get('login', 'Auth\LoginController@showUserLoginForm')->name('login');
Route::post('user-login', 'Auth\LoginController@userLogin')->name('user-login');
Route::any('verify-login-mobile', 'Auth\LoginController@verifyLoginMobile')->name('verify-login-mobile');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');



// Page contant Routs.....

//terms
Route::get('privacy-policy','Modules\Contant\ContantController@privacyPolicy')->name('privacy_policy');
Route::get('terms-and-conditions','Modules\Contant\ContantController@termsAndConditions')->name('terms_and_conditions');
Route::get('cookies','Modules\Contant\ContantController@cookies')->name('cookies');
Route::get('copyright-policy','Modules\Contant\ContantController@copyrightPolicy')->name('copyright_policy');
Route::get('terms-of-services','Modules\Contant\ContantController@termsOfServices')->name('terms_of_services');
Route::get('disclaimer-policy','Modules\Contant\ContantController@disclaimerPolicy')->name('disclaimer_policy');

//About
Route::get('security','Modules\Contant\ContantController@security')->name('security');
Route::get('sitemap','Modules\Contant\ContantController@sitemap')->name('sitemap');
//help and support
Route::get('help','Modules\Contant\ContantController@help')->name('help');
Route::get('support','Modules\Contant\ContantController@support')->name('support');

// About Us Routs...
Route::get('about-us','Modules\Contant\ContantController@aboutUs')->name('about_us');
Route::get('services','Modules\Contant\ContantController@services')->name('services');
Route::get('service-detail/{id?}','Modules\Contant\ContantController@serviceDetail')->name('service_detail');
Route::post('will-enquiry-contact','Modules\Contant\ContantController@willEnquiryContact')->name('will-enquiry-contact');
Route::get('careers','Modules\Contant\ContantController@career')->name('career');
Route::get('team','Modules\Contant\ContantController@team')->name('team');
Route::get('team-detail','Modules\Contant\ContantController@teamDetail')->name('team-detail');
Route::get('prices','Modules\Contant\ContantController@prices')->name('prices');

// Careers
//Route::get('careers','Modules\Contant\ContantController@careers')->name('careers');
//Categories
Route::get('categories','Modules\Contant\ContantController@categories')->name('categories');

// Contact Us
Route::get('contact-us','Modules\Contant\ContantController@contactUs')->name('contact_us');
Route::post('contact-us','Modules\Contant\ContantController@contactUsPost')->name('contact_us.post');
Route::get('save-contact', 'HomeController@saveContact')->name('save.contact');

// FAQ Details
Route::get('faq','Modules\Contant\ContantController@faq')->name('faq');
Route::get('others-faqs','Modules\Contant\ContantController@othersFaq')->name('others.faqs');

// Blog
Route::get('blog','Modules\Blog\BlogController@blog')->name('blog');

// Blog Details
Route::get('blogs/{blog_slug?}','Modules\Blog\BlogController@blogDetails')->name('blog_details');
Route::get('blog/{category_slug?}','Modules\Blog\BlogController@displayBlog')->name('display.blog.category');

//corn for Birthday Wish
Route::get('send-birthday-mail', 'HomeController@sendBirthDayMail')->name('send.birthday.mail');



// Register
Route::get('register', 'Auth\RegisterController@register')->name('register');

Route::post('get-country-state-api', 'CountryController@getCountryStateApi');

Route::get('otp-verification/{id?}', 'Auth\RegisterController@verifyOTP')->name('user.verify.otp');
Route::post('otp-verification', 'Auth\RegisterController@verifyOTP')->name('user.verify');
Route::get('user-verify/{vcode}/{id}', 'HomeController@verifyEmail')->name('verify');
Route::post('save-register', 'Auth\RegisterController@saveRegisterUser')->name('save.register.user');

Route::post('user-email-check', 'Auth\RegisterController@userEmailCheck')->name('user.email.check');
Route::post('user-username-check', 'Auth\RegisterController@userUsernameCheck')->name('user.username.check');
Route::post('user-mobile-check', 'Auth\RegisterController@userMobileCheck')->name('user.mobile.check');

// Passwords
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('user.password.update');

//Message Page
Route::get('success', 'Auth\RegisterController@success')->name('user.success.msg');
Route::get('error', 'Auth\RegisterController@error')->name('user.error.msg');

Route::get('verified-success', 'HomeController@success')->name('user.success.verified');
Route::get('user-email-verify/{vcode}/{id}', 'HomeController@verifyDashEmail')->name('verify.email');



Route::group(['middleware' => 'auth'], function() {

});

Route::group(['namespace' => 'Modules','middleware' => 'auth'], function() {

	Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'Dashboard\DashboardController@dashboard')->name('user.dashboard');
        Route::get('edit-profile', 'Profile\ProfileController@profile')->name('user.profile');
        Route::post('update-profile', 'Profile\ProfileController@update')->name('user.update.profile');
        Route::post('update-email', 'Profile\ProfileController@updateEmail')->name('user.update.email');
        Route::post('email-check', 'Profile\ProfileController@userEmailCheck')->name('email.check');
        Route::post('mobile-check', 'Profile\ProfileController@userMobileCheck')->name('mobile.check');
        Route::get('otp-verify/{id?}', 'Profile\ProfileController@verifyOTP')->name('verify.otp');
        Route::post('otp-verify', 'Profile\ProfileController@verifyOTP')->name('verification.otp');
        Route::any('verify-email', 'Profile\ProfileController@verifyEmail')->name('user.verify.email');
        Route::any('verify-mobile', 'Profile\ProfileController@verifyMobile')->name('user.verify.mobile');
        Route::get('mobile-otp-verify/{id?}', 'Profile\ProfileController@verifyMobileOTP')->name('verify.mobile.otp');
        Route::post('mobile-otp-verify', 'Profile\ProfileController@verifyMobileOTP')->name('verification.mobile.otp');

        //Package route
        Route::get('purchase-package', 'Package\PackageController@index')->name('purchase.package');
        Route::get('package-detail/{id?}', 'Package\PackageController@packageDetail')->name('package.detail');
        Route::get('buy-package/{id?}', 'Package\PackageController@buyPackage')->name('buy.package');

        //Will routes
        Route::get('my-will', 'Will\WillController@myWill')->name('user.mywill');
        Route::get('download-will-templates', 'Will\WillController@downloadWillTemplates')->name('download-will-templates');
        Route::get('download-will-templates-intro', 'Will\WillController@downloadWillTemplatesIntro')->name('download-will-templates-intro');
        Route::get('process-will-template-download', 'Will\WillController@processWillTemplateDownload');
        Route::get('changes-suggested/{willid?}', 'Will\WillController@changesSuggestedByAdmin')->name('user.changes.suggested');
        Route::get('submit-will/{willid?}', 'Will\WillController@submitWill')->name('user.submit.will');
        Route::get('download-pdf/{id?}','Will\WillController@generatePDF')->name('pdf.download')->middleware('check.will');
        Route::get('user-view-will/{id?}','Will\WillController@viewWill')->name('user.view.will')->middleware('check.will');
        Route::get('user-add-will-location/{willid?}', 'Will\WillController@addWillLocation')->name('user.add.will.location');
        Route::post('save-will-location', 'Will\WillController@saveWillLocation')->name('save.will.location');
        Route::get('service-authorized/{id?}', 'Will\WillController@serviceAuthorized')->name('user.service.authorized');
        Route::post('service-authorized-save', 'Will\WillController@serviceAuthorizedSave')->name('save.service.authorized');
        Route::get('user-add-amd/{willid?}', 'Will\WillController@addWillLocation')->name('user.add.amd');

        //My Payment routes
        Route::get('my-payments', 'Payments\PaymentsController@myPayments')->name('user.mypayments');
        Route::get('delete-payment/{id?}', 'Payments\PaymentsController@delete')->name('delete.payment');
        Route::get('view-payment/{id?}', 'Payments\PaymentsController@viewPayment')->name('view.payment');

        //Executor routes
        Route::get('manage-executor/{id?}', 'Executor\ExecutorController@manageExecutor')->name('user.manage.executor')->middleware('check.will');
        Route::get('add-executor/{id?}', 'Executor\ExecutorController@addExecutor')->name('user.add.executor')->middleware('check.will');
        Route::post('save-executor/{id?}', 'Executor\ExecutorController@saveExecutor')->name('save.executor');
        Route::post('update-executor/{id?}', 'Executor\ExecutorController@updateExecutor')->name('update.executor');
        Route::get('update-executor/{willid?}/{slug?}', 'Executor\ExecutorController@updateExecutor')->name('detail.executor');
        Route::get('delete-executor/{id?}', 'Executor\ExecutorController@deleteExecutor')->name('delete.executor');
        Route::get('view-executor/{id?}/{slug?}', 'Executor\ExecutorController@viewExecutor')->name('view.executor');
        Route::post('executor-email-check', 'Executor\ExecutorController@executorEmailCheck')->name('executor.email.check');
        Route::post('executor-mobile-check', 'Executor\ExecutorController@executorMobileCheck')->name('executor.mobile.check');
        Route::get('approve-location-executor/{id?}/{will_id?}', 'Executor\ExecutorController@approveLocationExecutor')->name('approve.location.executor');
        Route::get('approve-loi-executor/{id?}/{will_id?}', 'Executor\ExecutorController@approveLoiExecutor')->name('approve.loi.executor');
        Route::get('approve-will-executor/{id?}/{will_id?}', 'Executor\ExecutorController@approveWillExecutor')->name('approve.will.executor');
        Route::post('check-executor-mobile', 'Executor\ExecutorController@checkMobile')->name('check.executor.mobile');
        Route::post('check-executor-email', 'Executor\ExecutorController@checkEmail')->name('check.executor.email');
        Route::post('check-executor-aadharnumber', 'Executor\ExecutorController@checkAadharNumber')->name('check.executor.aadharnumber');
        Route::post('check-executor-pannumber', 'Executor\ExecutorController@checkPanNumber')->name('check.executor.pannumber');

        //Beneficiaries routes
        Route::get('manage-beneficiaries/{id?}', 'Beneficiaries\BeneficiariesController@manageBeneficiaries')->name('user.manage.beneficiaries')->middleware('check.will');
        Route::get('add-beneficiaries/{id?}', 'Beneficiaries\BeneficiariesController@addBeneficiaries')->name('user.add.beneficiaries')->middleware('check.will');
        Route::post('save-beneficiaries/{id?}', 'Beneficiaries\BeneficiariesController@saveBeneficiaries')->name('save.beneficiaries');
        Route::post('update-beneficiaries/{id?}', 'Beneficiaries\BeneficiariesController@updateBeneficiaries')->name('update.beneficiaries');
        Route::get('update-beneficiaries/{willid?}/{slug?}', 'Beneficiaries\BeneficiariesController@updateBeneficiaries')->name('detail.beneficiaries');
        Route::get('delete-beneficiar/{id?}', 'Beneficiaries\BeneficiariesController@deleteBeneficiar')->name('delete.beneficiar');
        Route::get('delete-nominee/{id?}', 'Beneficiaries\BeneficiariesController@deleteNominee')->name('delete.nominee');
        Route::get('view-beneficiar/{id?}/{slug?}', 'Beneficiaries\BeneficiariesController@viewBeneficiar')->name('view.beneficiar');
        Route::post('beneficiaries-email-check', 'Beneficiaries\BeneficiariesController@beneficiariesEmailCheck')->name('beneficiaries.email.check');
        Route::post('beneficiaries-mobile-check', 'Beneficiaries\BeneficiariesController@beneficiariesMobileCheck')->name('beneficiaries.mobile.check');
        Route::get('approve-location-beneficiar/{id?}/{will_id?}', 'Beneficiaries\BeneficiariesController@approveLocationBeneficiaries')->name('approve.location.beneficiar');
        Route::get('approve-loi-beneficiar/{id?}/{will_id?}', 'Beneficiaries\BeneficiariesController@approveLoiBeneficiaries')->name('approve.loi.beneficiar');
        Route::get('approve-will-beneficiar/{id?}/{will_id?}', 'Beneficiaries\BeneficiariesController@approveWillBeneficiaries')->name('approve.will.beneficiar');
        Route::post('check-beneficiaries-mobile', 'Beneficiaries\BeneficiariesController@checkMobile')->name('check.beneficiaries.mobile');
        Route::post('check-beneficiaries-email', 'Beneficiaries\BeneficiariesController@checkEmail')->name('check.beneficiaries.email');
        Route::post('check-beneficiaries-aadharnumber', 'Beneficiaries\BeneficiariesController@checkAadharNumber')->name('check.beneficiaries.aadharnumber');
        Route::post('check-beneficiaries-pannumber', 'Beneficiaries\BeneficiariesController@checkPanNumber')->name('check.beneficiaries.pannumber');

        // your details routes
        Route::get('your-details/{id?}', 'Beneficiaries\BeneficiariesController@yourDetails')->name('user.your-details')->middleware('check.will');
        Route::post('save-your-details', 'Beneficiaries\BeneficiariesController@saveYourDetails')->name('user.save-your-details');

        //Cash routes
        Route::get('manage-cash/{id?}', 'Will\Cash\CashController@manageCash')->name('user.manage.cash')->middleware('check.will');
        Route::get('add-cash/{id?}', 'Will\Cash\CashController@addCash')->name('user.add.cash')->middleware('check.will');
        Route::post('save-cash/{id?}', 'Will\Cash\CashController@saveCash')->name('save.cash');
        Route::get('delete-cash/{id?}', 'Will\Cash\CashController@deleteCash')->name('delete.cash');
        Route::get('view-cash/{willid?}/{id?}', 'Will\Cash\CashController@viewCash')->name('user.view.cash');
        Route::post('update-cash/{id?}', 'Will\Cash\CashController@updateCash')->name('update.cash');

        //Bank routes
        Route::get('manage-bank/{id?}', 'Will\Bank\BankController@manageBank')->name('user.manage.bank')->middleware('check.will');
        Route::get('add-bank/{id?}', 'Will\Bank\BankController@addBank')->name('user.add.bank')->middleware('check.will');
        Route::post('save-bank/{id?}', 'Will\Bank\BankController@saveBank')->name('save.bank');
        Route::get('delete-bank/{id?}', 'Will\Bank\BankController@deleteBank')->name('delete.bank');
        Route::get('view-bank/{willid?}/{id?}', 'Will\Bank\BankController@viewBank')->name('user.view.bank');
        Route::post('update-bank/{id?}', 'Will\Bank\BankController@updateBank')->name('update.bank');

        //jewelry routes
        Route::get('manage-jewelry/{id?}', 'Will\Jewelry\JewelryController@manageJewelry')->name('user.manage.jewelry')->middleware('check.will');
        Route::get('add-jewelry/{id?}', 'Will\Jewelry\JewelryController@addJewelry')->name('user.add.jewelry')->middleware('check.will');
        Route::post('save-jewelry/{id?}', 'Will\Jewelry\JewelryController@saveJewelry')->name('save.jewelry');
        Route::get('delete-jewelry/{id?}', 'Will\Jewelry\JewelryController@deleteJewelry')->name('delete.jewelry');
        Route::get('view-jewelry/{willid?}/{id?}', 'Will\Jewelry\JewelryController@viewJewelry')->name('user.view.jewelry');
        Route::post('update-jewelry/{id?}', 'Will\Jewelry\JewelryController@updateJewelry')->name('update.jewelry');
        Route::get('update-jewelry-alocation', 'Will\Jewelry\JewelryController@updateJewelryAlocation')->name('edit.jewelry.allocation');

        //Locker routes
        // Route::get('manage-locker/{id?}', 'Will\Locker\LockerController@manageLocker')->name('user.manage.locker')->middleware('check.will');
        // Route::get('add-locker/{id?}', 'Will\Locker\LockerController@addLocker')->name('user.add.locker')->middleware('check.will');
        // Route::post('save-locker/{id?}', 'Will\Locker\LockerController@saveLocker')->name('save.locker');
        // Route::get('delete-locker/{id?}', 'Will\Locker\LockerController@deleteLocker')->name('delete.locker');
        // Route::get('view-locker/{willid?}/{id?}', 'Will\Locker\LockerController@viewLocker')->name('user.view.locker');
        // Route::post('update-locker/{id?}', 'Will\Locker\LockerController@updateLocker')->name('update.locker');

        //Property Residential routes
        Route::get('manage-residential-property/{id?}', 'Will\Property\ResidentialController@manageResidential')->name('user.manage.residentials')->middleware('check.will');
        Route::get('add-residentials/{id?}', 'Will\Property\ResidentialController@addResidential')->name('user.add.residentials')->middleware('check.will');
        Route::post('save-residentials/{id?}', 'Will\Property\ResidentialController@saveResidential')->name('save.residentials');
        Route::get('delete-residentials/{id?}', 'Will\Property\ResidentialController@deleteResidential')->name('delete.residentials');
        Route::get('view-residential-property/{willid?}/{id?}', 'Will\Property\ResidentialController@viewResidential')->name('user.view.residentials');
        Route::post('update-residentials/{id?}', 'Will\Property\ResidentialController@updateResidential')->name('update.residentials');

        //Property Commercial routes
        Route::get('manage-commercial-property/{id?}', 'Will\Property\CommercialController@manageCommercial')->name('user.manage.commercial')->middleware('check.will');
        Route::get('add-commercial/{id?}', 'Will\Property\CommercialController@addCommercial')->name('user.add.commercial')->middleware('check.will');
        Route::post('save-commercial/{id?}', 'Will\Property\CommercialController@saveCommercial')->name('save.commercial');
        Route::get('delete-commercial/{id?}', 'Will\Property\CommercialController@deleteCommercial')->name('delete.commercial');
        Route::get('view-commercial-property/{willid?}/{id?}', 'Will\Property\CommercialController@viewCommercial')->name('user.view.commercial');
        Route::post('update-commercial/{id?}', 'Will\Property\CommercialController@updateCommercial')->name('update.commercial');

        //Land routes
        Route::get('manage-land-property/{id?}', 'Will\Property\LandController@manageLand')->name('user.manage.land')->middleware('check.will');
        Route::get('add-land/{id?}', 'Will\Property\LandController@addLand')->name('user.add.land')->middleware('check.will');
        Route::post('save-land/{id?}', 'Will\Property\LandController@saveLand')->name('save.land');
        Route::get('delete-land/{id?}', 'Will\Property\LandController@deleteLand')->name('delete.land');
        Route::get('view-land-property/{willid?}/{id?}', 'Will\Property\LandController@viewLand')->name('user.view.land');
        Route::post('update-land/{id?}', 'Will\Property\LandController@updateLand')->name('update.land');

        //Demat routes
        Route::get('manage-demat/{id?}', 'Will\Demat\DematController@manageDemat')->name('user.manage.demat')->middleware('check.will');
        Route::get('add-demat/{id?}', 'Will\Demat\DematController@addDemat')->name('user.add.demat')->middleware('check.will');
        Route::post('save-demat/{id?}', 'Will\Demat\DematController@saveDemat')->name('save.demat');
        Route::get('delete-demat/{id?}', 'Will\Demat\DematController@deleteDemat')->name('delete.demat');
        Route::get('view-demat/{willid?}/{id?}', 'Will\Demat\DematController@viewDemat')->name('user.view.demat');
        Route::post('update-demat/{id?}', 'Will\Demat\DematController@updateDemat')->name('update.demat');
        Route::get('update-demat-alocation', 'Will\Demat\DematController@updateDematAlocation')->name('edit.demat.allocation');

        //mutual_fund routes
        Route::get('manage-mutual-fund/{id?}', 'Will\MutualFund\MutualFundController@manageMutualFund')->name('user.manage.mutualFund')->middleware('check.will');
        Route::get('add-mutual-fund/{id?}', 'Will\MutualFund\MutualFundController@addMutualFund')->name('user.add.mutualFund')->middleware('check.will');
        Route::post('save-mutual-fund/{id?}', 'Will\MutualFund\MutualFundController@saveMutualFund')->name('save.mutualFund');
        Route::get('delete-mutual-fund/{id?}', 'Will\MutualFund\MutualFundController@deleteMutualFund')->name('delete.mutualFund');
        Route::get('view-mutual-fund/{willid?}/{id?}', 'Will\MutualFund\MutualFundController@viewMutualFund')->name('user.view.mutualFund');
        Route::post('update-mutual-fund/{id?}', 'Will\MutualFund\MutualFundController@updateMutualFund')->name('update.mutualFund');

        //Insurance routes
        Route::get('manage-insurance/{id?}', 'Will\Insurance\InsuranceController@manageInsurance')->name('user.manage.insurance')->middleware('check.will');
        Route::get('add-insurance/{id?}', 'Will\Insurance\InsuranceController@addInsurance')->name('user.add.insurance')->middleware('check.will');
        Route::post('save-insurance/{id?}', 'Will\Insurance\InsuranceController@saveInsurance')->name('save.insurance');
        Route::get('delete-insurance/{id?}', 'Will\Insurance\InsuranceController@deleteInsurance')->name('delete.insurance');
        Route::get('view-insurance/{willid?}/{id?}', 'Will\Insurance\InsuranceController@viewInsurance')->name('user.view.insurance');
        Route::post('update-insurance/{id?}', 'Will\Insurance\InsuranceController@updateInsurance')->name('update.insurance');

        //PPF routes
        Route::get('manage-ppf/{id?}', 'Will\PPF\PPFController@managePPF')->name('user.manage.ppf')->middleware('check.will');
        Route::get('add-ppf/{id?}', 'Will\PPF\PPFController@addPPF')->name('user.add.ppf')->middleware('check.will');
        Route::post('save-ppf/{id?}', 'Will\PPF\PPFController@savePPF')->name('save.ppf');
        Route::get('delete-ppf/{id?}', 'Will\PPF\PPFController@deletePPF')->name('delete.ppf');
        Route::get('view-ppf/{willid?}/{id?}', 'Will\PPF\PPFController@viewPPF')->name('user.view.ppf');
        Route::post('update-ppf/{id?}', 'Will\PPF\PPFController@updatePPF')->name('update.ppf');

        //Vehicles routes
        Route::get('manage-vehicles/{id?}', 'Will\Vehicles\VehiclesController@manageVehicles')->name('user.manage.vehicles')->middleware('check.will');
        Route::get('add-vehicles/{id?}', 'Will\Vehicles\VehiclesController@addVehicles')->name('user.add.vehicles')->middleware('check.will');
        Route::post('save-vehicles/{id?}', 'Will\Vehicles\VehiclesController@saveVehicles')->name('save.vehicles');
        Route::get('delete-vehicles/{id?}', 'Will\Vehicles\VehiclesController@deleteVehicles')->name('delete.vehicles');
        Route::get('view-vehicles/{willid?}/{id?}', 'Will\Vehicles\VehiclesController@viewVehicles')->name('user.view.vehicles');
        Route::post('update-vehicles/{id?}', 'Will\Vehicles\VehiclesController@updateVehicles')->name('update.vehicles');

        //Art routes
        Route::get('manage-art/{id?}', 'Will\Art\ArtController@manageArt')->name('user.manage.art')->middleware('check.will');
        Route::get('add-art/{id?}', 'Will\Art\ArtController@addArt')->name('user.add.art')->middleware('check.will');
        Route::post('save-art/{id?}', 'Will\Art\ArtController@saveArt')->name('save.art');
        Route::get('delete-art/{id?}', 'Will\Art\ArtController@deleteArt')->name('delete.art');
        Route::get('view-art/{willid?}/{id?}', 'Will\Art\ArtController@viewArt')->name('user.view.art');
        Route::post('update-art/{id?}', 'Will\Art\ArtController@updateArt')->name('update.art');

        // Liability
        Route::get('manage-liability/{id?}', 'Will\Liability\LiabilityController@manageLiability')->name('user.manage.liability')->middleware('check.will');
        Route::get('add-liability/{id?}', 'Will\Liability\LiabilityController@addLiability')->name('user.add.liability')->middleware('check.will');
        Route::post('save-liability/{id?}', 'Will\Liability\LiabilityController@saveLiability')->name('save.liability');
        Route::get('delete-liability/{id?}', 'Will\Liability\LiabilityController@deleteLiability')->name('delete.liability');
        Route::get('view-liability/{willid?}/{id?}', 'Will\Liability\LiabilityController@viewLiability')->name('user.view.liability');
        Route::post('update-liability/{id?}', 'Will\Liability\LiabilityController@updateLiability')->name('update.liability');

        //Contingency routes
        Route::get('manage-contingency/{id?}', 'Will\Contingency\ContingencyController@manageContingency')->name('user.manage.contingency')->middleware('check.will');
        Route::get('add-contingency/{id?}', 'Will\Contingency\ContingencyController@addContingency')->name('user.add.contingency')->middleware('check.will');
        Route::post('save-contingency/{id?}', 'Will\Contingency\ContingencyController@saveContingency')->name('save.contingency');
        Route::get('delete-contingency/{id?}', 'Will\Contingency\ContingencyController@deleteContingency')->name('delete.contingency');
        Route::get('view-contingency/{willid?}/{id?}', 'Will\Contingency\ContingencyController@viewContingency')->name('user.view.contingency');
        Route::post('update-contingency/{id?}', 'Will\Contingency\ContingencyController@updateContingency')->name('update.contingency');

        //Letter of Instruction
        Route::get('letter_of_instruction/{id?}', 'Will\LetterOfInstruction\LOIController@addLOI')->name('user.add.loi')->middleware('check.will');
        Route::post('save-loi/{id?}', 'Will\LetterOfInstruction\LOIController@saveLOI')->name('save.loi');
        Route::post('update-loi/{id?}', 'Will\LetterOfInstruction\LOIController@updateLOI')->name('update.loi');

        //Other Assets
        Route::get('manage-other-assets/{id?}', 'Will\OtherAssets\OtherAssetsController@manageOtherAssets')->name('user.manage.otherAssets')->middleware('check.will');
        Route::get('add-other-assets/{id?}', 'Will\OtherAssets\OtherAssetsController@addOtherAssets')->name('user.add.otherAssets')->middleware('check.will');
        Route::post('save-other-assets/{id?}', 'Will\OtherAssets\OtherAssetsController@saveOtherAssets')->name('save.otherAssets');
        Route::get('delete-other-assets/{id?}', 'Will\OtherAssets\OtherAssetsController@deleteOtherAssets')->name('delete.otherAssets');
        Route::get('edit-other-assets/{willid?}/{id?}', 'Will\OtherAssets\OtherAssetsController@editOtherAssets')->name('user.edit.otherAssets');
        Route::post('update-other-assets/{id?}', 'Will\OtherAssets\OtherAssetsController@updateOtherAssets')->name('update.otherAssets');

        //Residual Assets
        Route::get('manage-residual-assets/{id?}', 'Will\ResidualAssets\ResidualAssetsController@manageResidualAssets')->name('user.manage.residualAssets')->middleware('check.will');
        Route::get('add-residual-assets/{id?}', 'Will\ResidualAssets\ResidualAssetsController@addResidualAssets')->name('user.add.residualAssets')->middleware('check.will');
        Route::post('save-residual-assets/{id?}', 'Will\ResidualAssets\ResidualAssetsController@saveResidualAssets')->name('save.residualAssets');
        Route::get('delete-residual-assets/{id?}', 'Will\ResidualAssets\ResidualAssetsController@deleteResidualAssets')->name('delete.residualAssets');
        Route::get('edit-residual-assets/{willid?}/{id?}', 'Will\ResidualAssets\ResidualAssetsController@editResidualAssets')->name('user.edit.residualAssets');
        Route::post('update-residual-assets/{id?}', 'Will\ResidualAssets\ResidualAssetsController@updateResidualAssets')->name('update.residualAssets');

        // Witness witnessDateCheck
        Route::get('manage-witness/{id?}', 'Will\Witness\WitnessController@manageWitness')->name('user.manage.witness')->middleware('check.will');
        Route::get('add-witness/{id?}', 'Will\Witness\WitnessController@addWitness')->name('user.add.witness')->middleware('check.will');
        Route::post('save-witness/{id?}', 'Will\Witness\WitnessController@saveWitness')->name('save.witness');
        Route::get('delete-witness/{id?}', 'Will\Witness\WitnessController@deleteWitness')->name('delete.witness');
        Route::get('edit-witness/{willid?}/{id?}', 'Will\Witness\WitnessController@updateWitness')->name('user.edit.witness');
        Route::post('update-witness/{id?}', 'Will\Witness\WitnessController@updateWitness')->name('update.witness');
        Route::get('view-witness/{id?}/{slug?}', 'Will\Witness\WitnessController@viewWitness')->name('view.witness');
        Route::post('witness-date-check', 'Will\Witness\WitnessController@witnessDateCheck')->name('witness.date.check');
        Route::post('witness-aadharnumber-check', 'Will\Witness\WitnessController@checkAadharNumber')->name('check.witness.aadharnumber');

        // Introduction
        Route::get('introduction/{id?}', 'Will\WillController@introduction')->name('introduction')->middleware('check.will');

        Route::get('consultation', 'Dashboard\DashboardController@consultation')->name('user.consultation');
        Route::post('store-calendly-event-data', 'Dashboard\DashboardController@storeCalendlyEventData');
        Route::get('consultation-events', 'Dashboard\DashboardController@consultationEvents')->name('consultation-events');
        Route::post('store-consultation-events-payment', 'Dashboard\DashboardController@storeConsultationEventsPayment');
    });

	Route::group(['namespace' => 'test'], function() {

	});

	// For Same pages for both
    Route::get('change-password', 'User\Profile\ProfileController@changePassword')->name('change.password');
    Route::post('update-password', 'User\Profile\ProfileController@passwordUpdate')->name('update.password');

});


//Clear configurations:
Route::get('/config-clear', function() {
    $status = Artisan::call('config:clear');
    return '<h1>Configurations cleared</h1>';
});

//Clear cache:
Route::get('/cache-clear', function() {
    $status = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function() {
    $status = Artisan::call('config:cache');
    return '<h1>Configurations cache cleared</h1>';
});


//Nominee Executor Login
Route::get('nominee-executor-login', 'Modules\NomineeExecutor\NomineeExecutorController@loginForm')->name('nominee.executor.login');
Route::any('check-nominee_executor-login', 'Modules\NomineeExecutor\NomineeExecutorController@customLogin')->name('check.nominee_executor.login');
Route::get('nominee-otp-verification/{ben_id?}', 'Modules\NomineeExecutor\NomineeExecutorController@otpPageN')->name('nominee.otp.verification');
Route::get('executor-otp-verification/{exe_id?}', 'Modules\NomineeExecutor\NomineeExecutorController@otpPageE')->name('executor.otp.verification');
Route::post('nominee-executor-otp-verify', 'Modules\NomineeExecutor\NomineeExecutorController@otpVerify')->name('nominee.executor.otp.verify');
Route::get('nominee-upload-file/{ben_id?}', 'Modules\NomineeExecutor\NomineeExecutorController@uploadFileN')->name('nominee.upload.file')->middleware('check.ben');
Route::get('executor-upload-file/{exe_id?}', 'Modules\NomineeExecutor\NomineeExecutorController@uploadFileE')->name('executor.upload.file')->middleware('check.exe');
Route::post('save-upload-file', 'Modules\NomineeExecutor\NomineeExecutorController@saveFile')->name('save.upload.file');
Route::get('nominee-executor/{id?}', 'Modules\NomineeExecutor\NomineeExecutorController@downloadFile')->name('nominee.executor');
Route::get('nominee-executor-resend-otp/{otp?}', 'Modules\NomineeExecutor\NomineeExecutorController@resendOTP')->name('nominee.executor.resend.otp');

//payment
Route::post('payment', 'Modules\Payment\PaymentController@payment')->name('payment');
Route::post('store-payment', 'Modules\Payment\PaymentController@storePayment')->name('store.payment');
Route::get('payment-success/{willid?}', 'Modules\Payment\PaymentController@successPayment')->name('success.payment');

Route::get('calendly-test', 'CalendlyController@calendlyTest');
Route::get('calendly-authorize', 'CalendlyController@calendlyAuthorize');
