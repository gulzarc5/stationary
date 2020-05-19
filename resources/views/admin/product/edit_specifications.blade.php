@extends('admin.template.admin_master')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Edit Product Specifications</h2>
    	            <div class="clearfix"></div>
    	        </div>
                <div>
                     @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                     @endif
                     @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                     @endif

                </div>
    	        <div>
    	            <div class="x_content">
                        @if (isset($product))
                            <div id="product_sp_add_form">
                                {{ Form::open(['method' => 'post','route'=>'admin.product_add_new_specofication']) }}
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-row mb-10" id="product_specification_div">
                                        <div class="col-md-5 col-sm-12 col-xs-12 mb-3">
                                            <label for="specification_name">Product Specification Name</label>
                                            <input type="text" class="form-control" name="specification_name[]"  placeholder="Enter Product Specification Name" required>
                                        </div>
        
                                        <div class="col-md-5 col-sm-12 col-xs-12 mb-3">
                                            <label for="specification_details">Product Specification Details</label>
                                            <input type="text" class="form-control" name="specification_details[]"  placeholder="Enter Product Specification Details" required>
                                        </div>
        
                                        <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                            <button type="button" class="btn btn-info btn-sm" style="margin-top: 26px;" id="add_more_specification">Add More Specification</button>
                                        </div>                                       
                                    </div>
                                    <div class="form-row mb-10">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">   
                                            <button type="submit" class='btn btn-success'>Submit</button>
                                            <button type="button" class='btn btn-warning' id="sp_add_form_back_btn">Back</button>
                                        </div>
                                    </div>
                                    
                                {{ Form::close() }}
                            </div>

                            <div id="product_sp_edit_form">

                                @if (isset($product->specifications))
                                    <div class="col-md-12">
                                        {{ Form::open(['method' => 'post','route'=>'admin.product_update_specofication']) }}
                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Specification Name</th>
                                                <th>Specification details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->specifications as $item)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="sp_id[]" value="{{$item->id}}">
                                                        <input type="text" class="form-control" name="specification_name[]"  placeholder="Enter Specification Name" value="{{$item->name}}"  required>
                                                    </td>
                                                    <td> 
                                                        <input type="text" class="form-control" name="specification_details[]"  placeholder="Enter Specification Details" value="{{$item->value}}"  required>
                                                    </td>
                                                    <td> 
                                                        <a href="{{route('admin.product_delete_specofication',['sp_id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach      
                                            <tr>
                                                <td colspan="9" align="center">
                                                    <button type="button" class="btn btn-sm btn-primary" id="add_more_sp_btn">Add New Specifications</button>
                                                    <button type="submit" class='btn btn-success'>Update Specifications</button>
                                                    <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                                                </td>
                                            </tr>                      
                                        </tbody>
                                        </table>
                                        {{ Form::close() }}
                                    </div>                    
                                @endif
                                
                            </div>  
                        @endif
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
</div>


 @endsection

@section('script')
    <script>

    </script>
    @include('admin.scripts.product_specification');
 @endsection


        
    