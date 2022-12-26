<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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



// login route
require __DIR__ . '/auth.php';


// Without auth rout

// Help Center
Route::get('/', [FrontendController::class, 'welcome'])->name('/');
Route::get('knowledge-single/{category_id}/{id}', [FrontendController::class, 'singleKnowledge'])->name('help-single-knowledge');
Route::get('category-single/{category_id}', [FrontendController::class, 'singleCategory'])->name('help-single-category');
Route::get('sub-category-single/{sub_category_id}', [FrontendController::class, 'singleSubcategory'])->name('help-single-sub-category');

Route::get('search/', [FrontendController::class, 'knowledgeSearch'])->name('knowledge-search');

// Open Tickets
Route::get('open-ticket', [FrontendController::class, 'openTicket'])->name('open-ticket');
Route::post('store-ticket', [FrontendController::class, 'ticketStore'])->name('store-ticket');
// FAQ
Route::get('/faqs', [FrontendController::class, 'faqs'])->name('faqs.show');



// privacy policies
Route::get('privacy-policies', [FrontendController::class, 'privacyPolicies'])->name('view.privacy-policies');
// terms of use
Route::get('terms-of-use', [FrontendController::class, 'termsOfUse'])->name('view.terms-of-use');
// Delete page
Route::get('delete-account', [FrontendController::class, 'deleteAccount'])->name('view.delete-page');

Route::get('contact', [FrontendController::class, 'contact'])->name('view-contact');
Route::post('contact', [FrontendController::class, 'contactStore'])->name('store-contact');


// Frontend auth route
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [FrontendController::class, 'dashboard'])->name('dashboard');
    Route::get('user/profile', [FrontendController::class, 'userProfile'])->name('user.profile');
    Route::get('user/change-password', [FrontendController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('user/reset-password', [FrontendController::class, 'updateUserPassword'])->name('user.update.password');
    Route::post('user/profile/update', [FrontendController::class, 'userProfileUpdate'])->name('user.profile.update');

    Route::get('user/ticket/{ticket}', [FrontendController::class, 'ticketShow'])->name('user.ticket.show');
    Route::post('user/ticket-reply/store', [FrontendController::class, 'storeTicketReply'])->name('user.ticketReply.store');
    // Store create knowledge
    /*Route::get('user/create-knowledge', [FrontendController::class, 'createKnowledge'])->name('create-knowledge.show');
    Route::post('store-knowledge', [FrontendController::class, 'storeKnowledge'])->name('store-knowledge');*/

});

// Admin auth route
Route::middleware(['auth', 'authadmin'])->group(function () {

    Route::get('/admin/dashboard', [BackendController::class, 'adminDashboard'])->name('admin.dashboard');

    // Profile Upadate Settings
    Route::get('admin/profile', [BackendController::class, 'adminProfile'])->name('admin.profile');
    Route::post('admin/profile/update', [BackendController::class, 'adminProfileUpdate'])->name('admin.profile.update');

    // Change Password Settings
    Route::get('admin/change-password', [BackendController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('admin/reset-password', [BackendController::class, 'updateadminPassword'])->name('admin.update.password');

    // General Settings
    Route::get('admin/general-settings', [BackendController::class, 'generalSettings'])->name('admin.general-settings');
    Route::post('admin/store-general-settings', [BackendController::class, 'storeGeneralSetting'])->name('admin.store-general-settings');
    Route::post('admin/update-general-settings/{id}', [BackendController::class, 'updateGeneralSettings'])->name('admin.update-general-settings');

    // Logo And Favicon Settings
    Route::get('admin/logo-favicon', [BackendController::class, 'logoFavicon'])->name('admin.logo-favicon');
    Route::post('admin/store-logo-favicon', [BackendController::class, 'storeLogoFavicon'])->name('admin.store-logo-favicon');
    Route::post('admin/update-logo-favicon/{id}', [BackendController::class, 'updateLogoFavicon'])->name('admin.update-logo-favicon');



    // Contact Message Settings
    Route::get('admin/contact', [BackendController::class, 'contact'])->name('admin.contact');
    Route::get('admin/contact-delete/{id}', [BackendController::class, 'contactDelete'])->name('admin.delete-contact');
    Route::get('admin/contact-view/{id}', [BackendController::class, 'contactview'])->name('admin.view-contact');

    // All registered users
    Route::get('admin/registered-users', [BackendController::class, 'registeredUsers'])->name('admin.registered-users');
    Route::get('admin/view-registered-users/{id}', [BackendController::class, 'registeredUsersView'])->name('admin.view.registered-users');
    Route::get('admin/delete-registered-users/{id}', [BackendController::class, 'registeredUsersDelete'])->name('admin.delete.registered-users');

    // Create New User
    Route::get('admin/create-user', [BackendController::class, 'createUser'])->name('admin.create-user');
    Route::post('admin/store-create-user', [BackendController::class, 'storeCreateUser'])->name('admin.store-create-user');

    // Create New Admin
    Route::get('admin/create-admin', [BackendController::class, 'createAdmin'])->name('admin.create-admin');
    Route::post('admin/store-create-admin', [BackendController::class, 'storeCreateAdmin'])->name('admin.store-create-admin');

    Route::get('admin/share-a-secret', [BackendController::class, 'shareASecretView'])->name('admin.share-a-secret-view');

    // Create Categories
    Route::get('help-desk/category-index', [BackendController::class, 'allCategories'])->name('admin.categories');
    Route::get('help-desk/category/form/{id?}', [BackendController::class, 'createCategorForm'])->name('admin.create-category-form');
    Route::post('help-desk/store-category/{id?}', [BackendController::class, 'storeCategory'])->name('admin.store-category');
    Route::get('help-desk/category-delete/{id}', [BackendController::class, 'categoryDelete'])->name('admin.delete-category');

    // Create Sub Categories
    Route::get('help-desk/sub-category-index', [BackendController::class, 'allSubCategories'])->name('admin.sub-categories');
    Route::get('help-desk/sub-category/form/{id?}', [BackendController::class, 'createSubCategorForm'])->name('admin.create-sub-category-form');
    Route::post('help-desk/store-sub-category/{id?}', [BackendController::class, 'storeSubCategory'])->name('admin.store-sub-category');
    Route::get('help-desk/sub-category-delete/{id}', [BackendController::class, 'subCategoryDelete'])->name('admin.delete-sub-category');
   
    // Create Knowledge
    Route::get('admin/knowledge-index', [BackendController::class, 'allKnowledge'])->name('admin.knowledge');
    Route::get('admin/knowledge/form/{id?}', [BackendController::class, 'createKnowledgeForm'])->name('admin.create-knowledge-form');
    Route::post('admin/knowledge-store/{id?}', [BackendController::class, 'storeKnowledge'])->name('admin.knowledge.store');
    Route::get('admin/knowledge-delete/{id}', [BackendController::class, 'knowledgeDelete'])->name('admin.delete-knowledge');
    Route::get('admin/knowledge-subcategory/{id}', [BackendController::class, 'getKnowledgeSubcategory']);

    // Create FAQ 
    Route::get('admin/faqs', [BackendController::class, 'faqIndex'])->name('admin.faq.index');
    Route::get('admin/faq/{faq?}', [BackendController::class, 'faqShow'])->name('admin.faq.form');
    Route::post('admin/store-faq/{faq?}', [BackendController::class, 'faqStore'])->name('admin.faq.store');
    Route::get('admin/faq-activation/{faq}', [BackendController::class, 'faqActivation']);
    Route::get('admin/faq-delete/{faq}', [BackendController::class, 'faqDelete'])->name('admin.delete-faq');

    // Tickets show
    Route::get('admin/tickets', [BackendController::class, 'ticketsIndex'])->name('admin.tickets.index');
    Route::get('admin/ticket/{ticket}', [BackendController::class, 'ticketShow'])->name('admin.ticket.show');
    Route::get('admin/ticket-delete/{ticket}', [BackendController::class, 'ticketDelete'])->name('admin.delete-ticket');

    Route::post('admin/ticket-reply/store', [BackendController::class, 'storeTicketReply'])->name('admin.ticketReply.store');



});
