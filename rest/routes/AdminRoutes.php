<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/**
 * The following are methods for basic CRUD operations implemented in flight
 */

/**
 * @OA\Post(path="/admin/", tags={"admin"}, summary="Add a new admin to the db. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Add a new admin")
 * )
 */


Flight::route('POST /admin', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::adminService()->add($data));
});

/**
 * @OA\Get(path="/admin/", tags={"admin"}, summary="Returns all admins from the api. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of admins")
 * )
 */

Flight::route('GET /admin', function(){
    Flight::json(Flight::adminService()->getAll());
});


/**
 * @OA\Get(path="/admin/{id}", tags={"admin"}, summary="Returns admin by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of admins")
 * )
 */

Flight::route('GET /admin/@id', function($id){
    Flight::json(Flight::adminService()->getByID($id));
});

/**
 * @OA\Put(path="/admin/{id}", tags={"admin"}, summary="Update admin by id", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="=Update admin")
 * )
 */

Flight::route('PUT /admin/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::adminService()->update($data, $id);
    Flight::json(array("message" => "admin updated successfully"));
});

/**
 * @OA\Delete(path="/admin/{id}", tags={"admin"}, summary="Deletes admin by id. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="Deletes an admin")
 * )
 */

Flight::route('DELETE /admin/@id', function($id){
    Flight::adminService()->delete($id);
    Flight::json(["message" => "admin deleted successfully"]);
});



Flight::route('POST /login',function(){
    $login = Flight::request()->data->getData();

    $user = Flight::adminService()->getAdminByEmail($login['email']);

    if(isset($user['id'])){

        if($user['password'] == md5($login['password'])){ // md5 hash compatible
            
            unset($user['password']); //Deletes pw from user object so that it isn't encoded inside of the token
            $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
            Flight::json(['token' => $jwt]);

        }else{
            
            Flight::json(["message" => "Incorrect password"], 404);
        }
    }else{
        
        Flight::json(["message" => "User doesn't exist"], 404);
    }
});
