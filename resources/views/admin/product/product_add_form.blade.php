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
    	            <h2>Add New Product</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.product_insert' , 'enctype'=>'multipart/form-data', 'id'=>'product_form']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Product Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Product Name"  value="{{ old('name') }}" required>
                                  @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Select Category</label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @enderror
                                </div>                              
                            </div>

                            <div class="form-row mb-10">

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="sub_category">Select Sub Category</label>
                                    <select class="form-control" name="sub_category" id="sub_category" required>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                    @if($errors->has('sub_category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="brand">Select Brand</label>
                                    <select class="form-control" name="brand" id="brand" required>
                                        <option value="">Select Brand</option>
                                    </select>
                                    @if($errors->has('brand'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="well" style="overflow: auto">
                            <div id="size_div">
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size">Enter Size Name</label>
                                        <input type="text" class="form-control" name="size[]"  placeholder="Enter Size Name"  required>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="mrp">Enter Product M.R.P.</label>
                                        <input type="number" class="form-control" name="mrp[]"  placeholder="Enter Product M.R.P."  required>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="customer_price">Enter Customer Price.</label>
                                        <input type="number" class="form-control" name="customer_price[]"  placeholder="Enter Customer Price"  required>
                                    </div>

                                </div>
                                
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="retailer_price">Enter Retailer Price.</label>
                                        <input type="number" class="form-control" name="retailer_price[]"  placeholder="Enter Retailer Price" required>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="customer_discount">Enter Customer Discount.</label>
                                        <input type="number" class="form-control" name="customer_discount[]"  placeholder="Enter Customer Discount">
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="retailer_discount">Enter Retailer Discount.</label>
                                        <input type="number" class="form-control" name="retailer_discount[]"  placeholder="Enter Retailer Discount">
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="min_order_quantity">Retailer Min Order Quantity</label>
                                        <input type="number" class="form-control" name="min_order_quantity[]"  placeholder="Enter Retailer Min Order Quantity"  required>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" name="stock[]"  placeholder="Enter Product Stock"  required>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <button type="button" class="btn btn-info btn-sm" style="margin-top: 26px;" id="add_more_size">Add More Size</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10" id="product_specification_div">
                                <div class="col-md-5 col-sm-12 col-xs-12 mb-3">
                                    <label for="specification_name">Product Specification Name</label>
                                    <input type="text" class="form-control" name="specification_name[]"  placeholder="Enter Product Specification Name">
                                </div>

                                <div class="col-md-5 col-sm-12 col-xs-12 mb-3">
                                    <label for="specification_details">Product Specification Details</label>
                                    <input type="text" class="form-control" name="specification_details[]"  placeholder="Enter Product Specification Details">
                                </div>

                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <button type="button" class="btn btn-info btn-sm" style="margin-top: 26px;" id="add_more_specification">Add More Specification</button>
                                </div>
                            </div>
                       </div>

                       <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="short_description" required>Select Product Images <span> * Please Select Image Less Then 1.5 MB each</span></label>
                                    <input type="file" class="form-control" name="image[]" id="image" onchange="Filevalidation()" multiple required/>
                                    <span id="file_error" style="color:red"></span>
                                </div>
                            </div>
                       </div>


                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="short_description" required>Type Product Short Descrpition</label>
                                    <textarea class="form-control" rows="4" name="short_description">{{ old('short_description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="long_description">Type Product Long Descrpition</label>
                                    <textarea class="form-control" rows="6" name="long_description"  id="long-description">{{ old('long_description') }}</textarea>
                                </div>
                            </div>
                       </div>

    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
    	            	</div>
    	            	{{ Form::close() }}

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')
    <script> 
        function Filevalidation(){ 
            var fi = document.getElementById('image'); 
            // Check if any file is selected. 
            var status = true;
            if (fi.files.length > 0) { 
                for (var i = 0; i <= fi.files.length - 1; i++) { 
    
                    var fsize = fi.files.item(i).size; 
                    var file = Math.round((fsize / 1024)); 
                    // The size of the file. 
                    if (file > 1538) { 
                        $("#file_error").html('please Select File less then 1.5 MB');
                        $("#image").val('');
                        status = false;
                        return false;
                    } 
                } 
            }
            if (status) {
                $("#file_error").html('');
            } 
        } 
    </script>
    @include('admin.scripts.product');
 @endsection


        
    