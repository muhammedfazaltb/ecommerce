
@extends('layouts.admin_layout')
   
@section('content')

<!--  -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit coupons </h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="">Coupon

                        </a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add Coupon</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Edit Coupon</h3>
                            
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" method="POST" action="{{route('admin.updatecoupon')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-12">Coupon Code</label>
                                    <div class="col-md-8">
                                        <input type="text" name="coupon_code" value="{{$coupon->    coupon_code}}" placeholder="coupon code" class="form-control form-control-line"> </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-md-12">Amount</label>
                                    <div class="col-md-8">
                                        <input type="text" name="amount" value="{{$coupon->amount}}" placeholder="amount" class="form-control form-control-line"> </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="id" value="{{$coupon->id}}">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                               
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

<!--  -->

        </div>
                @endsection