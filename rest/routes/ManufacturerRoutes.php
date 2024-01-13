<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


 /**
 * @OA\Post(path="/manufacturer/", tags={"manufacturer"}, summary="Add a manufacturer to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Add a manufacturer")
 * )
 */
Flight::route('POST /manufacturer', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::manufacturerService()->add($data));
});

/**
 * @OA\Get(path="/manufacturer/", tags={"manufacturer"}, summary="Get all manufacturers. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Get all manufacturers")
 * )
 */

Flight::route('GET /manufacturer', function(){
    Flight::json(Flight::manufacturerService()->getAll());
});

/**
 * @OA\Get(path="/manufacturer/{id}", tags={"manufacturer"}, summary="get a manufacturer by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Get a manufacturer")
 * )
 */

Flight::route('GET /manufacturer/@id', function($id){
    Flight::json(Flight::manufacturerService()->getByID($id));
});

/**
 * @OA\Put(path="/manufacturer/{id}", tags={"manufacturer"}, summary="update the manufaturers by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="update manufacturers by id")
 * )
 */
Flight::route('PUT /manufacturer/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::manufacturerService()->update($data, $id);
    Flight::json(array("message" => "manufacturer updated successfully"));
});

/**
 * @OA\Delete(path="/manufacturer/{id}", tags={"manufacturer"}, summary="delete a manufacturer from the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="delete a manufacturer")
 * )
 */

Flight::route('DELETE /manufacturer/@id', function($id){
    Flight::manufacturerService()->delete($id);
    Flight::json(["message" => "manufacturer deleted successfully"]);
});
?>