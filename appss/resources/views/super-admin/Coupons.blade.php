@extends('layouts.super-admin-portal')
@section('content')
@include('layouts.links')
<style>
    .invalid{
        background: #f10000;
        color: white;
        width: fit-content;
        /* margin: 20px; */
        padding: 1px 10px;
        font-size: smaller;
        border-radius: 15px;
    }
    .valid-coupon
    {
        background: #2a5a03;
        color: white;
        width: fit-content;
        /* margin: 20px; */
        padding: 1px 10px;
        font-size: smaller;
        border-radius: 15px;
    }
    .error
    {
        color:#f10000;
    }
    div#coupontable_wrapper {
    display: flex;
    flex-direction: column;
}
    button.dt-button.buttons-csv.buttons-html5 {
        background: #438111;
    color: white;
    border: 0px;
    padding: 8px 30px;
    border-radius: 6px;
    float:right;
       }
   
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row mb-2">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Subscription Coupon List')}}
            </h5>
            <p class="text-muted">{{__('Create, edit or delete the Coupon')}}</p>
        </div>
        <div class="col text-end">
            <button  class="btn btn-info" data-bs-toggle="modal" data-bs-target="#crearecoupon" >{{__('Create Coupon')}}</button>
            <button  class="btn btn-info" id="clear_expired">{{__('Clear all expired')}}</button>
        </div>

        {{-- -------------------------------------- --}}

          <!-- Modal -->
            <div class="modal fade" id="crearecoupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Coupons</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="couponform">
                            <div class="col-md-6">
                              <label  class="form-label">Coupon Name *</label>
                              <input type="text" name="couponnae" class="form-control" placeholder="Coupon Name" id="inputEmail4">
                            </div>
                            <div class="col-md-6">
                              <label  class="form-label">Number Of Coupon *</label>
                              <input type="number" name="couponnumber" placeholder="Number of generate" class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                              <label  class="form-label">Valid Untill *</label>
                              <input id="startDate" name="validity" type="date" class="form-control" id="inputAddress" placeholder="Set Validity date">
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="crearecoupon-btn" class="btn btn-info">Create</button>
                        
                    </div>
                </form>
                </div>
                </div>
            </div>

        {{-- ------------------------------------------ --}}

        <div class="row">
            <table id="coupontable" class="display">
                <thead class="table-light">
                    <tr>
                        <th>Coupon Name</th>
                        <th>Coupon Code</th>
                        <th>Active</th>
                        <th>Valid till</th>
                        <th>User</th>
                    </tr>
                </thead>
            </table> 
        <div>
    </div>
@endsection
@section('script')
@include('layouts.scripts')
<script>
   $(document).ready(function()
   {
        $(function(){
            var date = new Date();
            var getmonth = date.getMonth() + 1;
            var getday = date.getDate();
            var getyear = date.getFullYear();
            if(getmonth < 10)
                getmonth = '0' + getmonth.toString();
            if(getday < 10)
                getday = '0' + getday.toString();
            var inDate = getyear + '-' + getmonth + '-' + getday;
            $('#startDate').attr('min', inDate);
        });
       
            var datatables= $("#coupontable").DataTable({
                dom: "Blfrtip",
                    buttons: [
                        {
                            text: 'Download CSV',
                            extend: 'csvHtml5',
                        }],
                "responsive": true,
                "processing" : true,
                "destroy": true,
                "order": [[ 0, "desc" ]],
                "ajax" : {
                            "url" : "{{url('/show-coupon')}}",
                            "dataSrc" : ''
                        },
                "autoWidth": false,
            
                "columns" : [ 
                                {
                                    "data" : "Coupon_name"
                                },
                                {
                                    "data" : "coupon_text"
                                },
                                {
                                    "data" : {active:"active"},
                                    "render":function(data,type,row)
                                    {
                                        if(data.active == 1)
                                        {
                                            return "<div class='valid-coupon'>Valid</div>";
                                        }
                                        else{
                                            return "<div class='invalid'>InValid</div>";
                                        }
                                    }
                                },
                                {
                                    "data" : "Validity"
                                },
                                {
                                    "data" : "UserId"
                                },
                                
                            ],
            })
   $("#couponform").validate({
       rules: {                
           couponnae: {required: true,},
           couponnumber: {required: true,},
           validity: {required: true,}
        },
        messages: {             
              couponnae: {required: "Please enter coupon name"},
              couponnumber: {required: "Please enter coupon number"},
              validity: {required: "Please Select validity of coupon"}
            },
            submitHandler: function()  {
                // e.preventdefault();
                var data = $("#couponform").serialize()
                $.ajax({
                    url:"{{url('/subscription-coupon')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: "json",
                    success:function(data)
                    {
                        if(data.success == '1')
                        {
                            Swal.fire("",data.response,"success");
                            datatables.ajax.reload();
                            $('#crearecoupon').modal('hide');
                            $( '#couponform' ).each(function(){
                                this.reset();
                            });
                        }
                        
                    }
                    
                })
            }
        });

        $(document).on('click','#clear_expired',function()
        {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, it will not be recovered!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1abc9c",
                cancelButtonColor: "#f1556c",
                confirmButtonText: "Yes, delete it!"
            }).then(function (result){   
                if (result.value){
                    $.ajax({
                        url: "{{url('/clear-expired-coupon')}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        success:function(data)
                        {
                            if(data.success == '1')
                            {
                                Swal.fire('',data.response,'success');
                                datatables.ajax.reload();
                            }
                            else{
                                Swal.fire('',data.response,'success');
                                datatables.ajax.reload();
                            }
                        }
                    })
                }
                else{
                 return false ;
                }
            });
        })
   })

</script>
@endsection
