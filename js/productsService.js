var ProductsService = {
    init: function(){
        $('#addProductsForm').validate({
            submitHandler: function(form){ 
              var products = Object.fromEntries((new FormData(form)).entries())
              ProductsService.add(products);
            }
          });
          ProductsService.list();
    },

    list: function(){
        $.get('rest/products',function(data){
            $("#products-list").html("");
            console.log(data);
            var html="";
            for(let i=0;i<data.length;i++){
      
                html+=`
                <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fbanner2.kisspng.com%2F20180422%2Fvzq%2Fkisspng-drawing-book-sketch-5adcf25816d295.9076212715244294000935.jpg&f=1&nofb=1" alt="Card image cap">
                    <div class="card-body">
                    <h4 class="card-title">` + data[i].product_desc + ` ` + data[i].type_id + ` ` + data[i].manufacturer_id + `</h4>
                        <h5 class="card-title">`+data[i].price+`</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary products-button" onclick="ProductsService.get(`+data[i].id+`)">View Info</button>
                            <button type="button" class="btn btn-danger products-button" onclick="ProductsService.delete(`+data[i].id+`)">Delete</button>
                        </div>
                    </div>
                    </div>
                    </div>`;
            }
            $("#products-list").html(html);
        });
    },

    get: function(id){
        $(".products-button").attr("disabled",true);
        $.get('rest/poducts/'+id,function(data){
            console.log(data);
            //$("#exampleModal .modal-body").html(id);
            $("#id").val(data.id);
            $("#productDesc").val(data.product_desc);
            $("#price").val(data.price);
            $("#typeID").val(data.type_id);
            $("#manufacturerID").val(data.manufacturer_id);
            $("#exampleModal").modal("show")
            $(".products-button").attr("disabled",false);
        })
    },

    add: function(products){
        $.ajax({
            url:'rest/products',
            type:'POST',
            data:JSON.stringify(products),
            contentType:'application/json',
            dataType:'json',
            success:function(result){
              $('#products-list').html(`<div id="products-list" class="row">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                          <span class="sr-only"></span>
                        </div>
                    </div>
                </div>`);
              $("#addElement").modal("hide");
              ProductsService.list();
              console.log(result);
            }
          })
    },

    delete: function(id){
     $(".products-button").attr("disabled",true);
    $.ajax({
      url:'rest/products/'+id,
      type:'DELETE',
      success: function(result){
        $('#products-list').html(`<div id="products-list" class="row">
              <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                  </div>
              </div>
          </div>`)
          ProductsService.list();
      }
    })
    },

    update: function(id){
        $(".products-button").attr("disabled",true);
        var products={};
        products.product_desc=$("#productDesc").val();
        products.price=$("price").val();
        products.type_id=$("typeID").val();
        products.manufacturer_id=$("#manufacturerID").val();
    
        $.ajax({
          url:'rest/products/'+$("#id").val(),
          type:'PUT',
          data:JSON.stringify(products),
          contentType:'application/json',
          dataType:'json',
          success: function(result){
            $("#exampleModal").modal("hide");
            $(".products-button").attr("disabled",false);
            $('#products-list').html(`<div id="products-list" class="row">
                  <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                      </div>
                  </div>
              </div>`)
              ProductsService.list();
          }
        })
    }
}