<?php
Flight::route('GET /orders',function(){
    Flight::json(Flight::ordersDao()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /orders/@id',function($id){
    Flight::json(Flight::ordersDao()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /orders', function(){
    $request=Flight::request();
    Flight::ordersDao()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /orders/@id',function($id){
    $request=Flight::request();
    Flight::ordersDao()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /orders/@id',function($id){
    Flight::ordersDao()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>