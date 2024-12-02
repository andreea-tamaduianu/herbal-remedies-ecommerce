<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\CurrencyController as FrontendCurrencyController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\HomeBlogController;

use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\ReviewController;
use App\Models\User;




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


//Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});



Route::middleware(['auth:admin'])->group(function () {
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

    // Admin All Routes 

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/edit-password', [AdminProfileController::class, 'AdminEditPassword'])->name('admin.edit.password');
    Route::post('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
});  // end Middleware admin



//User routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');
Route::post('/user/update/password', [IndexController::class, 'UserUpdatePassword'])->name('user.update.password');

//Admin Brand routes

Route::prefix('brand')->group(function () {
    Route::get('/all', [BrandController::class, 'AllBrands'])->name('all.brands');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});

//Admin Category routes

Route::prefix('category')->group(function () {
    Route::get('/all', [CategoryController::class, 'AllCategories'])->name('all.categories');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    Route::get('/inactive/{id}', [CategoryController::class, 'CategoryInactive'])->name('category.inactive');
    Route::get('/active/{id}', [CategoryController::class, 'CategoryActive'])->name('category.active');


    //Admin subcategory routes
    Route::get('/sub/all', [SubcategoryController::class, 'AllSubcategories'])->name('all.subcategories');
    Route::post('/sub/store', [SubcategoryController::class, 'SubcategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubcategoryController::class, 'SubcategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubcategoryController::class, 'SubcategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubcategoryController::class, 'SubcategoryDelete'])->name('subcategory.delete');
    Route::get('/sub/inactive/{id}', [SubcategoryController::class, 'SubcategoryInactive'])->name('subcategory.inactive');
    Route::get('/sub/active/{id}', [SubcategoryController::class, 'SubcategoryActive'])->name('subcategory.active');


    //Admin subsubcategory routes
    Route::get('/sub/sub/all', [SubcategoryController::class, 'AllSubsubcategories'])->name('all.subsubcategories');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubcategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubsubCategory']);
    Route::post('/sub/sub/store', [SubcategoryController::class, 'SubsubcategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubcategoryController::class, 'SubsubcategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubcategoryController::class, 'SubsubcategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubcategoryController::class, 'SubsubcategoryDelete'])->name('subsubcategory.delete');
    Route::get('/sub/sub/inactive/{id}', [SubcategoryController::class, 'SubsubcategoryInactive'])->name('subsubcategory.inactive');
    Route::get('/sub/sub/active/{id}', [SubcategoryController::class, 'SubsubcategoryActive'])->name('subsubcategory.active');
});



//Admin product routes

Route::prefix('product')->group(function () {
    Route::get('/add', [ProductController::class, 'ProductAdd'])->name('product.add');
    Route::post('/store', [ProductController::class, 'ProductStore'])->name('product.store');
    Route::get('/all', [ProductController::class, 'AllProducts'])->name('all.products');
    Route::get('/view/{id}', [ProductController::class, 'ProductView'])->name('product.view');
    Route::get('/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    Route::post('/data/update', [ProductController::class, 'ProductUpdate'])->name('product.update');
    Route::get('/stock/{id}', [ProductController::class, 'ProductManageStock'])->name('product.manage.stock');
    Route::post('/stock/add/{id}', [ProductController::class, 'ProductAddStock'])->name('product.add.stock');
    Route::post('/stock/update/{id}', [ProductController::class, 'ProductUpdateStock'])->name('product.update.stock');
    Route::post('/stock/update-status', [ProductController::class, 'ProductUpdateStockStatus'])->name('product.update.status.stock');
    Route::get('/stock/delete/{id}', [ProductController::class, 'ProductDeleteStock'])->name('product.delete.stock');
    Route::post('/image/update', [ProductController::class, 'ProductMultiImageUpdate'])->name('product.update.multi.image');
    Route::post('/thumbnail/update', [ProductController::class, 'ProductThumbnailImageUpdate'])->name('product.update.thumbnail');
    Route::post('/video/update', [ProductController::class, 'ProductVideoUpdate'])->name('product.update.video');
    Route::get('/image/delete/{id}', [ProductController::class, 'ProductMultiImageDelete'])->name('product.delete.multi.image');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});


// Admin slider routes 

Route::prefix('slider')->group(function () {
    Route::get('/view', [SliderController::class, 'SliderView'])->name('slider.manage');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
});


//// Frontend  Routes /////
/// Multi Language  Routes ////

Route::get('/language/romanian', [LanguageController::class, 'Romanian'])->name('language.romanian');
Route::get('/language/english', [LanguageController::class, 'English'])->name('language.english');

Route::get('/change-currency/{code}', [FrontendCurrencyController::class, 'ChangeCurrency'])->name('change.currency');



// Frontend Product Details Page url 
Route::get('/product/details/{id}', [IndexController::class, 'ProductDetails']);


// Frontend Product Tags Page 
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// Frontend SubCategory wise Data
Route::match(['get', 'post'],'/products/subcategory/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Frontend Sub-SubCategory wise Data
Route::get('/products/subsubcategory/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);
Route::get('/products/category/{slug}', [IndexController::class, 'CatWiseProduct']);
Route::get('/products/brand/{slug}', [IndexController::class, 'BrandWiseProduct']);


// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishlist']);

/////////////////////  User Must Login  ////
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {

    // Wishlist page
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');

    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);

    Route::get('/wishlist-remove-product/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');

    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    Route::get('/my-orders', [AllUserController::class, 'MyOrders'])->name('my.orders');

    Route::get('/order-details/{order_id}', [AllUserController::class, 'OrderDetails']);

    Route::get('/invoice-download/{order_id}', [AllUserController::class, 'InvoiceDownload']);

    Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

    Route::post('/cancel/order/{order_id}', [AllUserController::class, 'CancelOrder'])->name('cancel.order');

    Route::get('/returned/orders/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');

    Route::get('/cancelled/orders/list', [AllUserController::class, 'CancelledOrders'])->name('cancel.orders');


    /// Order Traking Route 
    Route::post('/order/tracking', [AllUserController::class, 'OrderTracking'])->name('order.tracking');    

});

// My Cart Page All Routes
Route::get('/mycart', [CartController::class, 'MyCart'])->name('mycart');

Route::get('/user/get-cart-product', [CartController::class, 'GetCartProducts']);

Route::get('/user/cart-remove/{rowId}', [CartController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{rowId}', [CartController::class, 'CartIncrement']);

Route::get('/cart-decrement/{rowId}', [CartController::class, 'CartDecrement']);


// Admin Coupons All Routes 

Route::prefix('coupons')->group(function () {

    Route::get('/view', [CouponController::class, 'CouponView'])->name('coupon.manage')->middleware('auth:admin');

    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');

    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');

    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
});


Route::prefix('currency')->group(function () {

    Route::get('/view', [CurrencyController::class, 'CurrencyView'])->name('currency.manage');

    Route::post('/store', [CurrencyController::class, 'CurrencyStore'])->name('currency.store');

    Route::get('/edit/{id}', [CurrencyController::class, 'CurrencyEdit'])->name('currency.edit');
    Route::post('/update/{id}', [CurrencyController::class, 'CurrencyUpdate'])->name('currency.update');

    Route::get('/delete/{id}', [CurrencyController::class, 'CurrencyDelete'])->name('currency.delete');
    Route::get('/inactive/{id}', [CurrencyController::class, 'CurrencyInactive'])->name('currency.inactive');
    Route::get('/active/{id}', [CurrencyController::class, 'CurrencyActive'])->name('currency.active');

});


// Admin Shipping All Routes 

Route::prefix('shipping')->group(function () {

    // Ship Division 
    Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('division.manage');

    Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');

    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');

    Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');

    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');



    // Ship District 
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('district.manage');

    Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');

    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

    Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');

    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');


    // Ship State 
    Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('state.manage');

    Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');

    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');

    Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');

    Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');

    Route::get('/divison/district/ajax/{division_id}', [ShippingAreaController::class, 'GetDistrict']);

   

});
  





// Frontend Coupon Option

Route::post('/coupon-apply', [CouponController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CouponController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CouponController::class, 'CouponRemove']);



Route::get('/add-to-compare/{id}', [CompareController::class, 'AddToCompare'])->name('compare.store');

Route::get('/delete-from-compare/{id}', [CompareController::class, 'RemoveFromCompare'])->name('compare.delete');

Route::get('/product-comparison', [CompareController::class, 'ViewProductComparison'])->name('compare.view');

// Checkout Routes 

Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);

Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);

Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');


// Checkout Routes 

Route::get('/checkout', [CheckoutController::class, 'CheckoutCreate'])->name('checkout');

Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);

Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);

Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');


// Admin Order All Routes 

Route::prefix('orders')->group(function () {

    Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders');

    Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
    Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');

    Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');

    Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');

    Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');

    Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');

    Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

    // Update Status 
    Route::get('/pending/confirmed/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending.confirm');

    Route::get('/confirmed/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');

    Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');

    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

    Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');
    Route::get('/delivered/cancelled/{order_id}', [OrderController::class, 'Cancelled'])->name('cancelled');
    Route::post('/update-shipping-information', [OrderController::class, 'UpdateShippingInformation'])->name('update.shipping.information');

    Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
});


// Admin Reports Routes 
Route::prefix('reports')->group(function () {

    Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');

    Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');

    Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');

    Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');

    Route::get('/view-graphs', [ReportController::class, 'ReportViewGraphs'])->name('all-graphs');
});


// Admin Get All User Routes 
Route::prefix('allusers')->group(function () {

    Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');
});



// Admin Blog  Routes 
Route::prefix('blog')->group(function () {

    Route::get('/category/all', [BlogController::class, 'BlogCategory'])->name('blogcategory.all');

    Route::post('/category/store', [BlogController::class, 'BlogCategoryStore'])->name('blogcategory.store');

    Route::get('/category/edit/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blogcategory.edit');

    Route::post('/category/update', [BlogController::class, 'BlogCategoryUpdate'])->name('blogcategory.update');
    Route::get('/category/delete/{id}', [BlogController::class, 'BlogCategoryDelete'])->name('blogcategory.delete');

    // Admin View Blog Post Routes 

    Route::get('/post/list', [BlogController::class, 'ListBlogPost'])->name('post.list');

    Route::get('/post/add', [BlogController::class, 'AddBlogPost'])->name('post.add');

    Route::post('/post/store', [BlogController::class, 'BlogPostStore'])->name('post.store');

    Route::get('/post/edit/{id}', [BlogController::class, 'BlogPostEdit'])->name('post.edit');
    Route::post('/post/update', [BlogController::class, 'BlogPostUpdate'])->name('post.update');
    Route::get('/post/delete/{id}', [BlogController::class, 'BlogPostDelete'])->name('post.delete');
});

//  Frontend Blog Show Routes 

Route::get('/blog', [HomeBlogController::class, 'AddBlogPost'])->name('home.blog');

Route::get('/post/details/{id}', [HomeBlogController::class, 'DetailsBlogPost'])->name('post.details');
Route::post('/post/add/comment', [HomeBlogController::class, 'CreateCommentForBlogPost'])->name('create.comment');

Route::get('/blog/category/post/{category_id}', [HomeBlogController::class, 'HomeBlogCatPost']);
Route::get('/blog/search', [HomeBlogController::class, 'BlogSearch'])->name('blog.search');

// Admin Site Setting Routes 
Route::prefix('setting')->group(function () {

    Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
    Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');

    Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');

    Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');
});

// Admin Return Order Routes 
Route::prefix('return')->group(function () {

    Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
    Route::post('/admin/return-requests/update', [ReturnController::class, 'ReturnRequestUpdate'])->name('return.request.update');

    Route::get('/admin/request/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');

    Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
});


/// Frontend Product Review Routes

Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');


// Admin Manage Review Routes 
Route::prefix('review')->group(function () {

    Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');

    Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');

    Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');

    Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
});


// Admin Manage Stock Routes 
Route::prefix('stock')->group(function () {

    Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
});



Route::prefix('mailbox')->group(function () {

    Route::get('/all', [ContactController::class, 'AdminMailboxAll'])->name('messages.all');
    Route::get('/view/{id}', [ContactController::class, 'AdminMessageView'])->name('message.view');
    
   
});

Route::prefix('newsletter')->group(function () {

    Route::get('/subscribers', [ContactController::class, 'NewsletterSubscribersAll'])->name('newsletter.subscribers');
    Route::get('/subscribers/delete/{id}', [ContactController::class, 'NewsletterSubscribersDelete'])->name('subscriber.delete');
    Route::get('/subscribers/inactive/{id}', [ContactController::class, 'NewsletterSubscribersInactive'])->name('subscriber.inactive');
    Route::get('/subscribers/active/{id}', [ContactController::class, 'NewsletterSubscribersActive'])->name('subscriber.active');
   
    
   
});


// Admin User Role Routes 
Route::prefix('admin-user-role')->group(function () {

    Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');

    Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');

    Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');

    Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');

    Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');

    Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');
});



/// Product Search Route 
Route::get('/search', [IndexController::class, 'ProductSearch'])->name('product.search');
Route::get('/search-voice', [IndexController::class, 'ProductSearchVoice'])->name('product.search.voice');

// Advanced Search Routes 
Route::post('advanced-search-product', [IndexController::class, 'AdvancedSearchProduct']);


Route::get('/faq', [IndexController::class, 'Faq'])->name('faq');
Route::get('/terms-and-conditions', [IndexController::class, 'TermsAndConditions'])->name('terms_and_conditions');
Route::get('/contact-us', [IndexController::class, 'ContactUs'])->name('contact_us');
Route::post('/send-message', [IndexController::class, 'SendMessage'])->name('send.message');
Route::get('/about-us', [IndexController::class, 'AboutUs'])->name('about_us');
Route::post('/add-subscriber-email', [IndexController::class, 'AddSubscriber'])->name('add.subscriber');