<?php
Flight::route('POST /orders', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::ordersService()->add($data));
});

Flight::route('GET /orders', function(){
    Flight::json(Flight::ordersService()->get());
});

Flight::route('GET /orders/@id', function($id){
    Flight::json(Flight::ordersService()->get_by_id($id));
});

Flight::route('PUT /orders/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::ordersService()->update($data, $id);
    Flight::json(array("message" => "orders updated successfully"));
});

Flight::route('DELETE /orders/@id', function($id){
    Flight::ordersService()->delete($id);
    Flight::json(["message" => "orders deleted successfully"]);
});
?>