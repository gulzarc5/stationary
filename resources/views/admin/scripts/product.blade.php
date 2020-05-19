
 <script src="{{ asset('admin/ckeditor4/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'long-description', {
        height: 400,
    } );

    var size_div_count = 1;
    var specification_div_count = 1;
    $(function() {        

        $(document).on('change', "#category", function (event) {
            var category_id = $(this).val();
            if (category) {
                get_state_list(category_id);
                get_brand_list(category_id);
                get_size(category_id);
            }
        });

        $(document).on('click',"#add_more_size", function(){
            var size_html = `<br><div class="form-row mb-3">
                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="size">Enter Size Name</label>
                    <input type="text" class="form-control" name="size[]"  placeholder="Enter Size Name" required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="mrp">Enter Product M.R.P.</label>
                    <input type="number" class="form-control" name="mrp[]"  placeholder="Enter Product M.R.P." required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="customer_price">Enter Customer Price.</label>
                    <input type="number" class="form-control" name="customer_price[]"  placeholder="Enter Customer Price" required>
                </div>

            </div>
            
            <div class="form-row mb-3">
                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="retailer_price">Enter Retailer Price.</label>
                    <input type="number" class="form-control" name="retailer_price[]"  placeholder="Enter Retailer Price" required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="customer_discount">Enter Customer Discount.</label>
                    <input type="number" class="form-control" name="customer_discount[]"  placeholder="Enter Customer Discount" >
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="retailer_discount">Enter Retailer Discount.</label>
                    <input type="number" class="form-control" name="retailer_discount[]"  placeholder="Enter Retailer Discount" >
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
                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 26px;" onclick="removeSize(${size_div_count})">Remove</button>
                </div>
            </div>`;
            $("#size_div").append("<span id='sizes"+size_div_count+"'>"+size_html+"</span>");
            size_div_count++;
        })


        $(document).on('click',"#add_more_specification", function(){
            var specifications_html = `<div class="col-md-5 col-sm-12 col-xs-12 mb-3">
                    <label for="specification_name">Product Specification Name</label>
                    <input type="text" class="form-control" name="specification_name[]"  placeholder="Enter Product Specification Name">
                </div>

                <div class="col-md-5 col-sm-12 col-xs-12 mb-3">
                    <label for="specification_details">Product Specification Details</label>
                    <input type="text" class="form-control" name="specification_details[]"  placeholder="Enter Product Specification Details">
                </div>

                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 26px;"  onclick="removeSpecification(${specification_div_count})">Remove</button>
                </div>`;
            $("#product_specification_div").append("<span id='specifications"+specification_div_count+"'>"+specifications_html+"</span>");
            specification_div_count++;
        })
    });

    function removeSize(id) {
        $("#sizes"+id).remove();
        size_div_count--;
    }

    function removeSpecification(id) {
        $("#specifications"+id).remove();
        specification_div_count--;
    }

    function get_state_list(category_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('admin/sub/category/list/with/category') }}/"+ category_id,
            dataType: 'json',
            beforeSend: function () {
                $("#sub_category").html('');
            },
            success: function (response) {
                var data=response;
                if (!$.isEmptyObject(data)) {
                    var state_html = '<option value=""> Select Sub Category</option>';
                    $.each(data, function(i, e) {
                        state_html += '<option value="' + e.id + '">' + e.name + '</option>';
                    });
                    $("#sub_category").html(state_html);
                }else{
                    $("#sub_category").html('<option ""> No Sub Category Found </option>');
                }
            }
        })
    }


    function get_brand_list(category_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('admin/brands/list/with/category') }}/"+ category_id,
            dataType: 'json',
            beforeSend: function () {
                $("#brand").html('');
            },
            success: function (response) {
                var data=response;
                if (!$.isEmptyObject(data)) {
                    var brand_html = '<option ""> Select Brand</option>';
                    $.each(data, function(i, e) {
                        brand_html += '<option value="' + e.id + '">' + e.name + '</option>';
                    });
                    $("#brand").html(brand_html);
                }else{
                    $("#brand").html('<option ""> No Brand Found </option>');
                }
            }
        })
    }

    function get_size(category_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('admin/brands/list/with/category') }}/"+ category_id,
            dataType: 'json',
            beforeSend: function () {
                $("#brand").html('');
            },
            success: function (response) {
                var data=response;
                if (!$.isEmptyObject(data)) {
                    var brand_html = '<option value=""> Select Brand</option>';
                    $.each(data, function(i, e) {
                        brand_html += '<option value="' + e.id + '">' + e.name + '</option>';
                    });
                    $("#brand").html(brand_html);
                }else{
                    $("#brand").html('<option ""> No Brand Found </option>');
                }
            }
        })
    }
</script>