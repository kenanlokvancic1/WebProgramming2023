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
      $.ajax({
        url: "rest/products",
        type: "GET",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },

        success: function(data){
            console.log("test")
            var html="";
        
            for(let i=0;i<data.length;i++){
      
              html+=`
              <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.shutterstock.com/image-vector/pc-components-cpu-gpu-motherboard-600nw-2155566795.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">` + data[i].product_desc + `</h4>
                        <h5 class="card-title">Price: `+data[i].price+`</h5>
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
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          //toastr.error(XMLHttpRequest.responseJSON.message);
          adminService.logout();
        }
        });
    },

    get: function(id){
        $(".products-button").attr("disabled",true);
        $.ajax({
          url: "rest/products/"+id,
          type: "GET",
          beforeSend: function(xhr){
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success: function(data){
            console.log(data);
            console.log(data);
            $("#exampleModal .modal-body").html(id);
            $("#id").val(data.id);
            $("#product_desc").val(data.product_desc);
            $("#price").val(data.price);
            $("#type_id").val(data.type_id);
            $("#manufacturer_id").val(data.manufacturer_id);
            $("#exampleModal").modal("show")
            $(".products-button").attr("disabled",false);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest.responseJSON.message);
          adminService.logout();
        }
        })
    },

    add: function(products){
        $.ajax({
            url:'rest/products',
            type:'POST',
            data:JSON.stringify(products),
            contentType:'application/json',
            dataType:'json',

            beforeSend: function(xhr){
              console.log(products)
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
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
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(result){
        $('#products-list').html(`<div id="products-list" class="row">
              <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                  </div>
              </div>
          </div>`)
          ProductsService.list();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        adminService.logout();
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
          beforeSend: function(xhr){
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
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