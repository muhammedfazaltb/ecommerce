@extends('layouts.shop_layout')
   
@section('content')
<div class="row">
            <div class="col-12" style="margin-left: 100px;">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Static Table</h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Category name</th>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($categories as $category)
                    <tr>
                      <th scope="row"></th>
                      <td>{{$category->category_name}}</td>
                      
                      <td><a href="{{URL::to('shop/editcategory/'.$category->id)}}" class="btn btn-info">edit</a></td>
                      <!-- <td><button type="button" onclick="deletcat({{$category->id}})" class="btn btn-danger"> Delete</button></td> -->
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            
              
            </div>
          </div>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
          	
function deletcat(id) {

 $.ajax({
          type: 'post',
          url: '{{ URL::route("ShopPostManage") }}',
          data: {_token:'{{ csrf_token() }}',type:'delete_cat',id:id},
          success: function(data) {
            if(data.statusCode == 6000){
                
                 swal(data.message).then(function(){
                 window.location.reload();
                 });
            }
            else{
                return false;
                window.location.reload();
            }
          }
    });
          
}
</script>

@endsection