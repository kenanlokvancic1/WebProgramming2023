<?php
Flight::route('POST /payments', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentsService()->add($data));
});

Flight::route('GET /payments', function(){
    Flight::json(Flight::paymentsService()->get());
});

Flight::route('GET /payments/@id', function($id){
    Flight::json(Flight::paymentsService()->get_by_id($id));
});

Flight::route('PUT /payments/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::paymentsService()->update($data, $id);
    Flight::json(array("message" => "payments updated successfully"));
});

Flight::route('DELETE /payments/@id', function($id){
    Flight::paymentsService()->delete($id);
    Flight::json(["message" => "payments deleted successfully"]);
});
?>