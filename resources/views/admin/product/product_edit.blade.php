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
    	            <h2>Edit Product</h2>
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
                    @if (isset($product))
                        <div class="x_content">
                    
                            {{ Form::open(['method' => 'post','route'=>'admin.product_update']) }}
                            <input type="hidden" name="p_id" value="{{$product->id}}">
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" name="name"  placeholder="Enter Product Name"  value="{{ $product->name }}" required>
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
                                                <option value="{{$item->id}}" {{ $product->category_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
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
                                            @if (isset($sub_category) && !empty($sub_category))
                                                @foreach ($sub_category as $item)
                                                    <option value="{{$item->id}}" {{ $product->sub_category_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            @endif
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
                                            @if (isset($brand) && !empty($brand))
                                                @foreach ($brand as $item)
                                                    <option value="{{$item->id}}" {{ $product->brand_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            @endif
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
                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="short_description" required>Type Product Short Descrpition</label>
                                        <textarea class="form-control" rows="4" name="short_description">{{ $product->short_description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="long_description">Type Product Long Descrpition</label>
                                        <textarea class="form-control" rows="6" name="long_description"  id="long-description">{{ $product->long_description }}</textarea>
                                    </div>
                                </div>
                        </div>

                            <div class="form-group">    
                                <button type="submit" class='btn btn-success'>Update</button>
                                <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                            </div>
                            {{ Form::close() }}

                        </div>
                    @endif
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')
    @include('admin.scripts.product');
 @endsection


        
    