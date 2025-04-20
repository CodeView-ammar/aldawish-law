<?php

use Tasawk\Http\Controllers\HomeController;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;
use Tasawk\Enum\ExecutingOrderStatus;
use Tasawk\Enum\OrderStatus;
use Tasawk\Lib\Utils;
use Tasawk\Models\Branch;
use Tasawk\Models\Catalog\Category;
use Illuminate\Support\Facades\Route;
use Tasawk\Http\Controllers\AuthController;
use Tasawk\Http\Controllers\ProfileController;
use Tasawk\Http\Controllers\NotificationController;
use Tasawk\Models\Order;
use Tasawk\Models\User;
use Tasawk\Notifications\Branch\BranchMaintenanceModeChangedNotification;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Tasawk\Http\Controllers\Consultation;
use Tasawk\Http\Controllers\ConsultationController;
use Tasawk\Http\Controllers\OrderController;
use Tasawk\Http\Controllers\PageController;
use Tasawk\Http\Controllers\BlogerController;
use Tasawk\Notifications\Customer\PaidOrderNotification;
use Tasawk\Filament\Pages\BlogPage;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
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

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    // Your other localized routes...
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
});
Route::get('/sitemap.xml', function () {
    return SitemapGenerator::create(config('app.url'))
        ->getSitemap()
        ->writeToFile(public_path('sitemap.xml'));
})->name('sitemap');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
    Route::get('/company-message' , [PageController::class, 'companyMessage'])->name('company-message');
    Route::get('/company-aims', [PageController::class, 'companyAims'])->name('company-aims');
    Route::get('/company-vision', [PageController::class, 'companyVision'])->name('company-vision');
    Route::get('/our-values' , [PageController::class, 'ourValues'])->name('our-values');
    Route::get('/scientific-experiences', [PageController::class, 'scientificExperiences'])->name('scientific-experiences');
    Route::get('/relevant-company', [PageController::class, 'relevantCompany'])->name('relevant-company');
    Route::get('/team-mission', [PageController::class, 'teamMission'])->name('team-mission');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/services/{service}', [PageController::class, 'serviceDetails'])->name('service.details');
    Route::get('/partners', [PageController::class, 'partners'])->name('partners');
    Route::get('/topbars', [PageController::class, 'topbars'])->name('topbars');
    Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us');
    Route::get('/career', [PageController::class, 'career'])->name('career');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/terms-condition', [PageController::class, 'termsCondition'])->name('terms-condition');
    Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');
    

    //auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/reset-password/{email}', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::get('/forget-password', [AuthController::class, 'gorgetPassword'])->name('forget-password');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/register-success', [AuthController::class, 'registerSuccess'])->name('register-success');
    Route::get('/verification-code', [AuthController::class, 'verify'])->name('verifyCode');
    Route::get('/verification-password', [AuthController::class, 'verifyPassword'])->name('verifyPassword');
    Route::get('/verification-password-page', [AuthController::class, 'verifyPassword2'])->name('verifyPasswordPage');

    //bloger
    Route::get('/bloger', [BlogerController::class, 'bloger'])->name('bloger');
    Route::get('/bloger/posts/{slug}', [BlogerController::class, 'show'])->name('posts.show');
    Route::get('/bloger/category/{slug}', [BlogerController::class, 'filterByCategory'])->name('posts.category');
    

});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function () {
    Route::middleware(['auth:customer'])->name('site.')->group(function () {
        //profile
        Route::get('edit-profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('edit-password', [ProfileController::class, 'editPassword'])->name('profile.changePassword');
        Route::get('my-orders', [ProfileController::class, 'myOrders'])->name('profile.myOrders');
        Route::get('payments', [ProfileController::class, 'payments'])->name('profile.payments');
        Route::get('notifications', [NotificationController::class, 'index'])->name('profile.notifications');
        Route::get('notifications/delete', [NotificationController::class, 'delete'])->name('profile.notifications.delete');
        Route::get('customer-logout', [ProfileController::class, 'logout'])->name('profile.logout');
        Route::get('/request-consultation',[ConsultationController::class,'requestConsultation'])->name('request-consultation');
        Route::get('/consultation-success', [ConsultationController::class, 'consultationSuccess'])->name('consultation.success');
        Route::get('/payment-success', [ConsultationController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/order-details/{order}', [ProfileController::class, 'orderDetails'])->name('order-details');
        Route::get('/checkout/{order}', [OrderController::class, 'checkOut'])->name('checkout');
    });
});
Route::get('opaidrders/{order}/invoice', function (Order $order) {
    return view('filament.pages.print', ['order' => $order]);
})->name('orders.invoice');

Route::get('webhooks/myfatoorah/callback', function (PaymentMyfatoorahApiV2 $myfatoorahApiV2) {
    $response = $myfatoorahApiV2->getPaymentStatus(request()->get('Id'), 'PaymentId');
    $order = Order::where('payment_data->invoiceId', $response->InvoiceId)->first();
    // if ($response->InvoiceStatus == 'Paid') {
        if ($order->payment_status != 'paid') {
            $order->update([
                'payment_data' => array_merge($order->payment_data, [...collect($response)->toArray(), 'method' => $response->focusTransaction->PaymentGateway, 'paid_at' => now()]),
                'payment_status' => 'paid',

            ]);
            Notification::send($order->customer, new PaidOrderNotification($order));
            Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new PaidOrderNotification($order));
        }
        return redirect()->route('site.order-details', $order);
    // }
    // return Api::isError('something went wrong');
})->name('webhooks.myfatoorah.callback');
