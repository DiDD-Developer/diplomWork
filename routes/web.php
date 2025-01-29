<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewReactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Роут главной страницы
Route::get('/', [PlaceController::class, 'MainPage'])->name('/');

//Роуты для страницы регистрации
Route::get('/register', [UserController::class, 'RegisterView'])->name('register');
Route::post('/register', [UserController::class, 'RegisterPost']);

//Роуты для страницы авторизации
Route::get('/auth', [UserController::class, 'AuthView'])->name('auth');
Route::post('/auth', [UserController::class, 'AuthPost']);

//Роут для проверки того, что пользователь авторизован
Route::middleware('auth')->group(function(){
    //Роут для проверки на то, что пользователь - администратор
    Route::middleware('role')->group(function(){
        Route::get('/admin', [AdminController::class, 'AdminView'])->name('admin');

        //Роуты для работы с пользователями в таблице users
        Route::get('/admin/AdminUsersView', [AdminController::class, 'AdminUsersView'])->name('AdminUsersView');
        Route::post('/admin/updateUsersView{user}', [AdminController::class, 'UpdateUsersView'])->name('UpdateUsersView');
        Route::post('/admin/removeUser{user}', [AdminController::class, 'RemoveUser'])->name('RemoveUser');

        //Роуты для работы с категориями в таблице categories
        Route::get('/admin/AdminCategoriesTourPlaces', [CategoryController::class, 'CategoryView'])->name('CategoryView');
        Route::post('/admin/AdminCategoriesTourPlaces', [CategoryController::class, 'AddCategoryPost'])->name('AddCategoryPost');
        Route::post('/admin/EditCategoriesTourPlaces{category}', [CategoryController::class, 'UpdateCategoryPost'])->name('UpdateCategoryPost');
        Route::post('/admin/DeleteCategoriesTourPlaces{category}', [CategoryController::class, 'DeleteCategoryPost'])->name('DeleteCategoryPost');

        //Роуты для работы с тур. местами в таблице places
        Route::get('/admin/AdminTourPlaces', [PlaceController::class, 'PlaceView'])->name('PlaceView');
        Route::post('/admin/AdminTourPlaces', [PlaceController::class, 'AddPlacePost']);
        Route::post('/admin/updatePlace{place}', [PlaceController::class, 'UpdatePlacePost'])->name('UpdatePlacePost');
        Route::post('/admin/removePlace{place}', [PlaceController::class, 'RemovePlace'])->name('RemovePlace');

    });

    //Роут страницы личного кабинета
    Route::get('/PersonalAccount', [UserController::class, 'PersonalAccountView'])->name('PersonalAccount');

    //Роут для смены параметров аккаунта на странице Личного кабинета
    Route::post('/PersonalAccount/EditDataAccountPost{user}', [UserController::class, 'EditDataAccountPost'])->name('EditDataAccountPost');

    //Роут для удаления аккаунта из БД на странице Личного кабинета
    Route::post('/PersonalAccount/DeleteAccountPost/{user}', [UserController::class, 'DeleteAccountPost'])->name('DeleteAccountPost');

    //Роут для добавления и просмотра избранных тур. мест на странице Личного кабинета
    Route::post('PersonalAccount/favorites/add/{place}', [FavoriteController::class, 'store'])->name('favorites.add');

    //Роут для удаления тур. места из Избранных на странице Личного кабинета
    Route::post('PersonalAccount/favorites/remove/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.remove');

    //Роут для отправки отзыва о тур. месте
    Route::post('/TouristPlace/place/{place}/reviews', [ReviewController::class, 'CreateReviewPost'])->name('CreateReviewPost');

    //роут для изменения параметров отзыва о тур. месте
    Route::post('/TouristPlace/editReview/{review}', [ReviewController::class, 'EditReviewPost'])->name('EditReviewPost');

    //Роут для удаления отзыва о тур. месте
    Route::post('/TouristPlace/removeReview/{place}', [ReviewController::class, 'RemoveReviewPost'])->name('RemoveReviewPost');

    //Роут для возможности оставить лайк/дизлайк на отзыв
    Route::post('/reviews/{review}/reaction', [ReviewReactionController::class, 'toggleReaction'])->name('reviews.toggleReaction');

    //Роут для выхода из учетной записи
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

//Роут страницы "Пользовательское соглашение"
Route::view('/UserAgreement', 'UserAgreement')->name('UserAgreement');

//Роут страницы "Политика конфиденциальности"
Route::view('/PrivacyPolicy', 'PrivacyPolicy')->name('PrivacyPolicy');

//Роут страницы "Часто задаваемые вопросы (FAQ)"
Route::view('/faq', 'faq')->name('faq');

//Роут страницы "Наши партнеры"
Route::view('/OurPartners', 'OurPartners')->name('OurPartners');

//Роут страницы "Советы путешественникам"
Route::view('/TravelTips', 'TravelTips')->name('TravelTips');

//Роут страницы "О сайте"
Route::view('/about', 'about')->name('about');

//Роут страницы "Челябинск в разные времена года"
Route::view('/DifferentSeasons', 'MainSlider.DifferentSeasons')->name('DifferentSeasons');

//Роут страницы "Панорамный вид на Челябинск"
Route::view('/PanoramicViewOnCity', 'MainSlider.PanoramicViewOnCity')->name('PanoramicViewOnCity');

//Роут страницы "Культура Челябинска: богатое наследие и ключевые культурные места"
Route::view('/CultureOfTheCity', 'MainSlider.CultureOfTheCity')->name('CultureOfTheCity');

//Роут страницы "Туристические места в Челябинске"
Route::get('/TouristPlace', [PlaceController::class, 'TouristPlaceView'])->name('TouristPlace');

//Роут страницы для выбранного тур. места из каталога
Route::get('/TouristPlace/place/{place}', [PlaceController::class, 'catalogPlacesView'])->name('catalogPlacesView');
