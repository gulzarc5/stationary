<script>
    var size_div_count = 1;
    $(function() {  
        $("#product_size_add_form").hide();
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
        });

        $(document).on('click',"#add_more_size_btn",function(){
            $("#product_size_add_form").show();
            $("#product_size_edit_form").hide();
        });

        $(document).on('click',"#size_add_form_back_btn",function(){
            $("#product_size_add_form").hide();
            $("#product_size_edit_form").show();
        });
    });



    function removeSize(id) {
        $("#sizes"+id).remove();
        size_div_count--;
    }


</script>