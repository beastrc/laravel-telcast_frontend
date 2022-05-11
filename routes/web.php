<?php

use App\Helpers\VideoStream;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaginationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MovieController;
use App\Http\Controllers\ImdbController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\User\PlanController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

//## beast test begin
#subdomain
Route::domain('user.' . env('APP_URL'))->group(function () {
    Route::get('/', function () {
        var_dump('123');
    });
});
Route::get('gohome', [HomeController::class, 'testhome'])->name('gohome');

#route
//## subdomain test end

// Artisan Commands
Route::group(['prefix' => 'artisan', 'as' => 'artisan.'], function () {
    Route::get('clear', function () {
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        return 'Successfully cleared !';
    });

    Route::get('migrate', function () {
        Artisan::call('migrate:fresh --seed');
        return 'Successfully migrated and seeded !';
    });
});

Route::get('redirect-to-dashboard', function () {
    if(\Illuminate\Support\Facades\Auth::check()){
        switch (Auth::user()->role) {
            case 'super':
                return redirect()->intended(route('frontend.home'));

            // case 'network_admin':
            //     return redirect()->intended(route('network.dashboard.index'));

            // case 'channel':
            //     return redirect()->intended(route('channel.dashboard.index'));

            // case 'advertiser_admin':
            //     return redirect()->intended(route('advertiser.admin.dashboard.index'));

            // case 'advertiser':
            //     return redirect()->intended(route('advertiser.dashboard.index'));
            
            // case 'campaign':
            //     return redirect('createcampaign');

            case 'user':
                // dd(Auth::user());
                return redirect()->intended(route('frontend.home'));
        }
    }

    abort(404);
});

Route::get('private/media/{id}', function ($id) {
    $media = Media::findOrFail($id);

    $path = storage_path('app/private/' . $media->path);

    $stream = new VideoStream($path);

    return response()->stream(function () use ($stream) {
        $stream->start();
    });
});

// Frontend Routes

Route::group(['prefix' => '', 'as' => 'frontend.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');   

    Route::get('shows/genres/{genre}', [\App\Http\Controllers\Frontend\ShowController::class, 'genres'])->name('shows.genres');

    Route::get('movies/genres/{genre}', [\App\Http\Controllers\Frontend\MovieController::class, 'genres'])->name('movies.genres');

    Route::post('sports/like', [\App\Http\Controllers\Frontend\SportController::class, 'like'])->name('sports.like');
    Route::post('sports/dislike', [\App\Http\Controllers\Frontend\SportController::class, 'dislike'])->name('sports.dislike');

    Route::post('channels/subscribe/{channel}', [\App\Http\Controllers\Frontend\ChannelController::class, 'subscribe'])->name('channels.subscribe');
    Route::post('channels/unsubscribe/{channel}', [\App\Http\Controllers\Frontend\ChannelController::class, 'unsubscribe'])->name('channels.unsubscribe');

    Route::post('likes/like', [\App\Http\Controllers\Frontend\LikeController::class, 'like'])->name('likes.like');
    Route::post('likes/dislike', [\App\Http\Controllers\Frontend\LikeController::class, 'dislike'])->name('likes.dislike');

    Route::resources([
        'watches' => \App\Http\Controllers\Frontend\WatchController::class,
        'board' => \App\Http\Controllers\Frontend\BoardController::class,
        'history' => \App\Http\Controllers\Frontend\HistoryController::class,
        'trending' => \App\Http\Controllers\Frontend\TrendingController::class,
        'recommended' => \App\Http\Controllers\Frontend\TrendingController::class,
        'comments' => \App\Http\Controllers\Frontend\CommentController::class,
        'likes' => \App\Http\Controllers\Frontend\LikeController::class,
    ]);

    Route::resources([
        'genres' => \App\Http\Controllers\Frontend\GenreController::class,
        'languages' => \App\Http\Controllers\Frontend\LanguageController::class,
        'channels' => \App\Http\Controllers\Frontend\ChannelController::class,
        'my_list' => \App\Http\Controllers\Frontend\MyListController::class,
        'favorites' => \App\Http\Controllers\Frontend\FavoriteController::class,
    ]);

    Route::group(['middleware' => 'visitCounter'], function () {
        Route::resources([
            'movies' => \App\Http\Controllers\Frontend\MovieController::class,
            'shows' => \App\Http\Controllers\Frontend\ShowController::class,
            'shows.seasons' => \App\Http\Controllers\Frontend\SeasonController::class,
            'shows.seasons.episodes' => \App\Http\Controllers\Frontend\EpisodeController::class,
            'live' => \App\Http\Controllers\Frontend\LiveController::class,
        ]);
    });

    Route::get('movie', [HomeController::class, 'movie'])->name('movie');
    Route::get('show', [HomeController::class, 'show'])->name('show');
    Route::get('about', [HomeController::class, 'about'])->name('about');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('privacypolicy', [HomeController::class, 'privacyPolicy'])->name('privacypolicy');
    Route::get('pricingplan1', [HomeController::class, 'pricingPlan1'])->name('pricingplan1');
    Route::get('pricingplan2', [HomeController::class, 'pricingPlan2'])->name('pricingplan2');
    Route::get('manageprofile', [HomeController::class, 'manageProfile'])->name('manageprofile');
    Route::get('settings', [HomeController::class, 'settings'])->name('settings');
    Route::get('forgotpassword', [HomeController::class, 'forgotpassword'])->name('forgotpassword');
    Route::get('moviedetails', [HomeController::class, 'moviedetails'])->name('moviedetails');
    Route::get('showdetails', [HomeController::class, 'showdetails'])->name('showdetails');
    Route::get('showsingle', [HomeController::class, 'showsingle'])->name('showsingle');
    Route::get('watchvideo', [HomeController::class, 'watchvideo'])->name('watchvideo');

});

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Superadmin Route Group
    Route::group(['prefix' => 'superadmin', 'as' => 'admin.'], function () {
//        Route::group(['prefix' => 'pagination', 'as' => 'pagination.'], function () {
////            Route::get('genres', [PaginationController::class, 'genres'])->name('genres');
////            Route::get('languages', [PaginationController::class, 'languages'])->name('languages');
//            Route::get('shows', [PaginationController::class, 'shows'])->name('shows');
//            Route::get('seasons', [PaginationController::class, 'seasons'])->name('seasons');
//            Route::get('showSeasons', [PaginationController::class, 'showSeasons'])->name('showSeasons');
//            Route::get('media', [PaginationController::class, 'media'])->name('media');
//        });

//        Route::put('genres/reorder', [GenreController::class, 'reorder'])->name('genres.reorder');

//        Route::post('languages/enable/{language}', [LanguageController::class, 'enable'])->name('languages.enable');
//        Route::post('languages/disable/{language}', [LanguageController::class, 'disable'])->name('languages.disable');

//        Route::post('movies/publish/{movie}', [\App\Http\Controllers\Admin\MovieController::class, 'publish'])->name('movies.publish');
//        Route::post('movies/unpublish/{movie}', [\App\Http\Controllers\Admin\MovieController::class, 'unpublish'])->name('movies.unpublish');
//        Route::post('movies/upload', [\App\Http\Controllers\Admin\MovieController::class, 'upload'])->name('movies.upload');
//
//        Route::post('shows/publish/{show}', [ShowController::class, 'publish'])->name('shows.publish');
//        Route::post('shows/unpublish/{show}', [ShowController::class, 'unpublish'])->name('shows.unpublish');
//
//        Route::post('seasons/publish/{season}', [SeasonController::class, 'publish'])->name('seasons.publish');
//        Route::post('seasons/unpublish/{season}', [SeasonController::class, 'unpublish'])->name('seasons.unpublish');
//
//        Route::post('episodes/publish/{episode}', [EpisodeController::class, 'publish'])->name('episodes.publish');
//        Route::post('episodes/unpublish/{episode}', [EpisodeController::class, 'unpublish'])->name('episodes.unpublish');
//
//        Route::post('live/publish/{live}', [LiveController::class, 'publish'])->name('live.publish');
//        Route::post('live/unpublish/{live}', [LiveController::class, 'unpublish'])->name('live.unpublish');
//
//        Route::post('sports/publish/{sport}', [SportController::class, 'publish'])->name('sports.publish');
//        Route::post('sports/unpublish/{sport}', [SportController::class, 'unpublish'])->name('sports.unpublish');
//
//        Route::post('plans/enable/{plan}', [\App\Http\Controllers\Admin\PlanController::class, 'enable'])->name('plans.enable');
//        Route::post('plans/disable/{plan}', [\App\Http\Controllers\Admin\PlanController::class, 'disable'])->name('plans.disable');
//
//        Route::post('users/active/{user}', [UserController::class, 'active'])->name('users.active');
//        Route::post('users/block/{user}', [UserController::class, 'block'])->name('users.block');

//        Route::resources([
//            'dashboard' => DashboardController::class,
////            'genres' => GenreController::class,
////            'languages' => LanguageController::class,
//            'media' => MediaController::class,
//            'movies' => \App\Http\Controllers\Admin\MovieController::class,
//            'shows' => ShowController::class,
//            'seasons' => SeasonController::class,
//            'episodes' => EpisodeController::class,
//            'live' => LiveController::class,
//            'sports' => SportController::class,
//            'plans' => \App\Http\Controllers\Admin\PlanController::class,
//            'subscriptions' => SubscriptionController::class,
//            'transactions' => \App\Http\Controllers\Admin\TransactionController::class,
//            'users' => UserController::class,
//        ]);
    });

    // Network Route Group
    Route::group(['prefix' => 'network', 'as' => 'network.'], function () {
        Route::post('channels/publish/{channel}', [\App\Http\Controllers\Network\ChannelController::class, 'publish'])->name('channels.publish');
        Route::post('channels/unpublish/{channel}', [\App\Http\Controllers\Network\ChannelController::class, 'unpublish'])->name('channels.unpublish');

        Route::post('operators/active/{operator}', [\App\Http\Controllers\Network\OperatorController::class, 'active'])->name('operators.active');
        Route::post('operators/block/{operator}', [\App\Http\Controllers\Network\OperatorController::class, 'block'])->name('operators.block');

        Route::resources([
            'dashboard' => \App\Http\Controllers\Network\DashboardController::class,
            'channels' => \App\Http\Controllers\Network\ChannelController::class,
            'operators' => \App\Http\Controllers\Network\OperatorController::class
        ]);
    });

    // Channel Route Group
    Route::group(['prefix' => 'channel', 'as' => 'channel.'], function () {
        Route::put('genres/reorder', [\App\Http\Controllers\Channel\GenreController::class, 'reorder'])->name('genres.reorder');

        Route::post('languages/enable/{language}', [\App\Http\Controllers\Channel\LanguageController::class, 'enable'])->name('languages.enable');
        Route::post('languages/disable/{language}', [\App\Http\Controllers\Channel\LanguageController::class, 'disable'])->name('languages.disable');

        Route::post('movies/publish/{movie}', [\App\Http\Controllers\Channel\MovieController::class, 'publish'])->name('movies.publish');
        Route::post('movies/unpublish/{movie}', [\App\Http\Controllers\Channel\MovieController::class, 'unpublish'])->name('movies.unpublish');
        Route::post('movies/upload', [\App\Http\Controllers\Channel\MovieController::class, 'upload'])->name('movies.upload');

        Route::post('shows/publish/{show}', [\App\Http\Controllers\Channel\ShowController::class, 'publish'])->name('shows.publish');
        Route::post('shows/unpublish/{show}', [\App\Http\Controllers\Channel\ShowController::class, 'unpublish'])->name('shows.unpublish');

        Route::post('seasons/publish/{season}', [\App\Http\Controllers\Channel\SeasonController::class, 'publish'])->name('seasons.publish');
        Route::post('seasons/unpublish/{season}', [\App\Http\Controllers\Channel\SeasonController::class, 'unpublish'])->name('seasons.unpublish');

        Route::post('episodes/publish/{episode}', [\App\Http\Controllers\Channel\EpisodeController::class, 'publish'])->name('episodes.publish');
        Route::post('episodes/unpublish/{episode}', [\App\Http\Controllers\Channel\EpisodeController::class, 'unpublish'])->name('episodes.unpublish');

        Route::post('live/publish/{live}', [\App\Http\Controllers\Channel\LiveController::class, 'publish'])->name('live.publish');
        Route::post('live/unpublish/{live}', [\App\Http\Controllers\Channel\LiveController::class, 'unpublish'])->name('live.unpublish');

        Route::post('sports/publish/{sport}', [\App\Http\Controllers\Channel\SportController::class, 'publish'])->name('sports.publish');
        Route::post('sports/unpublish/{sport}', [\App\Http\Controllers\Channel\SportController::class, 'unpublish'])->name('sports.unpublish');

        Route::resources([
            'dashboard' => \App\Http\Controllers\Channel\DashboardController::class,
            'genres' => \App\Http\Controllers\Channel\GenreController::class,
            'languages' => \App\Http\Controllers\Channel\LanguageController::class,
            'media' => \App\Http\Controllers\Channel\MediaController::class,
            'spotlights' => \App\Http\Controllers\Channel\SpotlightController::class,
            'movies' => \App\Http\Controllers\Channel\MovieController::class,
            'shows' => \App\Http\Controllers\Channel\ShowController::class,
            'seasons' => \App\Http\Controllers\Channel\SeasonController::class,
            'episodes' => \App\Http\Controllers\Channel\EpisodeController::class,
            'live' => \App\Http\Controllers\Channel\LiveController::class,
            'sports' => \App\Http\Controllers\Channel\SportController::class,
            'subscription-analytics' => \App\Http\Controllers\Channel\SubscriptionAnalyticController::class
        ]);
        Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');
    });

    // Advertiser Route Group
    Route::group(['prefix' => 'advertiser', 'as' => 'advertiser.'], function () {
        // Advertiser Admin
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::post('advertisers/active/{advertiser}', [\App\Http\Controllers\Advertiser\Admin\AdvertiserController::class, 'active'])->name('advertisers.active');
            Route::post('advertisers/block/{advertiser}', [\App\Http\Controllers\Advertiser\Admin\AdvertiserController::class, 'block'])->name('advertisers.block');

            Route::resources([
                'dashboard' => \App\Http\Controllers\Advertiser\Admin\DashboardController::class,
                'advertisers' => \App\Http\Controllers\Advertiser\Admin\AdvertiserController::class
            ]);
        });

        // Advertiser
        Route::group(['as' => ''], function () {
            Route::post('campaigns/start/{ad-campaign}', [\App\Http\Controllers\Advertiser\Admin\CampaignController::class, 'start'])->name('campaigns.start');
            Route::post('campaigns/stop/{ad-campaign}', [\App\Http\Controllers\Advertiser\Admin\CampaignController::class, 'stop'])->name('campaigns.stop');

            Route::resources([
                'dashboard' => \App\Http\Controllers\Advertiser\DashboardController::class,
                'campaigns' => \App\Http\Controllers\Advertiser\Admin\CampaignController::class
            ]);
        });
    });

    // User Route Group
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('plans/subscribe/{plan}/{period}', [PlanController::class, 'subscribe'])->name('plans.subscribe');

        Route::post('payment-methods/default/{paymentMethod}', [\App\Http\Controllers\User\PaymentMethodController::class, 'default'])->name('payment-methods.default');

        Route::post('transactions/receipt/{transaction}', [TransactionController::class, 'receipt'])->name('transactions.receipt');

        Route::resources([
            'dashboard' => \App\Http\Controllers\User\DashboardController::class,
            'subscriptions' => \App\Http\Controllers\User\SubscriptionController::class,
            'payment-methods' => \App\Http\Controllers\User\PaymentMethodController::class,
            'transactions' => TransactionController::class,
        ]);

//        Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
//            Route::get('paypal/{plan}/{period}', [PaypalController::class, 'charge'])->name('paypal');
//            Route::get('paypal/callback', [PayPalController::class, 'callback'])->name('paypal.callback');
//            Route::get('paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');
//        });
    });

    // Pagination Route Group
    Route::group(['prefix' => 'pagination', 'as' => 'pagination.'], function () {
        Route::get('genres', [\App\Http\Controllers\PaginationController::class, 'genres'])->name('genres');
        Route::get('categories', [\App\Http\Controllers\PaginationController::class, 'categories'])->name('categories');
        Route::get('languages', [\App\Http\Controllers\PaginationController::class, 'languages'])->name('languages');
        Route::get('shows', [\App\Http\Controllers\PaginationController::class, 'shows'])->name('shows');
        Route::get('seasons', [\App\Http\Controllers\PaginationController::class, 'seasons'])->name('seasons');
        Route::get('showSeasons', [\App\Http\Controllers\PaginationController::class, 'showSeasons'])->name('showSeasons');
        Route::get('media', [\App\Http\Controllers\PaginationController::class, 'media'])->name('media');
        Route::get('network/operators', [\App\Http\Controllers\PaginationController::class, 'networkOperators'])->name('network.operators');
        Route::get('channels', [\App\Http\Controllers\PaginationController::class, 'channels'])->name('channels');
        Route::get('spotlights', [\App\Http\Controllers\PaginationController::class, 'spotlights'])->name('spotlights');
        Route::get('search', [\App\Http\Controllers\PaginationController::class, 'search'])->name('search');
    });

    // Routes for all auths
    Route::post('imdb/fetch/title', [ImdbController::class, 'fetchTitle'])->name('imdb.fetch.title');
    Route::post('imdb/fetch/episode', [ImdbController::class, 'fetchEpisode'])->name('imdb.fetch.episode');

    Route::get('profile', function () {
        switch (auth()->user()->role) {
            case 'admin':
                return view('admin.profile');

            case 'user':
                return view('user.profile');
        }
    })->name('profile');

    Route::get('account', function () {
        switch (auth()->user()->role) {
            case 'admin':
                return view('admin.account');

            case 'user':
                return view('user.account');
        }
    })->name('account');
});

Route::group(['prefix' => 'dashboards'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/rating', [DashboardController::class, 'rating'])->name('dashboard.rating');
    Route::get('/comment', [DashboardController::class, 'comment'])->name('dashboard.comment');
    Route::get('/user', [DashboardController::class, 'user'])->name('dashboard.user');

    Route::get('/add-category', [DashboardController::class, 'addCategory'])->name('dashboard.addCategory');
    Route::get('/category-list', [DashboardController::class, 'categoryList'])->name('dashboard.categoryList');

    Route::get('/add-movie', [DashboardController::class, 'addMovie'])->name('dashboard.addMovie');
    Route::get('/movie-list', [DashboardController::class, 'movieList'])->name('dashboard.movieList');

    Route::get('/add-show', [DashboardController::class, 'addShow'])->name('dashboard.addShow');
    Route::get('/show-list', [DashboardController::class, 'showList'])->name('dashboard.showList');

    Route::get('/page-pricing', [DashboardController::class, 'pricing'])->name('dashboard.pricing');

    Route::get('/privacy-policy', [DashboardController::class, 'privacyPolicy'])->name('dashboard.privacyPolicy');

    Route::get('/terms-of-service', [DashboardController::class, 'termsOfService'])->name('dashboard.termsOfService');

    Route::get('/pages-confirm-mail', [DashboardController::class, 'pageConfirmMail'])->name('dashboard.pageConfirmMail');

    //UI Pages Routes
    Route::group(['prefix' => 'ui'], function () {
        Route::get('alerts', [DashboardController::class, 'UiAlerts'])->name('ui.alerts');
        Route::get('badges', [DashboardController::class, 'UiBadges'])->name('ui.badges');
        Route::get('breadcrumb', [DashboardController::class, 'UiBreadcrumb'])->name('ui.breadcrumb');
        Route::get('buttons', [DashboardController::class, 'UiButtons'])->name('ui.buttons');
        Route::get('colors', [DashboardController::class, 'UiColors'])->name('ui.colors');
        Route::get('cards', [DashboardController::class, 'UiCards'])->name('ui.cards');
        Route::get('carousel', [DashboardController::class, 'UiCarousel'])->name('ui.carousel');
        Route::get('grid', [DashboardController::class, 'UiGrid'])->name('ui.grid');
        Route::get('images', [DashboardController::class, 'UiImages'])->name('ui.images');
        Route::get('listgroup', [DashboardController::class, 'UiListgroup'])->name('ui.listgroup');
        Route::get('media', [DashboardController::class, 'UiMedia'])->name('ui.media');
        Route::get('modal', [DashboardController::class, 'UiModal'])->name('ui.modal');
        Route::get('notification', [DashboardController::class, 'UiNotification'])->name('ui.notification');
        Route::get('pagination', [DashboardController::class, 'UiPagination'])->name('ui.pagination');
        Route::get('popovers', [DashboardController::class, 'UiPopovers'])->name('ui.popovers');
        Route::get('progressbars', [DashboardController::class, 'UiProgressbars'])->name('ui.progressbars');
        Route::get('typography', [DashboardController::class, 'UiTypography'])->name('ui.typography');
        Route::get('tabs', [DashboardController::class, 'UiTabs'])->name('ui.tabs');
        Route::get('tooltips', [DashboardController::class, 'UiTooltips'])->name('ui.tooltips');
        Route::get('video', [DashboardController::class, 'UiVideo'])->name('ui.video');
    });

    Route::group(['prefix' => 'forms'], function () {
        Route::get('form-checkbox', [DashboardController::class, 'formCheckbox'])->name('forms.checkbox');
        Route::get('form-elements', [DashboardController::class, 'formElements'])->name('forms.elements');
        Route::get('form-radio', [DashboardController::class, 'formRadio'])->name('forms.radio');
        Route::get('form-switch', [DashboardController::class, 'formSwitch'])->name('forms.switch');
        Route::get('form-validation', [DashboardController::class, 'formValidation'])->name('forms.validation');

    });

    Route::group(['prefix' => 'formsWizard'], function () {
        Route::get('form-wizard-simple', [DashboardController::class, 'formSimpleWizard'])->name('formsWizard.simpleWizard');
        Route::get('form-wizard-validate', [DashboardController::class, 'formValidateWizard'])->name('formsWizard.validateWizard');
        Route::get('form-wizard-vertical', [DashboardController::class, 'formVerticalWizard'])->name('formsWizard.verticalWizard');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('profile', [DashboardController::class, 'userProfile'])->name('user.profile');
        Route::get('profile-edit', [DashboardController::class, 'userProfileEdit'])->name('user.profilEdit');
        Route::get('account-setting', [DashboardController::class, 'userAccountSetting'])->name('user.accountSetting');
        Route::get('privacy-setting', [DashboardController::class, 'userPrivacySetting'])->name('user.privacySetting');
    });

    Route::group(['prefix' => 'table'], function () {
        Route::get('basic-table', [DashboardController::class, 'basicTable'])->name('table.basicTable');
        Route::get('data-table', [DashboardController::class, 'dataTable'])->name('table.dataTable');
        Route::get('edit-table', [DashboardController::class, 'editTable'])->name('table.editTable');
    });

    Route::group(['prefix' => 'icons'], function () {
        Route::get('dripicons', [DashboardController::class, 'dripicons'])->name('icons.dripicons');
        Route::get('font-awesome', [DashboardController::class, 'fontAwesome'])->name('icons.fontAwesome');
        Route::get('line-awesome', [DashboardController::class, 'lineAwesome'])->name('icons.lineAwesome');
        Route::get('remixicon', [DashboardController::class, 'remixicon'])->name('icons.remixicon');
        Route::get('unicons', [DashboardController::class, 'unicons'])->name('icons.unicons');
    });

    Route::group(['prefix' => 'extraPage'], function () {
        Route::get('timeline', [DashboardController::class, 'timeline'])->name('extraPage.timeline');
        Route::get('invoice', [DashboardController::class, 'invoice'])->name('extraPage.invoice');
        Route::get('blank-pages', [DashboardController::class, 'blankPage'])->name('extraPage.blankPage');
        Route::get('error-404', [DashboardController::class, 'error404'])->name('extraPage.error404');
        Route::get('error-500', [DashboardController::class, 'error500'])->name('extraPage.error500');
        Route::get('maintenance', [DashboardController::class, 'maintenance'])->name('extraPage.maintenance');
        Route::get('comming-soon', [DashboardController::class, 'commingSoon'])->name('extraPage.commingSoon');
        Route::get('faq', [DashboardController::class, 'faq'])->name('extraPage.faq');
    });

});

Route::get('gocampaign', [CampaignController::class, 'index'])->name('gocampaign');
Route::get('createcampaign', [CampaignController::class, 'createpage'])->name('createcampaign');
Route::post('savecampaign', [CampaignController::class, 'savecampaign'])->name('savecampaign');

// advertiser/dashboard
Route::post('advertiser/dashboard', [\App\Http\Controllers\Advertiser\DashboardController::class, 'index'])->name('advertiser/dashboard');
Route::post('channel/dashboard', [\App\Http\Controllers\Channel\DashboardController::class, 'index'])->name('channel/dashboard');

Route::get('signin/{id}', [\App\Http\Controllers\AuthController::class, 'index'])->name('gologinpage');
Route::post('auth_login/{id}', [\App\Http\Controllers\AuthController::class, 'login'])->name('loginaction');

// test
Route::post('/upload-doc-file', [CampaignController::class, 'uploadToServer']);