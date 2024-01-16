<?php
/**
 * The following are methods for basic CRUD operations implemented in flight
 */

/**
 * @OA\Get(path="/type/", tags={"type"}, summary="Returns all types from the api. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of types")
 * )
 */

Flight::route('GET /type', function(){
    Flight::json(Flight::typeService()->getAll());
});

 /**
 * @OA\Get(path="/type/{id}", tags={"type"}, summary="Returns type by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of types")
 * )
 */

Flight::route('GET /type/@id', function($id){
    Flight::json(Flight::typeService()->getByID($id));
});

 /**
 * @OA\Post(path="/type/", tags={"type"}, summary="Add a new type to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Add new type")
 * )
 */

Flight::route('POST /type', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::typeService()->add($data));
});

/**
 * @OA\Put(path="/type/{id}", tags={"type"}, summary="Update type by id", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Update type")
 * )
 */

Flight::route('PUT /type/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::typeService()->update($data, $id);
    Flight::json(array("message" => "type updated successfully"));
});

/**
 * @OA\Delete(path="/type/{id}", tags={"type"}, summary="Deletes type by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Deletes type")
 * )
 */

Flight::route('DELETE /type/@id', function($id){
    Flight::typeService()->delete($id);
    Flight::json(["message" => "type deleted successfully"]);
});
