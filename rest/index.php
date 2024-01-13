<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require dirname(__FILE__).'/../vendor/autoload.php';


//services
require dirname(__FILE__).'/services/AdminService.class.php';
require dirname(__FILE__).'/services/ManufacturerService.class.php';
require dirname(__FILE__).'/services/OrdersService.class.php';
require dirname(__FILE__).'/services/PaymentsService.class.php';
require dirname(__FILE__).'/services/ProductsService.class.php';
require dirname(__FILE__).'/services/TypeService.class.php';


//routes
require_once dirname(__FILE__).'/routes/AdminRoutes.php';
require_once dirname(__FILE__).'/routes/ManufacturerRoutes.php';
require_once dirname(__FILE__).'/routes/OrdersRoutes.php';
require_once dirname(__FILE__).'/routes/PaymentsRoutes.php';
require_once dirname(__FILE__).'/routes/ProductsRoutes.php';
require_once dirname(__FILE__).'/routes/TypeRoutes.php';


//register
Flight::register('adminService', 'AdminService');
Flight::register('manufacturerService', 'ManufacturerService');
Flight::register('ordersService', 'OrdersService');
Flight::register('paymentsService', 'PaymentsService');
Flight::register('productsService', 'ProductsService');
Flight::register('typeService', 'TypeService');

//dao
Flight::register('adminDao','AdminDao');
Flight::register('manufacturerDao','ManufacturerDao');
Flight::register('ordersDao','OrdersDao');
Flight::register('paymentsDao','PaymentsDao');
Flight::register('productsDao','ProductsDao');
Flight::register('typeDao','TypeDao');



Flight::route('/*', function(){

    $path = Flight::request()->url;
    if ($path == '/login') return TRUE;
  
    $headers = getallheaders();
    if (@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });


Flight::start();
?>