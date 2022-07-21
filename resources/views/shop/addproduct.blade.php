@extends('layouts.shop_layout')
   
@section('content')
<div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Product</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('shop.listproduct')}}">Product list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Library
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
       
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form class="form-horizontal" action="{{route('shop.createproduct')}}" enctype='multipart/form-data'  method="POST">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Select Category</label
                      >
                      <div class="col-sm-9">
                       <select id="category_id" name="category_id">
                        <option value="">select</option>
                        @foreach($categories as $category)
                         <option value="{{$category->id}}">{{$category->category_name}}</option>
                         @endforeach
                       </select>
                      </div>
                    </div>
                     
                 <!--  -->
                 <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Select Brand</label>
                      <div class="col-sm-9">
                       <select name="division_id" id="div_id">
               
                        </select>
                      </div>
                    </div>
                  <!--  -->

                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Product Name</label
                      >
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name Here"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="cono1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Description</label
                      >
                      <div class="col-sm-9">
                        <textarea name="description" class="form-control"></textarea>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label
                        for="cono1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Price</label
                      >
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Price"/>
                      </div>
                    </div> 
                        <div class="form-group row">
                      <label
                        for="cono1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Color</label
                      >
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder="color"/>
                      </div>
                    </div> 
                        <div class="form-group row">
                      <label
                        for="cono1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Size</label
                      >
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="product_size" name="product_size" placeholder="enter size"/>
                      </div>
                    </div> 
                    <div class="form-group row">
                    <label class="col-sm-3 text-end control-label col-form-label">Primary image</label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" 
                        />
                        
                      </div>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 text-end control-label col-form-label"></label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <!-- <input type="file" class="custom-file-input" id="validatedCustomFile"
                        /> -->
                        
                      </div>
                      <div class="col-sm-9">
                        
                        <button type="submit" class="btn btn-primary">submit</button>
                      </div>
                    </div>
                  </div>
                  </div>
                  
                </form>
              </div>
            
        </div>
        
        <footer class="footer text-center">
          All Rights Reserved by Matrix-admin. Designed and Developed by
          <a href="https://www.wrappixel.com">WrapPixel</a>.
        </footer>
       
      </div>
      
    </div>
    
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../dist/js/pages/mask/mask.init.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
    <script>
      //***********************************//
      // For select 2
      //***********************************//
      $(".select2").select2();

      /*colorpicker*/
      $(".demo").each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
          control: $(this).attr("data-control") || "hue",
          position: $(this).attr("data-position") || "bottom left",

          change: function (value, opacity) {
            if (!value) return;
            if (opacity) value += ", " + opacity;
            if (typeof console === "object") {
              console.log(value);
            }
          },
          theme: "bootstrap",
        });
      });
      /*datwpicker*/
      jQuery(".mydatepicker").datepicker();
      jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
      });
      var quill = new Quill("#editor", {
        theme: "snow",
      });
    </script>
  </body>
</html>
<script type="text/javascript">
    $( document ).ready(function() {
 $("#category_id").change(function(){
    var val=$("#category_id :selected").val();
    $.ajax({
          type: 'post',
          url: '{{ URL::route("ShopPostManage") }}',
          data: {_token:'{{ csrf_token() }}',type:'check_brand',val:val},
          success: function(data) {
            if(data.statusCode == 6000){
                $("#div_id").empty();
                $("#div_id").append(data.result);
                 // swal(data.message).then(function(){
                 // window.location.reload();
                 // });
            }
            else{
                return false;
                window.location.reload();
            }
          }
    });
  
});
});
     
</script>
@endsection
