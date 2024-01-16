<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */

/**
 * @OA\Get(path="/products/", tags={"products"}, summary="Returns all productss from the api. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of productss")
 * )
 */
 
Flight::route('GET /products',function(){
    Flight::json(Flight::productsService()->getAll());
});


/**
 *  Returns one from the table by ID
 */

 /**
 * @OA\Get(path="/products/{id}", tags={"products"}, summary="Returns products by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of productss\")
 * )
 */
Flight::route('GET /products/@id',function($id){
    Flight::json(Flight::productsService()->getByID($id));
});

/**
 *  Adds new data to the table
 */

 /**
 * @OA\Post(path="/products/", tags={"products"}, summary="Add a new products to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Add new products")
 * )
 */
Flight::route('POST /products', function(){
    $request=Flight::request();
    Flight::productsService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

/**
 * @OA\Put(path="/products/{id}", tags={"products"}, summary="Update products by id", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Update products")
 * )
 */

Flight::route('PUT /products/@id',function($id){
    $request=Flight::request();
    Flight::productsService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

/**
 * @OA\Delete(path="/products/{id}", tags={"products"}, summary="Deletes products by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Deletes products")
 * )
 */

Flight::route('DELETE /products/@id',function($id){
    Flight::productsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});

