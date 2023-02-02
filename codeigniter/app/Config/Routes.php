<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//pages accessible to everyone
$routes->get('/','PublicPagesController::viewHome');
$routes->get('/home', 'PublicPagesController::viewHome');
$routes->get('/login', 'PublicPagesController::view/login');
$routes->get('/create_account', 'PublicPagesController::view/create_account');
$routes->post('/login', 'PublicPagesController::validateLogin');
$routes->post('/create_account', 'PublicPagesController::createProfile');
$routes->get('/sitemap', 'PublicPagesController::sitemap');
$routes->get('/accessibility', 'PublicPagesController::accessibility');

//pages accessible to logged in users
$routes->group('', ['filter'=>'verifyUser'], static function($routes){
    //pages accessible to users
    $routes->get('/profile/profile', 'ProfileController::viewProfile');
    $routes->get('/profile/notifications', 'NotificationsController::viewNotifications');
    $routes->get('/shoppingcart', 'ShoppingcartController::viewShoppingcart');
    $routes->get('/messages', 'MessagesController::viewMessages');
    $routes->get('/messages/(:num)', 'MessagesController::openConversation/$1');
    $routes->get('/products', 'ProductController::products');
    $routes->get('/logout', 'PublicPagesController::logOut');
    $routes->get('/product/(:num)', 'ProductController::Product/$1');
    $routes->get('/profile/orders', 'ProfileController::viewOrders');
    $routes->get('/FilterProducts', 'ProductController::filterProducts');
    $routes->post('/product/search', 'ProductController::searchProducts');
    $routes->post('ShoppingCart/AddProductToCart', 'ShoppingcartController::addProduct');
    $routes->post('shoppingcart/place_order', 'ShoppingcartController::placeOrder');
    $routes->post('/saveReview/(:num)', 'ProductController::storeReview/$1');
    $routes->post('/shoppingcart/remove_product_from_cart', 'ShoppingcartController::removeProduct');
    $routes->post('shoppingcart/cancel_order', 'ShoppingcartController::removeOrder'); 
    $routes->post('/sendMessage/(:num)', 'MessagesController::sendMessage/$1');
    $routes->post('/product/addNotification', 'NotificationsController::addNotification');
    $routes->post('/incrementShoppingCart','ShoppingcartController::incrementProduct');
    $routes->post('/updateReview/(:num)','ProductController::updateReview/$1'); 

    //only vendor profiles are visible to everyone
    $routes->group('', ['filter'=>'publicVendorProfileFilter'], static function ($routes){
        $routes->get('/profile/(:num)', 'ProfileController::PublicProfile/$1');
    });

    //pages only accessible to vendors
    $routes->group('', ['filter'=>'vendorFilter'], static function($routes){
        //pages accessible when profile is complete
        $routes->group('', ['filter' => 'completeProfileFilter'], static function($routes){
                    $routes->get('/profile/create_product', 'ProductController::viewCreate');
                    $routes->post('/profile/store_product', 'ProductController::store');
                    $routes->get('/profile/statistics', 'ProfileController::viewStatistics');
                    $routes->get('/askStatistics', 'ProfileController::askStatistics');
                    $routes->get('/profile/myproducts', 'ProfileController::viewMyProducts');
                    $routes->get('/delete_product/(:num)', 'ProductController::deleteProduct/$1');
                    $routes->get('/profile/myProducts/edit/(:num)', 'ProductController::editProductView/$1');
                    $routes->post('/update_product/(:num)', 'ProductController::updateProduct/$1');
        });
        //pages always accessible to the vendor
        $routes->post('/profile/update', 'ProfileController::updateProfile');
    }); 
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
