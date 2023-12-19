<?php
Flight::route('GET /products',function(){
    Flight::json(Flight::ordersDao()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /products/@id',function($id){
    Flight::json(Flight::ordersDao()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /products', function(){
    $request=Flight::request();
    Flight::ordersDao()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /products/@id',function($id){
    $request=Flight::request();
    Flight::ordersDao()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /products/@id',function($id){
    Flight::ordersDao()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>