<!DOCTYPE html>
<html lang="en">

<head>
 <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css?v=1126" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="{{PUBLIC_DIR}}/uploads/FAVBizz.png">
    

 @if(!empty($payment_gateways['stripe']) && !empty($payment_gateways['stripe']->public_key))
 <script src="https://js.stripe.com/v3/"></script>
 @endif
 @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
 <script src="https://www.paypal.com/sdk/js?client-id={{$payment_gateways['paypal']->username}}&vault=true&intent=subscription">
 </script>
 @endif

 <title>
    {{config('app.name')}}
</title>



</head>

<body class="g-sidenav-show  bg-light-blue">

    <section class="min-vh-100 mb-8">
        <div class="container">
          <div class="row">
            <div class="col-md-5 d-flex flex-column mx-auto">
                <div class="card card-info mt-8" style="padding: 25px; box-shadow: 0 2px 6px 0 rgb(67 89 113 / 48%);">
                 <h3>{{$plan->name}}</h3>
                 @if ($errors->any())
                 <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(!empty($payment_gateways))

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if(!empty($payment_gateways['stripe']))
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if(array_key_first($payment_gateways) === 'stripe') active @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#gateway-stripe" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{__('Credit/Debit Card')}}</button>
                    </li>
                    @endif
                    @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->public_key))
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if(array_key_first($payment_gateways) === 'paypal') active @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#gateway-paypal" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{__('PayPal')}}</button>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($payment_gateways['stripe']))
                    <div class="tab-pane fade @if(array_key_first($payment_gateways) === 'stripe') show active @endif" id="gateway-stripe" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div id="stripeDiv" class="my-3 p-3">
                            <form action="/payment-stripe" method="post" id="payment-form">
                                <div class="form-row">
                                    <label for="card-element">
                                        {{__('Credit or debit card')}}
                                    </label>
                                    <div id="card-element" class="form-control">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>

                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <input type="hidden" name="term" value="{{$term}}">

                                @csrf

                                <button class="btn btn-info mt-4" id="btnStripeSubmit"
                                >{{__('Submit Payment')}}</button>

                            </form>
                            <div class="col-lg-2 " style="margin-left:57px ;">
                              {{('OR')}}  
                          </div>
                          <button class="btn btn-success" id="usebarcode"> Use Licence Code </button>
                          <form class="Coupancode" style="display:none;" id="coupan_code">
                            <div class="form-group">
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <input type="hidden" name="term" value="{{$term}}">
                                <input type="text"  name="Coupancode" class="form-control inptcoupancode" placeholder="Enter Licence Code Here">
                                <span class="error">

                                </span>
                                
                            </div>
                            <div class="form-group">
                                <input type="submit"  value="Submit" class="form-control submitcoupancode">
                            </div>
                        </form>
                    </div>
                </div>
                @endif


                <div class="tab-pane fade @if(array_key_first($payment_gateways) === 'paypal') show active @endif" id="gateway-paypal" role="tabpanel">
                    @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
                    <div class="tab-content">
                        <div class="my-3 p-3">
                            <div class="text-center">

                                <div id="paypal-button-container"></div>


                            </div>
                        </div>
                    </div>
                    
                    @endif
                </div>
            </div>

            @endif

        </div>
    </div>
</div>
</div>
</section>
<script src="{{PUBLIC_DIR}}/js/app.js?v=59"></script>
<script src="{{PUBLIC_DIR}}/lib/tinymce/tinymce.min.js?v=50"></script>

<script src="https://www.paypal.com/sdk/js?client-id={{$payment_gateways['paypal']->username}}"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.</script>
 @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: {{$amount}}
                    // value: 1
                    }
                }]
                });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            // window.location = '{{config('app.url')}}/billing';
                // var term = "{{$term}}";
                // var plan_id = "{{$plan->id}}"
            $.ajax({
                url: "{{ url('/payment-PayPal') }}",
                    method: 'post',
                    data: {
                        term: "{{$term}}",
                        plan_id: "{{$plan->id}}",
                    },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data)
                {
                    if(data.success=='1')
                    {
                        window.location = '{{config('app.url')}}/billing';
                    }
                }
            })

            // alert('Transaction completed by ' + details.payer.name.given_name);
            });
        }

    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
@endif
    <script>
        $("#usebarcode").on('click',function()
        {
            $('.Coupancode').toggle()
        })
        $(document).on('click','.submitcoupancode',function(e)
        {
           var coupancode = $(".inptcoupancode").val();
            e.preventDefault()
            $.ajax({
                url:"{{url('/payment-barcode')}}",
                method:'post',
                data: {
                    barcode:coupancode,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data)
                {
                    if(data.success == 0)
                    {
                        $(".error").append("<div class='alert alert-danger mt-3 error'>"+data.response+"</div>")
                    }
                    else{
                        window.location = '{{config('app.url')}}/billing';
                    }
                }
            });
        })
        jQuery(document).ready(function () {
            "use strict";

            @if(!empty($payment_gateways['stripe']) && !empty($payment_gateways['stripe']->public_key))
            // Dynamic JS for Stripe
            var stripe = Stripe('{{$payment_gateways['stripe']->public_key}}');


            var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

// Create an instance of the card Element.
            var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

// Handle real-time validation errors from the card Element.
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

// Handle form submission.
            var form = document.getElementById('payment-form');
            var $btnStripeSubmit = $('#btnStripeSubmit');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                $btnStripeSubmit.prop('disabled', true);
                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        $btnStripeSubmit.prop('disabled', false);
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);

                    }
                });
            });

// Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'token_id');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
            @endif

            // @if(!empty($payment_gateways['paypal']) && !empty($payment_gateways['paypal']->username && !empty($plan->paypal_plan_id)))
            // alert("djfg")
            // paypal.Buttons({
            //     createSubscription: function(data, actions) {
            //         return actions.subscription.create({
            //             'plan_id': '{{$plan->paypal_plan_id}}' // Creates the subscription
            //         });
            //     },
            //     onApprove: function(data, actions) {
            //         window.location = '{{config('app.url')}}/validate-paypal-subscription?subscription_id=' + data.subscriptionID;
            //     }
            // }).render('#paypal-button-container'); // Renders the PayPal button
            // @endif

        });
    </script>
</body>

</html>
