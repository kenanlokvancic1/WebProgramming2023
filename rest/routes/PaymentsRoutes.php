<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


 /**
 * @OA\Get(path="/payments/", tags={"payments"}, summary="list all payments from the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="list all payments")
 * )
 */
Flight::route('GET /payments',function(){
    Flight::json(Flight::paymentsService()->getAll());
});

/**
 *  Returns one from the table by ID
 */

 /**
 * @OA\Get(path="/payments/{id}", tags={"payments"}, summary="List a specific payment. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="list a specific payment")
 * )
 */
Flight::route('GET /payments/@id',function($id){
    Flight::json(Flight::paymentsService()->getByID($id));
});

/**
 *  Adds new data to the table
 */

 /**
 * @OA\Post(path="/payments/", tags={"payments"}, summary="add new payments to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="add new payments")
 * )
 */
Flight::route('POST /payments', function(){
    $request=Flight::request();
    Flight::paymentsService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

/**
 * @OA\Put(path="/payments/{id}", tags={"payments"}, summary="update a payment ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="update a payment")
 * )
 */
Flight::route('PUT /payments/@id',function($id){
    $request=Flight::request();
    Flight::paymentsService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

/**
 * @OA\Delete(path="/payments/{id}", tags={"payments"}, summary="delete a payments from the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="delete a payments")
 * )
 */
Flight::route('DELETE /payments/@id',function($id){
    Flight::paymentsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
