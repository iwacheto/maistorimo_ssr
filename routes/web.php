<?php
use Illuminate\Support\Facades\Auth;
$route = config('app.url');
Route::domain('{subdomain}.'. $route)->group(function () {
// Route::prefix('website/{subdomain}')->group(function () {
    Route::get('/', 'Website\WebsiteController@index');
    Route::get('/about', 'Website\WebsiteController@about');
    Route::get('/contact', 'Website\WebsiteController@contact');
    Route::get('/portfolio', 'Website\WebsiteController@portfolio');
    Route::get('/portfolio/{title}', 'Website\WebsiteController@portfolioDetails');
    Route::get('/services', 'Website\WebsiteController@services');
    Route::get('/terms', 'Website\WebsiteController@terms');
    Route::get('/services/{service}', 'Website\WebsiteController@serviceDetail');
});
//Front Page Project Routes
Route::get('all-projects', 'Front\ProjectsController@getProjects');
Route::get('fetch-projects', 'Front\ProjectsController@fetchProjects');
Route::get('projects', 'Front\ProjectsController@applyFilter');
Route::get('all_tags', 'Vendor\CategoriesController@getTags');
Route::get('/last_projects', 'Front\ProjectsController@getPopularProjects');
Route::get('/services_all', 'Front\ServiceController@applyServiceFilter');
Route::get('/last-services', 'Front\ServiceController@getLastService');
Route::get('/filter/tag', 'Front\ProjectsController@applybyTagFilter');
Route::get('browse', 'Front\BrowseController@browse');
Route::get('/set_session', 'Front\BrowseController@setSession');
Route::post('/check_username', 'Front\BrowseController@checkUsername');
Route::post('/check_email', 'Front\BrowseController@checkEmail');
Route::post('/contacts', 'Front\BrowseController@setQueueContact');
Route::get('projects/{id}', 'Front\ProjectsController@getProject');
Route::get('/service_category', 'Front\ServiceController@getServiceCategories');
Route::get('autocomplete/search', 'Front\ProjectsController@autcompleteCity');
Route::get('/service_detail/{id}', 'Front\ServiceController@getServices');
Route::post('/analytics', 'Front\ServiceController@getAnalysis');
Route::post('/contact_analytcs', 'Front\ProfileController@contactAnalysis');
Route::get('/projects_meta/{id}', 'Front\ProfileController@getMeta');
Route::prefix('profiles')->group(function () {
    Route::get('{id}', 'Front\ProfileController@getProfile');
});
Route::prefix('categories')->group(function () {
    Route::get('/get', 'Vendor\CategoriesController@getCategories');
    Route::get('/getcat', 'Vendor\CategoriesController@getSubCategories');
});
Route::prefix('terms')->group(function () {
    Route::get('/get/{id}', 'Vendor\CategoriesController@getTerms');
});
Route::any('is-auth', 'Vendor\AuthController@isAuth');
Route::any('auth-user', 'Vendor\AuthController@isAuth');
Route::get('/get_user', 'VendorController@getUser');
// Vendor routes
Route::prefix('vendor')->middleware('auth')->group(function () {
    Route::get('/', 'Vendor\ProfileController@index');
    Route::prefix('dashboard')->group(function () {
        Route::get('/get', 'Vendor\DashboardController@get');
    });
    Route::prefix('tags')->group(function () {
        Route::get('/get', 'Vendor\TagsController@getTags');
    });
    Route::get('/uploadImage', 'Vendor\UploadController@uploadImage');
    Route::get('/service_category', 'Vendor\ProjectsController@getServiceCategories');
    Route::prefix('projects')->group(function () {
        Route::get('/get', 'Vendor\ProjectsController@getProjects');
        Route::get('/analytics', 'Vendor\ProjectsController@getProjectsAnalitycs');
        Route::post('/filter_analitycs', 'Vendor\ProjectsController@getFilterProjectsAnalitycs');
        Route::post('/add', 'Vendor\ProjectsController@addProject');
        Route::get('/get/{id}', 'Vendor\ProjectsController@getProject');
        Route::post('/{id}/edit', 'Vendor\ProjectsController@editProject');
        Route::delete('/{id}/delete', 'Vendor\ProjectsController@deleteProject');
        Route::get('/autocomplete/search', 'Vendor\ProjectsController@autcompleteCity');
    });
    Route::prefix('website')->group(function () {
        Route::post('/save', 'Vendor\WebsiteController@saveWebsite');
    });
    Route::prefix('galleries')->group(function () {
        Route::post('/uploadImage', 'Vendor\UploadController@uploadImage');
    });
    Route::prefix('profile')->group(function () {
        Route::post('/uploadImage', 'Vendor\UploadController@uploadProfilePhoto');
        Route::post('/uploadMainImage', 'Vendor\UploadController@uploadProfileMainPhoto');
        Route::post('/save', 'Vendor\ProfileController@saveProfile');
        Route::get('/get', 'Vendor\ProfileController@getProfile');
        Route::post('/changePassword', 'Vendor\ProfileController@changePassword');
    });
    Route::prefix('blog')->group(function () {
        Route::post('/create-article', 'Vendor\BlogController@createArticle');
        Route::get('/categories', 'Vendor\BlogController@getCategories');
        Route::get('/articles', 'Vendor\BlogController@getArticles');
        Route::get('/articles/{id}', 'Vendor\BlogController@getArticle');
        Route::delete('/articles/{id}', 'Vendor\BlogController@deleteArticle');
        Route::post('/articles/edit/{id}', 'Vendor\BlogController@updateArticle');
    });
    Route::prefix('service')->group(function () {
        Route::post('/', 'Vendor\ServiceController@store');
        Route::get('/', 'Vendor\ServiceController@index');
        Route::get('/analytics', 'Vendor\ServiceController@getServiceAnalytics');
        Route::get('/contact_analytics', 'Vendor\ServiceController@getContactsAnalytics');
        Route::post('/contact_filter', 'Vendor\ServiceController@filterContactsAnalytics');
        Route::post('/filter_analytics', 'Vendor\ServiceController@filterServicesAnalytics');
        Route::get('/getForSelect', 'Vendor\ServiceController@getForSelect');
        Route::get('/{id}', 'Vendor\ServiceController@edit');
        Route::put('/{id}', 'Vendor\ServiceController@update');
        Route::delete('/{id}', 'Vendor\ServiceController@destroy');
    });
});
Route::prefix('projects')->group(function () {
    Route::get('/get', 'Front\ProjectsController@getProjects');
    Route::get('/get/{id}', 'Front\ProjectsController@getProject');
});
Route::prefix('blog')->group(function () {
    Route::get('/articles', 'Front\BlogController@getArticles');
    Route::get('/articles/latest', 'Front\BlogController@getLatestArticles');
    Route::get('/articles/latest-from-category/{categoryId}', 'Front\BlogController@getLatestFromCategory');
    Route::get('/articles/{id}', 'Front\BlogController@getArticle');
});
Route::prefix('website')->group(function () {
    Route::get('/{user}/home', 'Website\WebsiteController@index');
    Route::get('/{user}/about', 'Website\WebsiteController@about');
    Route::get('/{user}/contact', 'Website\WebsiteController@contact');
    Route::get('/{user}/portfolio', 'Website\WebsiteController@portfolio');
    Route::get('/{user}/portfolio/{title}', 'Website\WebsiteController@portfolioDetails');
    Route::get('/{user}/services', 'Website\WebsiteController@services');
    Route::get('/{user}/services/{service}', 'Website\WebsiteController@serviceDetail');
});
Route::post('/request-invite', 'Front\InviteController@addInviteRequest');
Auth::routes();
Route::get('/{url?}', 'VueController');
Route::get('/newsletter/{url?}', 'VueController');
Route::get('/newsletter/{id}/{url?}', 'VueController');
// Route::get('/profile/{url?}', 'VueController');
Route::get('/project/details/{url?}', 'VueController');
Route::get('/service/details/{url?}', 'VueController');
Route::get('/profile/{url?}', 'VueController');