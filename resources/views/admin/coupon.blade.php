@extends('layouts.admin_layout')
   
@section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Basic Table</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="{{route('coupons.list')}}"  class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Coupon

                        </a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Category Lists</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Counpon Lists</h3>
                           
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>Coupon name</th>
                                            <th>Amount</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($coupons as $coupon)
                                        <tr>
                                            
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{$coupon->amount}}</td>
                                          
                                           <td><a href="{{URL::to('admin/editcoupon/'.$coupon->id)}}" class="btn btn-info">edit</a></td>
                                         <td><button class="btn btn-danger" type="button"  onclick="deletecoupon({{$coupon->id}});">Delete</button></td>                                           
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function deletecoupon(id)
        {
            $.ajax({
          type: 'post',
          url: '{{ URL::route("AdminPostManage") }}',
          data: {_token:'{{ csrf_token() }}',type:'delete_coupon',id:id},
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