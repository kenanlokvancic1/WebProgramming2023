<?php
Flight::route('POST /admin', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::adminService()->add($data));
});

Flight::route('GET /admin', function(){
    Flight::json(Flight::adminService()->get());
});

Flight::route('GET /admin/@id', function($id){
    Flight::json(Flight::adminService()->get_by_id($id));
});

Flight::route('PUT /admin/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::adminService()->update($data, $id);
    Flight::json(array("message" => "admin updated successfully"));
});

Flight::route('DELETE /admin/@id', function($id){
    Flight::adminService()->delete($id);
    Flight::json(["message" => "admin deleted successfully"]);
});
?>