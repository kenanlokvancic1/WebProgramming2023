<?php
Flight::route('POST /products', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productsService()->add($data));
});

Flight::route('GET /products', function(){
    Flight::json(Flight::productsService()->get());
});

Flight::route('GET /products/@id', function($id){
    Flight::json(Flight::productsService()->get_by_id($id));
});

Flight::route('PUT /products/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::productsService()->update($data, $id);
    Flight::json(array("message" => "products updated successfully"));
});

Flight::route('DELETE /products/@id', function($id){
    Flight::productsService()->delete($id);
    Flight::json(["message" => "products deleted successfully"]);
});
?>