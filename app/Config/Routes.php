<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

if(isset($_SERVER['HTTP_HOST'])){

	$routes->setDefaultNamespace('App\Controllers\base');
	$routes->setDefaultController('DashboardController');

    $routes->add('/landing/(:any)', 'PaymentController::landing'); 

    // ppp_payment
    $routes->add('/isolir/(:any)', 'PaymentController::isolir'); 
    $routes->add('/payment/(:any)', 'PaymentController::ppp_payment'); 
    $routes->add('/chkvalidity/(:any)', 'PaymentController::ppp_check_validity'); 
    $routes->add('/validity/(:any)', 'PaymentController::ppp_validity'); 
    $routes->add('/invoice/(:any)', 'PaymentController::ppp_invoice'); 
    $routes->post('/ppp_req_payment', 'PaymentController::ppp_req_payment'); 
    
    // hotspot_payment
    $routes->add('/isolir2/(:any)', 'PaymentController::isolir2'); 
    $routes->add('/voucher/(:any)', 'PaymentController::voucher_payment'); 
    $routes->add('/status/(:any)', 'PaymentController::hotspot_status'); 
    $routes->add('/expire/(:any)', 'PaymentController::expire'); 
    $routes->add('/chkstatus/(:any)', 'PaymentController::check_status'); 
    $routes->post('/buy_voucher', 'PaymentController::buy_voucher'); 
    $routes->post('/perpanjang_voucher', 'PaymentController::perpanjang_voucher'); 

    // hotspot_template
    $routes->add('/tbeli/(:any)', 'PaymentController::tbeli');
    $routes->add('/tperpanjang/(:any)', 'PaymentController::tperpanjang');
    $routes->add('/tcek/(:any)', 'PaymentController::tcek');
    $routes->add('/tinvoice/(:any)', 'PaymentController::tinvoice');
    $routes->add('/tstatus/(:any)', 'PaymentController::tstatus');
    $routes->add('/tchk/(:any)', 'PaymentController::tchk'); 

    //callback_url
    $routes->add('/callback/(:any)', 'PaymentController::callback'); 

	// Login
	$routes->add('/', 'DashboardController::index'); 
	$routes->post('do_auth', 'DashboardController::do_auth');
	$routes->get('router/do_unauth', 'DashboardController::do_unauth_owner');

	// Router
	$routes->add('router/list', 'DashboardController::router');
	$routes->add('router/addrouter', 'DashboardController::add_router');
    $routes->post('router/do_update_user', 'DashboardController::do_update_user');
	$routes->post('router/do_add_router', 'DashboardController::do_add_router');
    $routes->post('router/do_edit_router', 'DashboardController::do_edit_router');
	$routes->post('router/do_auth_router', 'DashboardController::do_auth_router');
    $routes->post('router/do_delete_router', 'DashboardController::do_delete_router');
    $routes->get('u/do_unauth_router', 'DashboardController::do_unauth_router');

	// Dashboard
	$routes->add('u/dashboard', 'DashboardController::dashboard');
	$routes->add('u/userlist', 'DashboardController::userlist');
	$routes->add('u/extendexpire', 'DashboardController::extendexpire');
	$routes->add('u/adduser', 'DashboardController::adduser');
    $routes->add('u/generateusers', 'DashboardController::generateusers');
    $routes->add('u/edituser', 'DashboardController::edituser');
    $routes->add('u/userprofiles', 'DashboardController::userprofiles');
    $routes->add('u/adduserprofile', 'DashboardController::adduserprofile');
    $routes->add('u/printvoucher', 'DashboardController::printvoucher');
    $routes->add('u/paymentsettings', 'DashboardController::paymentsettings');
    $routes->add('u/paymentreport', 'DashboardController::paymentreport');
    $routes->add('u/paymentpage', 'DashboardController::paymentpage');
    $routes->add('u/traffic', 'DashboardController::traffic');

    $routes->add('u/pppprofiles', 'PPPController::ppp_profile');
    $routes->add('u/pppsecrets', 'PPPController::ppp_secret');

    //json data
    $routes->get('u/data/get_scheduler_by_name/(:any)', 'DataController::get_scheduler_by_name');
    $routes->get('u/data/get_ppp_active_by_name/(:any)', 'DataController::get_ppp_active_by_name');
    // $routes->get('u/data/get_hotspot_server', 'DataController::get_hotspot_server');
    // $routes->get('u/data/get_hotspot_profile', 'DataController::get_hotspot_profile');

    $routes->post('u/do_change_expire', 'DashboardController::do_change_expire');
    $routes->post('u/do_remove_user_by_uids', 'DashboardController::do_remove_user_by_uids');
    $routes->post('u/do_remove_user_by_comment', 'DashboardController::do_remove_user_by_comment');
    $routes->post('u/do_add_user', 'DashboardController::do_add_user');
    $routes->post('u/do_edit_user', 'DashboardController::do_edit_user');
    $routes->post('u/do_enable_user', 'DashboardController::do_enable_user');
    $routes->post('u/do_disable_user', 'DashboardController::do_disable_user');
    $routes->post('u/do_remove_userprofile', 'DashboardController::do_remove_userprofile');
    $routes->post('u/do_add_userprofile', 'DashboardController::do_add_userprofile');
    $routes->post('u/do_edit_userprofile', 'DashboardController::do_edit_userprofile');
    $routes->post('u/do_generate_users', 'DashboardController::do_generate_users');
    $routes->post('u/do_add_pppprofile', 'DashboardController::do_add_pppprofile');
    $routes->post('u/do_edit_pppprofile', 'DashboardController::do_edit_pppprofile');
    $routes->post('u/do_remove_pppprofile', 'DashboardController::do_remove_pppprofile');
    $routes->post('u/do_add_pppsecret', 'DashboardController::do_add_pppsecret');
    $routes->post('u/do_extend_pppsecret', 'DashboardController::do_extend_pppsecret');
    $routes->post('u/do_changeprice_pppsecret', 'DashboardController::do_changeprice_pppsecret');
    $routes->post('u/do_convert_ppp_secret', 'DashboardController::do_convert_ppp_secret');
    $routes->post('u/do_edit_pppsecret', 'DashboardController::do_edit_pppsecret');
    $routes->post('u/do_enable_pppsecret', 'DashboardController::do_enable_pppsecret');
    $routes->post('u/do_disable_pppsecret', 'DashboardController::do_disable_pppsecret');
    $routes->post('u/do_remove_pppsecret', 'DashboardController::do_remove_pppsecret');
    $routes->post('u/do_update_tripaydata', 'DashboardController::do_update_tripaydata');
    $routes->post('u/do_update_pm', 'DashboardController::do_update_pm');

    //tes route
    $routes->add('u/tes1', 'DashboardController::tes1');

	// //404
	// $routes->add('(:any)', 'DashboardController::e404');

}

/* =================== DEFAULT ROUTES ======================= */	
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->add('theme', 'Anu::demo');
// $routes->add('(:any)', 'Anu::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
