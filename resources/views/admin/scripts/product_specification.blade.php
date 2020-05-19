<script>
    var specification_div_count = 1;
    $(function() {  
        $("#product_sp_add_form").hide();
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

        $(document).on('click',"#add_more_sp_btn",function(){
            $("#product_sp_add_form").show();
            $("#product_sp_edit_form").hide();
        });

        $(document).on('click',"#sp_add_form_back_btn",function(){
            $("#product_sp_add_form").hide();
            $("#product_sp_edit_form").show();
        });
    });



    function removeSpecification(id) {
        $("#specifications"+id).remove();
        specification_div_count--;
    }


</script>