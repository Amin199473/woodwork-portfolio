<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\admin\CategoryController;
use App\Http\Controllers\Api\admin\FAQController;
use App\Http\Controllers\Api\admin\MediaController;
use App\Http\Controllers\Api\admin\PostController;
use App\Http\Controllers\Api\admin\ProjectController;
use App\Http\Controllers\Api\admin\SettingController;
use App\Http\Controllers\Api\admin\SliderController;
use App\Http\Controllers\Api\admin\TeamMembersController;
use App\Http\Controllers\Api\admin\TestimonialController;
use App\Http\Controllers\Api\admin\UserController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\user\CommentController;
use App\Http\Controllers\Api\user\ContactUsController;
use App\Http\Controllers\Api\user\LikeAndDislikeController;
use App\Http\Controllers\Api\user\ProfileController;
use App\Http\Controllers\Api\user\TickectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('admin-register', [AdminAuthController::class, 'AdminRegister'])->name('AdminRegister');
Route::post('admin-login', [AdminAuthController::class, 'AdminLogin'])->name('AdminLogin');

// Route::group(
//     ['middleware' => 'admin:admin-api'],
//     function () {
Route::post('admin-logout', [AdminAuthController::class, 'AdminLogout'])->name('AdminLogout');
Route::post('admin-refresh', [AdminAuthController::class, 'AdminRefresh'])->name('AdminRefresh');
Route::get('admin-me', [AdminAuthController::class, 'AdminMe'])->name('AdminMe');
Route::apiResource('category', CategoryController::class);
Route::apiResource('post', PostController::class)->except(['update']);
Route::get('postCategories', [PostController::class, 'getPostCategories'])->name('postCategories');
Route::post('edit/post/{id}', [PostController::class, 'editPost'])->name('editPost');
Route::post('media-image', [MediaController::class, 'UploadImage'])->name('UploadImage');
Route::get('media-images', [MediaController::class, 'getImages'])->name('images');
Route::get('media-deleteImage/{id}', [MediaController::class, 'deleteImage'])->name('deleteImage');
Route::apiResource('slider', SliderController::class)->except(['update']);
Route::post('edit/slider/{id}', [SliderController::class, 'editSlider'])->name('editSlider');
Route::apiResource('member', TeamMembersController::class)->except(['update']);
Route::post('edit/member/{id}', [TeamMembersController::class, 'editMember'])->name('editMember');
Route::apiResource('project', ProjectController::class)->except(['update']);
Route::get('projectCategories', [ProjectController::class, 'getPojectCategories'])->name('projectCategories');
Route::get('getRandProject', [ProjectController::class, 'getRandProject'])->name('getRandProject');
Route::get('getProjectGalleries', [ProjectController::class, 'getProjectGalleries'])->name('getProjectGalleries');
Route::post('edit/project/{id}', [ProjectController::class, 'editProject'])->name('editProject');
Route::delete('delete/imageGallery/{id}', [ProjectController::class, 'DeleteImageGallery'])->name('DeleteImageGallery');
Route::apiResource('testimonial', TestimonialController::class)->except(['update']);
Route::post('edit/testimonial/{id}', [TestimonialController::class, 'editTestimonial'])->name('editTestimonial');
Route::get('getUsers', [UserController::class, "GetUsers"])->name("getUsers");
Route::get('getUser/{userId}', [UserController::class, "GetUserById"])->name("getUser");
Route::post('user/updateByAdmin/{userId}', [UserController::class, "UpdateUser"])->name("userUpdateByAdmin");
Route::post('user/add/', [UserController::class, "AddUserByAdmin"])->name("userAdd");
Route::get('getSiteSetting', [SettingController::class, "getSiteSetting"])->name("getSiteSetting");
Route::post('saveSiteSetting', [SettingController::class, "saveSiteSetting"])->name("saveSiteSetting");
Route::get('FAQ/getAll', [FAQController::class, 'getAllFAQ'])->name('getAllFAQ');
Route::post('FAQ/add', [FAQController::class, 'AddFAQ'])->name('FAQadd');
Route::post('FAQ/edit/{id}', [FAQController::class, 'EditFAQ'])->name('editFAQ');
Route::delete('FAQ/delete/{id}', [FAQController::class, 'DeleteFAQ'])->name('deleteFAQ');
Route::get('get/FAQ/{id}', [FAQController::class, 'GetFAQ'])->name('getFAQ');

//     }
// );

//////////////////////////////// User Routes //////////////////////////////////////////////////////
Route::post('user-register', [UserAuthController::class, 'UserRegister'])->name('UserRegister');
Route::post('user-login', [UserAuthController::class, 'UserLogin'])->name('UserLogin');
Route::get('user/detail', [UserAuthController::class, 'UserMe'])->name('userDetail');

Route::post('user/profile/update/{userId}', [ProfileController::class, "UpdateUserProfile"])->name("updateUserProfile");
Route::post('admin/profile/update/{adminId}', [ProfileController::class, "UpdateAdminProfile"])->name("updateAdminProfile");

Route::post('add/comment/to/post', [CommentController::class, "AddCommentToPost"])->name("AddCommentToPost");
Route::post('add/comment/to/project', [CommentController::class, "AddCommentToProject"])->name("AddCommentToProject");
Route::get('post/comments/{postId}', [CommentController::class, "getPostComments"])->name("postComments");
Route::get('project/comments/{projectId}', [CommentController::class, "getProjectComments"])->name("projectComments");

Route::post('add/ticket', [TickectController::class, 'AddTicket'])->name('addTicket');
Route::get('all/tickets', [TickectController::class, 'AllTickets'])->name('allTickets');
Route::get('ticket/view/{id}', [TickectController::class, 'TicketView'])->name('ticketView');
Route::get('myTickets/{user_id}', [TickectController::class, 'MyTickets'])->name('myTickets');
Route::post('closeTicket', [TickectController::class, 'CloseTicket'])->name('closeTicket');
Route::get('get/ticket/replies/{user_id}/{subject}', [TickectController::class, 'getTicketReplies'])->name('ticketReplies');

Route::post('/contactUs', [ContactUsController::class, 'ContactUs'])->name('contactUs');
Route::get('countLikes/{post_id}',[LikeAndDislikeController::class,'CountLikeAndDislike'])->name('countLikes');
Route::post('like/post',[LikeAndDislikeController::class,'liked'])->name('likePost');
Route::post('dislike/post',[LikeAndDislikeController::class,'dislike'])->name('dislikePost');
