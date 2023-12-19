<?php
Flight::route('GET /payments',function(){
    Flight::json(Flight::paymentsDao()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /payments/@id',function($id){
    Flight::json(Flight::paymentsDao()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /payments', function(){
    $request=Flight::request();
    Flight::paymentsDao()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /payments/@id',function($id){
    $request=Flight::request();
    Flight::paymentsDao()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /payments/@id',function($id){
    Flight::paymentsDao()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>