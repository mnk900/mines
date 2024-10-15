<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\ApplicationCommentsController;
use App\Http\Controllers\Admin\ApplicationForSurveyController;
use App\Http\Controllers\ApplicationsForDirectorController;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Controllers\ShapefileController;




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

Route::get('/','App\Http\Controllers\HomeController@index');

Auth::routes();

// Route::get('/admin', function () {
//     return view('admin.index');
// })->name('admin.index')->middleware('admin');
Route::middleware(['check.session'])->group(function () {
Route::resource('/admin','App\Http\Controllers\Admin\AdminController',['except'=>['show','create','edit']])->middleware('admin');
Route::resource('/admin/pages','App\Http\Controllers\Admin\PagesController',['except'=>['show']]);
Route::resource('/admin/blog','App\Http\Controllers\Admin\BlogController',['except'=>['show']]);
Route::resource('/admin/users','App\Http\Controllers\Admin\UsersController',['except'=>['show']]);
Route::resource('/admin/sliders','App\Http\Controllers\Admin\SlidersController',['except'=>['show']]);
Route::resource('/admin/events','App\Http\Controllers\Admin\EventsController',['except'=>['show']]);
Route::resource('/admin/gallery','App\Http\Controllers\Admin\GalleryController',['except'=>['show']]);
Route::resource('/admin/images','App\Http\Controllers\Admin\GalleryImagesController',['except'=>['show']]);
Route::resource('/admin/about','App\Http\Controllers\Admin\AboutController',['except'=>['show']]);
Route::resource('/admin/teams','App\Http\Controllers\Admin\TeamsController',['except'=>['show']]);
Route::resource('/admin/contact_us','App\Http\Controllers\Admin\ContactUsController',['except'=>['show','create','edit']]);
Route::resource('/admin/areas_of_work','App\Http\Controllers\Admin\AreasOfWorkController',['except'=>['show']]);
Route::resource('/admin/partners','App\Http\Controllers\Admin\PartnersController',['except'=>['show']]);
Route::resource('/admin/settings','App\Http\Controllers\Admin\SettingsController',['except'=>['show']]);

Route::resource('surveys', ApplicationForSurveyController::class);

Route::get('/blog', [App\Http\Controllers\BlogPostController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogPostController::class, 'view'])->name('blog.view');
Route::get('/events/{id}', [App\Http\Controllers\EventsController::class, 'view'])->name('events.view');
Route::get('/gallery/{id}', [App\Http\Controllers\GalleryController::class, 'view'])->name('gallery.view');



// Applications routes
Route::post('/sendtosurvey', [App\Http\Controllers\Admin\AdminController::class, 'sendtosurvey'])->name('sendtosurvey');
Route::get('/showmapdata', [App\Http\Controllers\ApplicationsController::class, 'showfullMap'])->name('showmapdata');
Route::post('/checkOverlap', [App\Http\Controllers\ApplicationsController::class, 'checkOverlap'])->name('checkOverlap');
Route::get('/addMyCoordinates', [App\Http\Controllers\ApplicationsController::class, 'addMyCoordinates'])->name('addcoordinates');
Route::post('/savepolygons', [App\Http\Controllers\ApplicationsController::class, 'savePolygon']);


// Survey routes '/save-polygon'

Route::get('/survey/{id}', [App\Http\Controllers\ApplicationsController::class, 'viewapplicationsurvey'])->name('applicationsurveydetails');


// Application AD routes
// for individual applications profile
Route::get('/leaseapplications/{appid}', [App\Http\Controllers\ApplicationsController::class, 'viewAppDetails'])->name('lease_application_details');


Route::get('/applications/{email}', [App\Http\Controllers\ApplicationsController::class, 'viewapplications'])->name('applicationsdetails');
// for all applications profile
Route::get('/applications/leaseapplications/{email}', [App\Http\Controllers\ApplicationsController::class, 'applicationsprofile'])->name('user.applications');

Route::post('/uploadchallan', [App\Http\Controllers\ApplicationsController::class, 'uploadchallan'])->name('uploadchallan');
Route::get('/applications/leasegems/{name}', [App\Http\Controllers\ApplicationsController::class, 'applicationsgemprofile'])->name('user.applicationsgem');
Route::post('/verify/firm', [ApplicationCommentsController::class, 'verifyfirm'])->name('verify.firm');
Route::post('/verify/deed', [ApplicationCommentsController::class, 'verifydeed'])->name('verify.deed');
Route::post('/verify/challan', [ApplicationCommentsController::class, 'verifychallan'])->name('verify.challan');
Route::post('/verify/coordinates', [ApplicationCommentsController::class, 'verifycoordinates'])->name('verify.coordinates');
Route::get('/applications/generatechallan/{name}', [App\Http\Controllers\ApplicationsController::class, 'generatechallan'])->name('user.challans');
Route::get('/getchallanfee', [ApplicationsController::class, 'getChallanFee'])->name('getchallanfee');
Route::get('/getexistingchallans', [ApplicationsController::class, 'getExistingChallans'])->name('getExistingchallans');
Route::post('/savechallan', [ApplicationsController::class, 'saveChallan'])->name('challan.save');


/// checklists route
Route::get('/checklist-mininglease', [ApplicationsController::class, 'clistminninglease'])->name('MiningLease');
Route::get('/checklist-explorationlicense', [ApplicationsController::class, 'clistexplorationlicense'])->name('ExplorationLicense');
Route::get('/checklist-reconnaissancelicense', [ApplicationsController::class, 'clistreconnaissancelicense'])->name('ReconnaissanceLicense');
Route::get('/checklist-depositretensionlicense', [ApplicationsController::class, 'clistdepositretensionlicense'])->name('DepositRetensionLicense');



Route::post('/button-click', [ApplicationsController::class, 'handlecheckoverlapButtonClick'])->name('checkoverlapbutton.click');

// applications for director routes

Route::prefix('applications-for-director')->group(function () {
    Route::get('/', [ApplicationsForDirectorController::class, 'index']);
    Route::post('/', [ApplicationsForDirectorController::class, 'store']);
    Route::get('/{id}', [ApplicationsForDirectorController::class, 'show']);
    Route::put('/{id}', [ApplicationsForDirectorController::class, 'update']);
    Route::delete('/{id}', [ApplicationsForDirectorController::class, 'destroy']);
});

Route::post('/sendtodirector', [App\Http\Controllers\ApplicationsForDirectorController::class, 'sendtodirector'])->name('sendtodirector');

/////// Routes to view documentation  ////

Route::get('/view-procedure', function () {
    $path = public_path('documents/Proceduresforapplicants.pdf');  // Path to the Word file
    return response()->file($path);  // Serve the file for download
});

Route::get('/open-doc', function () {
    return view('view-procedure');
});


Route::get('/extract-coordinates', [ShapefileController::class, 'extractCoordinates']);
});

/// These routes does not require authorization
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('home.register');
Route::get('/registergem', [App\Http\Controllers\HomeController::class, 'registergem'])->name('home.registergem');
Route::post('/register_post', [App\Http\Controllers\HomeController::class, 'register_post'])->name('home.register_post');
Route::post('/registergem_post', [App\Http\Controllers\HomeController::class, 'registergem_post'])->name('home.registergem_post');
/*Register Mining */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
// To get the districts and tehsils
Route::get('/districts', [AreaController::class, 'getDistricts']);
Route::get('/tehsils/{districtId}', [AreaController::class, 'getTehsils']);
Route::get('/dropdowns', [AreaController::class, 'showDropdowns']);

/*--------------------------NEW APPLICATIONS FROM REGISTERED COMPANY---------------------*/
Route::get('/new_applications/new_application', [App\Http\Controllers\NewApplicationsController::class, 'new_application'])->name('new_applications.new_application');
Route::post('new_application_store', [App\Http\Controllers\NewApplicationsController::class, 'new_application_store'])->name('new_applications.new_application_store');
/*--------------------------END NEW APPLICATIONS FROM REGISTERED COMPANY---------------------*/
