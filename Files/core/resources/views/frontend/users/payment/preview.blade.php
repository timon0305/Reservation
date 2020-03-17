@extends('frontend.master')
@section('title','Payment Preview')
@section('content')
    <!-- error begin-->
    @include('frontend.partials.breadcrumb',['title'=>$pt,'item'=>[$pt=>null]])
    <section class="account-area section-padding">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-8">
                    <div class="single-sidebar-block p-4">
                        <form method="POST" action="{{ route('payment.confirm') }}">
                            @csrf
                           <div class="row">
                               <div class="col-md-6">
                                   <img src="{{asset('assets/backend/image/gateway')}}/{{$data->gateway_id}}.jpg" style="max-width:200px; margin:0 auto;"/>
                               </div>
                               <div class="col-md-6">
                                   <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>
                                   <ul class="list-group border-radius-0">
                                       <li class="list-group-item border-radius-0">Amount: <span class="float-right">{{general_setting()->cur_sym}} {{$data->amount}} </span></li>
                                       <li class="list-group-item border-radius-0">Total Payable: <span class="float-right">$ {{$data->usd_amo}}</span></li>
                                       <li class="list-group-item border-radius-0">Payment Gateway: <span class="float-right">{{$data->gateway->name}}</span></li>
                                   </ul>
                               </div>
                              <div class="col-md-12 text-right">
                                  <button type="submit" class="bttn btn-fill" id="btn-confirm">
                                      Pay Now
                                  </button>
                              </div>
                           </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/Account Area-->

@endsection
@section('script')
@if($data->gateway_id == 107)
<form action="{{ route('ipn.paystack') }}" method="POST">
    @csrf
    <script
    src="//js.paystack.co/v1/inline.js"
    data-key="{{ $data->gateway->val1 }}"
    data-email="{{ $data->user->email }}"
    data-amount="{{ round($data->usd_amo/$data->gateway->val7, 2)*100 }}"
    data-currency="NGN"
    data-ref="{{ $data->trx }}"
    data-custom-button="btn-confirm"
    >
    </script>
</form>
@elseif($data->gateway_id == 108)
<script src="//voguepay.com/js/voguepay.js"></script>
<script>
    closedFunction = function() {
        
    }
    successFunction = function(transaction_id) {
        window.location.href = '{{ url('home/vogue') }}/' + transaction_id + '/success';
    }
    failedFunction=function(transaction_id) {
        window.location.href = '{{ url('home/vogue') }}/' + transaction_id + '/error';
    }

    function pay(item, price) {
        //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: "{{ $data->gateway->val1 }}",
            total: price,
            notify_url: "{{ route('ipn.voguepay') }}",
            cur: 'USD',
            merchant_ref: "{{ $data->trx }}",
            memo:'Deposit',
            recurrent: true,
            frequency: 10,
            developer_code: '5af93ca2913fd',
            store_id:"{{ $data->user_id }}",
            custom: "{{ $data->trx }}",
            
            closed:closedFunction,
            success:successFunction,
            failed:failedFunction
        });
    }
    
    $(document).ready(function () {
        $(document).on('click', '#btn-confirm', function (e) {
            e.preventDefault();
            pay('Deposit', {{ $data->usd_amo }});
        });
    })
</script>

@endif
@endsection
