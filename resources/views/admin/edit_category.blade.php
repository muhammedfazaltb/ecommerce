
@extends('layouts.admin_layout')
   
@section('content')

<!--  -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Add category </h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="{{route('admin.listshop')}}">Shop List

                        </a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add Category</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Edit</h3>
                            
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" method="POST" action="{{route('admin.updatecategory')}}" enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-12">Category name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" value="{{$category->category_name}}" placeholder="category name" class="form-control form-control-line"> </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-12">Description</label>
                                    <div class="col-md-8">
                                        <textarea rows="5" name="description" class="form-control form-control-line">{{$category->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Image</label>
                                    <div class="col-md-8">
                                       <input type="file" class="form-control" name="image" 
                        />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="id" value="{{$category->id}}">
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