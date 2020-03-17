@extends('backend.master')
@section('title',"Reservation")
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom_page.css')}}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <h2>Create Reservation
                <a class="btn btn-tsk float-right" href="{{route('backend.admin.reservation')}}"><i class="fa fa-list"></i> Reservation List</a>

            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class=" mb-3">
                        <div class="form-row justify-content-center " v-show="next === 1">
                            <div class="form-group col-md-4">
                                <label><strong>Guest</strong> <small class="text-danger">*</small></label><a href="{{route('backend.admin.guests.create')}}" target="_blank" class="float-right"><i class="fa fa-plus"></i> add new</a>
                                <select id="guest" :class="['form-control form-control-lg',errors.has('guest')?'is-invalid':'']" @change="errors.clear('guest')" name="guest" v-model.number="form.guest">
                                    <option value="">Select</option>
                                    @foreach($guests as $guest)
                                        <option value="{{$guest->id}}">{{$guest->full_name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" v-if="errors.has('guest')">@{{ errors.get('guest') }}</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label><strong>Room</strong> <small class="text-danger">*</small></label>
                                <select id="room_type" :class="['form-control form-control-lg',errors.has('room_type')?'is-invalid':'']" @change="errors.clear('room_type')" name="room" v-model.number="form.room_type">
                                    <option value="">Select</option>
                                    @foreach($room_types as $room_type)
                                        <option value="{{$room_type->id}}">{{$room_type->title}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" v-if="errors.has('room_type')">@{{ errors.get('room_type') }}</div>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Adults</strong> </label>
                                <input type="number" v-model="form.adults" class="form-control form-control-lg">
                                <small v-if="!isEmpty(room_type_info)" class="form-text text-info">Max Capacity @{{room_type_info.higher_capacity}}/per room</small>
                                <div class="invalid-feedback" v-if="errors.has('adults')">@{{ errors.get('adults') }}</div>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Kids</strong> </label>
                                <input type="number" v-model="form.kids" class="form-control form-control-lg">
                                <small v-if="!isEmpty(room_type_info)" class="form-text text-info">Max Capacity @{{room_type_info.kids_capacity}}/per room</small>
                            </div>
                        </div>
                        <div class="form-row justify-content-center " v-show="next === 1">
                            <div class="form-group col-md-6">
                                <label><strong>Check in</strong> <small class="text-danger">*</small></label>
                                <input type="text" :class="['form-control form-control-lg',errors.has('check_in')?'is-invalid':'']" name="check_in" id="check_in" v-model.date="form.check_in" placeholder="YYYY/MM/DD">
                                <div class="text-danger" v-if="errors.has('check_in')">@{{ errors.get('check_in') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><strong>Check out</strong> <small class="text-danger">*</small></label>
                                <input type="text" :class="['form-control form-control-lg',errors.has('check_out')?'is-invalid':'']" name="check_out" id="check_out" v-model.date="form.check_out" placeholder="YYYY/MM/DD">
                                <div class="text-danger" v-if="errors.has('check_out')">@{{ errors.get('check_out') }}</div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-12">
                    <div class="form-row mb-4">
                        <div class="col-md">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h3>Rooms</h3>
                                </div>
                                <div class="card-body">
                                    <h3>@{{ form.number_of_room }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h3>Adults</h3>
                                </div>
                                <div class="card-body">
                                    <h3>@{{ form.adults }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h3>Kids</h3>
                                </div>
                                <div class="card-body">
                                    <h3>@{{ form.kids }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h3>Nights</h3>
                                </div>
                                <div class="card-body">
                                    <h3>@{{ form.total_night }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">

                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-body p-0 table-responsive">

                                    <table class="table table-sm  res-tbl mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Price Per Night</th>
                                            <td class="price-per-night p-0">
                                                <table class="table table-sm borderless mb-0 ">
                                                    <thead class="font-weight-bold">
                                                    <tr>
                                                        <td class="sl">#</td>
                                                        <td>Date</td>
                                                        <td>Available Room</td>
                                                        <td>Qty</td>
                                                        <td class="text-right">Price/Night</td>
                                                        <td class="text-right">Total Price</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(night_date,index ) in form.night_list">
                                                        <td class="sl">@{{ index+1 }}.</td>
                                                        <td class="text-muted">@{{ night_date.date }}</td>
                                                        <td>
                                                            <div class="" v-if="!isEmpty(night_date.room_option)">

                                                                <a :class="['btn', 'btn-sm', night_date.room.includes(room.id)?'btn-tsk':'btn-outline-secondary']" @click="toggalCheckNight(index,room.id)" v-for="(room,ind) in night_date.room_option">
                                                                    @{{ room.number }}
                                                                </a>
                                                            </div>
                                                            <div class="" v-else>not available</div>
                                                        </td>
                                                        <td :class="[night_date.room.length === form.number_of_room?'text-success':'text-danger']">@{{ night_date.room.length }}  / @{{ form.number_of_room }}</td>
                                                        <td class="text-right">@{{ night_date.price }} {{general_setting()->cur}}</td>
                                                        <td class="text-right">@{{ night_date.total_price }} {{general_setting()->cur}}</td>
                                                    </tr>
                                                    <tr class="font-weight-bold">
                                                        <td colspan="5">Total</td>
                                                        <td class="text-right "><span class="border-top">@{{ form.total_night_price }} {{general_setting()->cur}}</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Taxes</th>
                                            <td class="p-0">
                                                <table class="table table-sm borderless mb-0">

                                                    <tbody>
                                                    <tr v-for="(tax_item,index) in form.tax">
                                                        <td class="sl">@{{ index+1 }}.</td>
                                                        <td>@{{ tax_item.code }}</td>
                                                        <td>@{{ tax_item.rate }} @{{ tax_item.type==='PERCENTAGE'?'%':'Fixed' }}</td>
                                                        <td class="text-right">
                                                            <input type="hidden" v-model="tax_item.value = taxCalculate(tax_item)">

                                                            @{{ tax_item.value }} {{general_setting()->cur}}</td>
                                                    </tr>
                                                    <tr class="font-weight-bold">
                                                        <td colspan="3">Total TAX</td>
                                                        <td class="text-right ">

                                                <span class="border-top">
                                                     <input type="hidden" v-model="form.total_tax = totalTax">

                                                    @{{ form.total_tax }} {{general_setting()->cur}}</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr v-if="form.apply_coupon">
                                            <th>Apply Coupon</th>
                                            <td class="p-0">
                                                <table class="table table-sm borderless mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-muted">
                                                <span>
                                                    Your Applied coupon code :<strong>@{{ form.coupon.code }}</strong> .Discount details @{{ form.coupon.value }} <span v-if="form.coupon.type === 'PERCENTAGE'">% for total night price ( @{{ form.total_night_price }} {{general_setting()->cur}})</span> <span  v-if="form.coupon.type === 'FIXED'">{{general_setting()->cur}}</span>
                                                </span>
                                                        </td>
                                                        <td></td>
                                                        <td class="text-right font-weight-bold">

                                                            <input type="hidden" v-model="form.discount_coupon = calculateCoupon()">
                                                            @{{ form.discount_coupon }} {{general_setting()->cur}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <td class="text-right font-weight-bold">
                                                <input type="hidden" v-model="form.total_amount = this.form.total_night_price - this.form.discount_coupon + this.form.total_tax">
                                                @{{ form.total_amount }} {{general_setting()->cur}}
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="form-row justify-content-center"  v-show="next=== 2" v-if="!form.apply_coupon">
                                        <div class="form-group col-md-3">
                                            <div class="card p-2">
                                                <div class="input-group">
                                                    <input type="text" :class="['form-control',errors.has('coupon_code')?'is-invalid':'']" @keydown="errors.clear('coupon_code')" placeholder="Apply Coupon" v-model="form.coupon_code">
                                                    <div class="input-group-append">
                                                        <div class="input-group-btn">
                                                            <a class="btn btn-outline-tsk" v-if="form.coupon_code!==''" @click.prevent="applyCouponCode"> Check</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="text-danger" v-if="errors.has('coupon_code')">@{{ errors.get('coupon_code') }}</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-6 mt-2">
                            <button @click.prevent="resetForm" class="btn btn-outline-tsk float-left"><i class="fa fa-refresh"></i> Reset</button>
                            <div v-if="roomCompleteStatus()">
                                <button @click.prevent="letsNext" v-if="next === 1" class="btn btn-tsk float-right"><i class="fa fa-arrow-right"></i> Next</button>
                            </div>
                            <div v-else>
                                <button  class="btn btn-tsk float-right " disabled><i class="fa fa-arrow-right"></i> Next </button>
                            </div>
                            <button @click.prevent="createData" v-if="next === 2" :disabled="errors.any()" class="btn btn-tsk float-right"><i class="fa fa-save"></i> Reservation Confirm</button>
                            <button v-if="next === 2 && !form.apply_coupon" @click.prevent="next =1" class="btn btn-danger float-right mr-1"><i class="fa fa-arrow-left"></i> Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: {
                next:1,
                room_type_info:{},
                form:{
                    tax:[]
                },
                errors:new FormErrors()
            },
            watch:{
                'form.guest':function (val) {
                    let $this = this;
                    $this.form.guest_text =val===''?'': $("#guest option:selected").text();
                },
              'form.room_type':function (val) {

                  let $this = this;
                  $this.form.room_type_text =val===''?'': $("#room_type option:selected").text();
                  this.errors.clear('adults');
                  this.errors.clear('kids');
                  this.errors.clear('night_list');
                  this.form.night_list=[];
                  this.form.total_night_price=0;
                  this.form.kids = 0;
                  this.form.adults = 0;
                  this.form.check_in = '';
                  this.form.check_out = '';
                  this.disableDates =[];
                    axios.get('{{route('backend.admin.reservation.get_room_type_details')}}',{
                        params:{
                            room_type:val
                        }
                    }).then(res=>{
                        let data = {};
                        if(res.data.status === 'ok'){
                            data = res.data.room_type;
                            this.disableDates = res.data.booking_date;
                            var datepicker = $('#check_in');
                            datepicker.datepicker().destroy();
                            datepicker.datepicker(this.setCheckInConfig(res.data.booking_date));
                            console.log(res.data.booking_date);
                            this.form.adults = 1;
                        }else if(res.data.status === 'error'){
                            data = {};
                        }
                        $this.room_type_info = data;
                        // console.log( this.room_type_info);
                    })
              },
                'form.adults':function (val,old_val) {
                    if(!this.isEmpty(this.room_type_info)){
                        this.roomCalculate();
                    }

                },
                'form.kids':function (val,old_val) {
                    if(!this.isEmpty(this.room_type_info)){
                        this.roomCalculate();
                    }
                },
                'form.number_of_room':function (val,old_val) {
                    var $this = this;
                    var total_price = 0;
                    this.form.night_list.forEach(function (item, index) {
                        $this.setRoomIndex(index);

                        total_price =total_price + $this.form.night_list[index]['total_price'];
                    });
                    this.form.total_night_price = total_price;
                }
            },
            computed: {
                totalTax() {
                    return this.form.tax.reduce((total, item) => {
                        return total + Number(item.value);
                    }, 0);
                },

            },
            mounted:function(){
                var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                var $this = this;
                $this.resetForm();
                $('#check_in').datepicker(this.setCheckInConfig([]));
               $('#check_out').datepicker(this.setCheckOutConfig([]));
            },
            methods:{

                letsNext(){
                    let error_msg = {};
                    if(this.form.guest === ''){
                        error_msg.guest = ['Guest is required'];
                    }
                    if(this.form.room_type === ''){
                        error_msg.room_type = ['Room type is required'];
                    }
                    if(this.form.adults === ''){
                        error_msg.adults = ['Adults type is required'];
                    }
                    if(this.form.check_in === ''){
                        error_msg.check_in = ['Check in type is required'];
                    }
                    if(this.form.check_out === ''){
                        error_msg.check_out = ['Check out type is required'];
                    }

                    if(this.isEmpty(error_msg)){
                      this.next =2;
                    }else{
                        this.errors.record(error_msg);
                    }
                },
                setCheckInConfig:function(disableDates){
                    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                    var $this =this;
                    return {
                        uiLibrary: 'bootstrap4',
                            format: 'yyyy/mm/dd',
                        iconsLibrary: 'fontawesome',
                         modal: true,
                        minDate: today,
                        disableDates:  disableDates,
                        change:function (el) {
                            $this.errors.clear('check_in');
                            $this.errors.clear('check_out');
                            $this.errors.clear('night_list');
                            var max_checkout_date = '';
                            let check_in = this.value;
                            if( $this.form.room_type === ''){
                                toastr.error('Must select room type');
                                check_in ='';
                                $('#check_in').val('');
                                $('#check_out').val('');
                            }else{
                                axios.get('{{route('backend.admin.reservation.get_checkout_available_date')}}',{
                                    params: {
                                        check_in_date:$('#check_in').val(),
                                        room_type:$this.form.room_type
                                    }
                                }).then(res=>{
                                    console.log(res.data);
                                    max_checkout_date = res.data.max_date;

                                    var datepicker = $('#check_out');
                                    datepicker.datepicker().destroy();
                                    datepicker.datepicker($this.setCheckOutConfig(res.data.max_date));
                                });

                            }
                            $this.form.check_in =check_in ;
                        }
                    }
                },
                setRoomIndex:function(index){
                    var room = [];
                    var option =this.form.night_list[index]['room_option'];
                    option.slice(0,this.form.number_of_room).forEach(function (it,ind) {
                        room.push(it.id);
                    });
                    this.form.night_list[index]['room'] = room;
                    this.form.night_list[index]['room_qty'] = room.length;
                    this.form.night_list[index]['total_price'] = this.form.night_list[index]['price']*this.form.night_list[index]['room_qty'];
                },
                roomCompleteStatus:function(){
                    let status = true;
                    let $this = this;
                    if(!this.isEmpty(this.form.night_list)) {
                        this.form.night_list.forEach(function (it, ind) {
                            if (it.room.length !== $this.form.number_of_room) {
                                status = false;
                            }
                        });
                    }
                    return status;
                },
                toggalCheckNight:function(index,id){
                    var r = this.form.night_list[index]['room'].indexOf(id);
                    if (r !== -1) {
                        this.form.night_list[index]['room'].splice(r, 1);
                    }else{
                        this.form.night_list[index]['room'].push(id)
                    }
                    var room = this.form.night_list[index]['room'];
                    this.form.night_list[index]['room_qty'] = room.length;
                    this.form.night_list[index]['total_price'] = this.form.night_list[index]['price']*room.length;
                },
                setCheckOutConfig:function(max_date){
                    var $this =this;
                    return {
                        uiLibrary: 'bootstrap4',
                        format: 'yyyy/mm/dd',
                        iconsLibrary: 'fontawesome', modal: true,
                        theme:'green',
                        minDate: function () {
                            return $('#check_in').val();
                        },
                        maxDate: max_date,
                        change:function (el) {
                            $this.errors.clear('check_in');
                            $this.errors.clear('check_out');
                            $this.errors.clear('night_list');
                            let check_out = this.value;
                            if( $this.form.check_in === ''){
                                toastr.error('Must select check in');
                                check_out ='';
                                $('#check_out').val('')
                            }
                            if(check_out !== ''){
                                axios.get('{{route('backend.admin.reservation.get_night_calculation')}}',{
                                    params: {
                                        check_in:$this.form.check_in,
                                        check_out:$('#check_out').val(),
                                        room_type:$this.form.room_type,
                                        number_of_room:$this.form.number_of_room
                                    }
                                }).then(res=>{
                                    $this.form.night_list = res.data.data.night_list;
                                    $this.form.total_night = res.data.data.total_night;
                                    $this.form.total_night_price = Number(res.data.data.total_price);

                                })
                            }
                            $this.form.check_out =check_out ;
                        }
                    }
                },
                createData:function (e) {
                    axios.post('{{route('backend.admin.reservation.store')}}',this.form).then(res => {
                        if(res.data.status === 'ok'){
                            this.resetForm();
                            toastr.success(res.data.message);
                            location.replace(res.data.url);
                        }else{
                            toastr.error(res.data.message);
                        }
                    }).catch(error=>{
                        this.errors.record(error.response.data.errors);
                    });
                },
                taxCalculate:function(tax){

                    if(tax.type === 'PERCENTAGE'){
                        let total_amount = this.form.total_night_price;
                        return total_amount?(total_amount*tax.rate)/100:0;
                    }else if(tax.type === 'FIXED'){
                        return  tax.rate;
                    }
                    return 0;
                },
                calculateCoupon:function(){
                    if(this.form.apply_coupon){
                        if(this.form.coupon.type === 'PERCENTAGE'){
                            let total_amount = this.form.total_night_price;
                          return (total_amount*this.form.coupon.value)/100;
                        }else if(this.form.coupon.type === 'FIXED'){
                            return  this.form.coupon.value;
                        }
                    }
                    return 0;
                },
                applyCouponCode:function(){

                    axios.get('{{route('backend.admin.reservation.apply_coupon')}}',{
                        params:{
                            coupon_code:this.form.coupon_code,
                            guest:this.form.guest,
                            amount:this.form.total_night_price
                        }
                    }).then(res => {
                        if(res.data.status === 'ok'){
                           this.form.apply_coupon = true;
                           this.form.coupon = res.data.data;
                            this.errors.clear();
                            toastr.success(res.data.message);
                        }else{
                            this.errors.clear();
                            toastr.error(res.data.message);
                        }

                    }).catch(error=>{
                        this.errors.record(error.response.data.errors);
                    });
                },
                roomCalculate:function(){
                    var adults_room =Math.ceil( this.form.adults/this.room_type_info.higher_capacity);
                    adults_room = adults_room>0?adults_room:1;
                    var kids_room =Math.ceil( this.form.kids/this.room_type_info.kids_capacity);
                    kids_room = kids_room>0?kids_room:1;
                    if(adults_room > kids_room){
                        this.form.number_of_room = adults_room;
                    }else{
                        this.form.number_of_room = kids_room;
                    }
                },
                totalAmount:function () {
                    return this.form.total;
                },
                resetForm:function () {
                    this.next=1;
                    this.room_type_info={};
                    this.form = {
                        number_of_room:0,
                        guest:'',
                        guest_text:'',
                        room_type:'',
                        room_type_text:'',
                        kids:0,
                        adults:0,
                        check_in:'',
                        check_out:'',
                        night_list:[],
                        total_night:0,
                        total_night_price:0,
                        total_amount:this.totalAmount(),
                        total_tax:0,
                        discount_coupon:0,
                        tax:@php echo $tax->toJson() ; @endphp,
                        apply_coupon:false,
                        coupon:{},
                        coupon_code:''
                    };
                    this.errors.clear();
                },
                isEmpty(obj) {
                    return Object.keys(obj).length === 0;
                }
            }
        });
    </script>
@endsection
