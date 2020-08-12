@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Order List</h2>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
     
     <script type="text/javascript">
         $(function () {
    
            var table = $('#product_list').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 50,
                ajax: "{{ route('admin.order_list_ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},      
                    {data: 'name', name: 'name',searchable: true},    
                    {data: 'total_price', name: 'total_price',searchable: true},          
                    {data: 'payment_status', name: 'payment_status',searchable: true},
                    {data: 'action', name: 'action' ,searchable: true}, 
                ]
            });            
        });
     </script>
 @endsection