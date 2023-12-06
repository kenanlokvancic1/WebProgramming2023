<?php
require dirname(__FILE__).'/../vendor/autoload.php';

require dirname(__FILE__).'/services/AdminService.php';
require dirname(__FILE__).'/services/ManufacturerService.php';
require dirname(__FILE__).'/services/OrdersService.php';

require_once dirname(__FILE__).'/routes/MovieRoutes.php';
require_once dirname(__FILE__).'/routes/ManufacturerRoutes.php';
require_once dirname(__FILE__).'/routes/OrdersRoutes.php';
require_once dirname(__FILE__).'/routes/PaymentsRoutes.php';
require_once dirname(__FILE__).'/routes/ProductsRoutes.php';
require_once dirname(__FILE__).'/routes/TypeRoutes.php';

Flight::register('adminService', 'AdminService');
Flight::register('manufacturerService', 'ManufacturerService');
Flight::register('ordersService', 'OrdersService');
Flight::register('paymentsService', 'PaymentsService');
Flight::register('productsService', 'ProductsService');
Flight::register('typeService', 'TypeService');


Flight::start();
?>