
@extends('layouts.admin_layout')
   
@section('content')

<!--  -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Shop</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="{{route('admin.listshop')}}">Shop List

                        </a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Edit Shop</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Edit Shop</h3>
                            
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" method="POST" action="{{route('admin.updateshop')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-12">Shop name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" placeholder="shop name" class="form-control form-control-line" value="{{$results->name}}"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Shop email</label>
                                    <div class="col-md-8">
                                        <input type="email" name="email" value="{{$results->email}}" placeholder="email here...." class="form-control form-control-line" name="example-email" id="example-email"> </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-8">
                                        <input type="password" name="password" class="form-control form-control-line"> </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{$results->phone}}" name="phone" placeholder="phone number..!" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-8">
                                        <textarea rows="5" name="address" class="form-control form-control-line">{{$results->address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="country">
                                            <option value="1">London</option>
                                            <option value="2">India</option>
                                            <option value="3">Usa</option>
                                            <option value="4">Canada</option>
                                            <option value="5">Thailand</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="shop_id" value="{{$results->shop_id}}">
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