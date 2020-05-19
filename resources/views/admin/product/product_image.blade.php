@extends('admin.template.admin_master')

@section('content')
<style>
    .product-image img {
        width: 90%
    }

    .imgview  a img{
        width: 100%;        
        height: 201px;
    }
    .imgview .imgaction{
        position: absolute;
        top: 50%;
        left: 23%;
        background-color: #333;
        border: 0;
        display: none;
    }
    .imgview .actualimg:hover .imgaction {
        display: block;
    }
    .imgview .actualimg:hover a img {
        opacity: .7;
    }
    .actualimg {
        margin-bottom: 20px;
        min-height: 161px;
    }
    .removeitem {
        position: absolute;
        top: 0;
        right: 4%;
        background: #fff;
        padding: 5px 9px;
        z-index: 99;
    }
    .removeitem:hover i {
        font-size: 21px;
    }
    .removeitem i {
        font-size: 17px;
        color: #ff000096;
    }

</style>
<div class="right_col" role="main">

    <div class="">
      
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-3"></div>
        @if (isset($product) && !empty($product))
       
            <div class="col-md-6" style="display: none;" id="add_new_image_div">
                <div class="x_panel">
                    <h3>Add New Image</h3>
                    <div class="x_content">
                        <div class="row">                
                        {{ Form::open(['method' => 'post','route'=>'admin.product_add_new_images','enctype'=>'multipart/form-data']) }}

                            <input type="hidden" name="p_id" value="{{$product->id}}">
                            
                            <div class="well" style="overflow: auto;">
                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="short_description" required>Select Product Images <span> * Please Select Image Less Then 1.5 MB each</span></label>
                                        <input type="file" class="form-control" name="image[]" id="image" onchange="Filevalidation()" multiple required/>
                                        <span id="file_error" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                                
                                <div class="form-group">    	            	
                                    <input class="btn btn-success" type="submit" value="Submit">
                                    <a href="#"  class="btn btn-danger" onclick="imageAddDivClose()">Cancel</a>  
                                </div>
                        {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($product->images) && !empty($product->images))
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Product Images</h2>
                            <a href="#" class="btn btn-warning" style="float:right;" onclick="imageAddDivOpen()">+ Add More</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="product-image">
                                        <img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt="..." />                                    
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 imgview">
                                    @foreach ($product->images as $item)
                                        @if ($product->main_image != $item->image)
                                            <div class="col-md-4 col-sm-4 col-xs-12 actualimg">   
                                            <a class="removeitem" href="{{route('admin.product_delete_image',['image_id'=>$item->id])}}"><i class="fa fa-trash"></i></a>                   
                                                <a>
                                                <img src="{{asset('images/products/thumb/'.$item->image.'')}}" alt="..." />
                                                </a>
                                            <a href="{{route('admin.product_make_cover_image',['image_id'=>$item->id])}}" class="btn btn-success imgaction">Choose as cover</a>                
                                            </div> 
                                        @endif                                    
                                    @endforeach                
                                
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            @endif
        @endif
      </div>
    </div>
</div>
  <!-- /page content -->

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
     <script>
       function imageAddDivOpen() {
         $("#add_new_image_div").show();
       }
       function imageAddDivClose() {
         $("#add_new_image_div").hide();
       }
     </script>
 @endsection