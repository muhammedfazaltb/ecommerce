
@extends('layouts.user_layout')
   
@section('content')
 <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    	@foreach($orders as $order)
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">{{$order->product_name}}</td>
                            <td class="align-middle">{{$order->price}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$order->count}}">
                                </div>
                            </td>
                            <td class="align-middle">{{$order->total}}</td>
                            @if($order->status==1)
                            <td class="align-middle">ordered</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger" type="button" onclick="deleteitem({{$order->checkout_id}})"><i class="fa fa-times"></i></button></td>
                            @elseif(($order->status==2))
                            <td class="align-middle">Cancelled on {{date('d/m/Y', strtotime($order->updated_at))}}</td>
                            @else
                            <td class="align-middle">delivered</td>
                            @endif
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
    function deleteitem(id)
    { 
         $.ajax({
          type: 'post',
          url: '{{ URL::route("UserPostManage") }}',
          data: {_token:'{{ csrf_token() }}',type:'cancel_order',id:id},
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