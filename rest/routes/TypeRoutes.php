<?php
Flight::route('POST /type', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::typeService()->add($data));
});

Flight::route('GET /type', function(){
    Flight::json(Flight::typeService()->get());
});

Flight::route('GET /type/@id', function($id){
    Flight::json(Flight::typeService()->get_by_id($id));
});

Flight::route('PUT /type/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::typeService()->update($data, $id);
    Flight::json(array("message" => "type updated successfully"));
});

Flight::route('DELETE /type/@id', function($id){
    Flight::typeService()->delete($id);
    Flight::json(["message" => "type deleted successfully"]);
});
?>