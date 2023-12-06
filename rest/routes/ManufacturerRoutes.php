<?php
Flight::route('POST /manufacturer', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::manufacturerService()->add($data));
});

Flight::route('GET /manufacturer', function(){
    Flight::json(Flight::manufacturerService()->get());
});

Flight::route('GET /manufacturer/@id', function($id){
    Flight::json(Flight::manufacturerService()->get_by_id($id));
});

Flight::route('PUT /manufacturer/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::manufacturerService()->update($data, $id);
    Flight::json(array("message" => "manufacturer updated successfully"));
});

Flight::route('DELETE /manufacturer/@id', function($id){
    Flight::manufacturerService()->delete($id);
    Flight::json(["message" => "manufacturer deleted successfully"]);
});
?>