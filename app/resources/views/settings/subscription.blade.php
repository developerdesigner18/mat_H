<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        {{config('app.name')}}
    </title>


    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{PUBLIC_DIR}}/uploads/FAVBizz.png">
    
</head>

<body class="g-sidenav-show  bg-light-blue">


    <section class="min-vh-100 mb-8">
     <div class="row">
        <div class="col-md-7 mx-auto text-center">
            <span class="badge bg-purple-light mb-3">{{__('Pricing and Plans')}}</span>
            <h3 class="text-dark">{{__('Ready to get started with Bizz Plan? Awesome!')}}</h3>
            <p class="text-secondary">{{__('Choose the plan that best fit for you.')}}</p>
        </div>
    </div>
    @if($workspace->subscribed)
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-purple-light">
                <div class="card-body">
                    <h6 class="fw-bolder">{{__('Billing')}}</h6>

                    @if($plan != null)
                    <h6>{{__('You are subscribed to the  ')}}<span class="badge bg-indigo text-white">{{$plan->name}}</span> </h6>
                    @else
                    <h6>{{'You are subscribed for the  '}}<span class="badge bg-indigo text-white">{{"Unlimited"}}</span> </h6>
                    @endif

                    @if(!empty($workspace->next_renewal_date) && $workspace->term != 'Unlimited')
                    <p><strong>{{__('Next renewal date')}}:</strong> {{date('M d Y',strtotime($workspace->next_renewal_date))}}</p>
                    <a href="/cancel-subscription?id={{$plan->id}}" type="button"
                        class="btn btn-sm  bg-pink-light text-danger mt-3 ">{{__('Cancel Subscription')}}</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @endif

        <div class="row mt-4">
            @foreach($plans as $plan)
            <div class="col-md-5 mx-auto text-center">
                <div class="card " style="box-shadow: 0 2px 6px 0 rgb(67 89 113 / 48%);">
                    <div class="card-header text-center ">
                        <h5 class="text-purple opacity-8 text mb-2">{{$plan->name}}</h5>
                        <p>{!! $plan->description !!}</p>
                        <span>
                            <h4 class="font-weight-bolder">
                                {{formatCurrency($plan->price_monthly,getWorkspaceCurrency($super_settings))}}
                                /<span><small
                                    class=" text-sm text-warning">{{__(' month')}}</small></span>
                                </h4> </span>

                                <h4 class="mt-0">
                                    {{formatCurrency($plan->price_yearly,getWorkspaceCurrency($super_settings))}}
                                    /<span><small
                                        class="text-sm text-warning">{{__('year')}}</small></span>
                                    </h4>

                                </div>
                                <div class="card-body mx-auto pt-0">
                                    @if($plan->features)

                                    @foreach(json_decode($plan->features) as $feature)

                                    <div class="justify-content-start d-flex px-2 py-1">
                                        <div>
                                            <i class="icon icon-shape text-center icon-xs rounded-circle fas fa-check bg-purple-light text-purple text-sm"></i>
                                        </div>
                                        <div class="ps-2">
                                            <span class="text-sm">{{$feature}}</span>
                                        </div>
                                    </div>


                                    @endforeach
                                    @endif
                                </div>
                                <div class="card-footer pt-0">

                                    @if($workspace->plan_id == $plan->id)
                                    <span class="badge bg-indigo text-white text-center my-3">{{__('Current Plan')}}</span>
                                        @endif

                                            @if($workspace->subscribed)

                                            <p class="text-center my-3"></p>

                                            @endif

                                            @if($plan->price_monthly && $plan->price_monthly > 0)

                                                <a href="/subscribes?id={{$plan->id}}&term=monthly" type="button"
                                                 class="btn btn-info btn-sm ">{{__('Pay Monthly')}}</a>

                                            @endif
                                            @if($plan->price_yearly && $plan->price_yearly > 0)

                                             <a href="/subscribes?id={{$plan->id}}&term=yearly" type="button"
                                                 class="btn btn-success btn-sm ">{{__('Pay Yearly')}}</a>
                                            @endif

                                            @if($plan->price_monthly && $plan->price_monthly == 0)
                                                 <a href="/subscribes?id={{$plan->id}}&term=free_plan" type="button"
                                                     class="btn btn-success btn-sm ">{{__('Choose free Plan')}}</a>
                                            @endif


                                         </div>
                                     </div>
                                 </div>
                                 @endforeach
                             </div>
                         </section>

<!-- <script>
    "use strict"
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script> -->

</body>

</html>
