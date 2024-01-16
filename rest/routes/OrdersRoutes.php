<?php
/**
 * The following are methods for basic CRUD operations implemented in flight
 */

  /**
 * @OA\Get(path="/orders/", tags={"orders"}, summary="lists all orders from the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="lists all orders")
 * )
 */
Flight::route('GET /orders',function(){
    Flight::json(Flight::ordersService()->getAll());
});

/**
 *  Returns one from the table by ID
 */

  /**
 * @OA\Get(path="/orders/{id}", tags={"orders"}, summary="Lists a specific order from the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Lists a specific order")
 * )
 */
Flight::route('GET /orders/@id',function($id){
    Flight::json(Flight::ordersService()->getByID($id));
});

/**
 *  Adds new data to the table
 */

  /**
 * @OA\Post(path="/orders/", tags={"orders"}, summary="Adds orders to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Adds orders")
 * )
 */
Flight::route('POST /orders', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::ordersService()->add($data));
});

 /**
 * @OA\Put(path="/orders/{id}", tags={"orders"}, summary="update a specific order to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="update a specific order")
 * )
 */
Flight::route('PUT /orders/@id',function($id){
    $data = Flight::request()->data->getData();
    Flight::ordersService()->update($data, $id);
    Flight::json(['message' => 'updated']);
});

 /**
 * @OA\Delete(path="/orders/{id}", tags={"orders"}, summary="delete an order to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="delete an order")
 * )
 */

Flight::route('DELETE /orders/@id',function($id){
    Flight::ordersService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
