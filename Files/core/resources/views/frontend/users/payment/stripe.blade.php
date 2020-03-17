@extends('frontend.master')
@section('title',$pt)
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>$pt,'item'=>[$pt=>null]])
    <section class="room-details-area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="single-sidebar-block p-4">
                        <div class="card-wrapper"></div>
                        <form role="form" id="payment-form" method="POST" class="contact-form" action="{{ $ipn}}" >
                            @csrf
                            <input type="hidden" value="{{ $track }}" name="track">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name">CARD NAME</label>
                                    <div class="input-group input-group-lg ">
                                        <input
                                                type="text"
                                                class="form-control border-radius-0"
                                                name="name"
                                                placeholder="Card Name"
                                                autocomplete="off" autofocus
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent border-radius-0"><i class="fa fa-font"></i></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group input-group-lg">
                                        <input
                                                type="tel"
                                                class="form-control border-radius-0"
                                                name="cardNumber"
                                                placeholder="Valid Card Number"
                                                autocomplete="off"
                                                required autofocus
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent border-radius-0"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-7 col-md-7">
                                    <label for="cardExpiry">EXPIRATION DATE</label>
                                    <input
                                            type="tel"
                                            class="form-control border-radius-0  form-control-lg"
                                            name="cardExpiry"
                                            placeholder="MM / YYYY"
                                            autocomplete="off"
                                            required
                                    />
                                </div>
                                <div class="col-xs-5 col-md-5">
                                    <label for="cardCVC">CVC CODE</label>
                                    <input
                                            type="tel"
                                            class="form-control form-control-lg border-radius-0"
                                            name="cardCVC"
                                            placeholder="CVC"
                                            autocomplete="off"
                                            required
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button class="bttn btn-fill btn-block" id="payment-form-btn" type="submit" > PAY NOW </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/card.min.js"></script>
<script>
	(function ($) {
		$(document).ready(function () {
			var card = new Card({
				form: '#payment-form',
				container: '.card-wrapper',
				formSelectors: {
					numberInput: 'input[name="cardNumber"]',
					expiryInput: 'input[name="cardExpiry"]',
					cvcInput: 'input[name="cardCVC"]',
					nameInput: 'input[name="name"]'
				}
			});
		});
	})(jQuery);
</script>
@endsection


