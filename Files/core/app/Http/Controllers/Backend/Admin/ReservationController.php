<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\AppliedCouponCode;
use App\Model\CouponMaster;
use App\Model\Gateway;
use App\Model\PaidService;
use App\Model\Payment;
use App\Model\Reservation;
use App\Model\ReservationNight;
use App\Model\ReservationPaidService;
use App\Model\ReservationTax;
use App\Model\Room;
use App\Model\RoomType;
use App\Model\TaxManager;
use App\Model\Transaction;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * @var Resarvation
     */
    private $resarvation;
    /**
     * @var User
     */
    private $guests;
    /**
     * @var RoomType
     */
    private $roomType;
    /**
     * @var TaxManager
     */
    private $taxManager;
    /**
     * @var CouponMaster
     */
    private $couponMaster;
    /**
     * @var Reservation
     */
    private $reservation;
    /**
     * @var ReservationNight
     */
    private $night;
    /**
     * @var ReservationTax
     */
    private $reservationTax;
    /**
     * @var ReservationPaidService
     */
    private $res_paid_service;
    /**
     * @var AppliedCouponCode
     */
    private $appliedCouponCode;
    /**
     * @var Gateway
     */
    private $gateway;
    /**
     * @var Payment
     */
    private $payment;
    /**
     * @var PaidService
     */
    private $paidService;

    public function __construct(
                                User $guests,
                                RoomType $roomType,
                                TaxManager $taxManager,
                                CouponMaster $couponMaster,
                                Reservation $reservation,
                                ReservationNight $night,
                                ReservationTax $reservationTax,
                                ReservationPaidService $res_paid_service,
                                AppliedCouponCode $appliedCouponCode,
                                Gateway $gateway,
                                Payment $payment,PaidService $paidService)
    {
        $this->guests = $guests;
        $this->roomType = $roomType;
        $this->taxManager = $taxManager;
        $this->couponMaster = $couponMaster;
        $this->reservation = $reservation;
        $this->night = $night;
        $this->reservationTax = $reservationTax;
        $this->res_paid_service = $res_paid_service;
        $this->appliedCouponCode = $appliedCouponCode;
        $this->gateway = $gateway;
        $this->payment = $payment;
        $this->paidService = $paidService;
    }
    public function index($booking_type = null){
        $reservations = $this->reservation;
        if(null !== $booking_type){
            if(!in_array($booking_type,['online','offline']))
                abort(404);
            $reservations=$reservations->where('online',$booking_type=== 'online'?1:0);
        }

        $reservations=$reservations->latest()->paginate(20);

        return view('backend.admin.reservation.index',compact('reservations'));
    }

    public function create(){

        $booking_night = [];
        foreach ($this->availableRoom(1) as $key=>$value){
            if(!$value['available_room']->count()){
                $booking_night[] = $key;
            }
        }
        $tax = $this->taxManager->whereStatus(1)->get()->map(function ($item, $key) {
            $item['value'] =0;
            return $item;
        });
        $guests = $this->guests->where('status',1)->get();
        $room_types = $this->roomType->whereStatus(1)->get();
        return view('backend.admin.reservation.create',compact('guests','room_types','tax'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'guest'=>'required|integer',
            'room_type'=>'required|integer',
            'adults'=>'required|integer|min:1',
            'kids'=>'required|integer|min:0',
            'check_in'=>'required|date|after_or_equal:toady',
            'check_out'=>'required|date|after_or_equal:check_in',
            'night_list'=>'required',
            'number_of_room'=>'required'
        ]);
        DB::beginTransaction();
        $i =0;
        try{
            $reservation = new $this->reservation;
            $reservation->uid = rand(1111,9999).'-'.time();
            $reservation->user_id = $request->guest;
            $reservation->room_type_id = $request->room_type;
            $reservation->adults = $request->adults;
            $reservation->kids = $request->kids;
            $reservation->check_in = $request->check_in;
            $reservation->check_out = $request->check_out;
            $reservation->number_of_room = $request->number_of_room;
            $reservation->status = 'SUCCESS';
            $reservation->save();

            foreach ($request->night_list as $v){
                foreach ($v['room'] as $r){
                    $night = new $this->night;
                    $night->reservation_id = $reservation->id;
                    $night->date = $v['date'];
                    $night->check_in = Carbon::parse($v['check_in']['date']);
                    $night->check_out = Carbon::parse($v['check_out']['date']);
                    $night->price = $v['price'];
                    $night->room_id = $r;
                    $night->save();
                }

            }

            foreach ($request->tax as $v){
                $tax = new $this->reservationTax;
                $tax->reservation_id = $reservation->id;
                $tax->tax_id = $v['id'];
                $tax->type = $v['type'];
                $tax->value = $v['rate'];
                $tax->price = $v['value'];
                $tax->save();
            }
            if($request->apply_coupon){
                $appliedCouponCode = new $this->appliedCouponCode;
                $appliedCouponCode->reservation_id = $reservation->id;
                $appliedCouponCode->coupon_id = $request->coupon['id'];
                $appliedCouponCode->user_id = $request->guest;
                $appliedCouponCode->date = Carbon::now();
                $appliedCouponCode->coupon_type = $request->coupon['type'];
                $appliedCouponCode->coupon_rate =  $request->coupon['value'];
                $appliedCouponCode->save();
            }
            $status = true;
            DB::commit();
        }catch (\Exception $e){
            $status = false;
            DB::rollback();
        }
        if($status){
            return response()->json([
                'status'=>'ok',
                'message'=>'Reservation success',
                'url'=>route('backend.admin.reservation.view',$reservation->id)
            ]);
        }
        return response()->json([
            'status'=>'error',
            'message'=>$e->getMessage()
        ]);
    }
    public function view($id){
        $reservation = $this->reservation->findOrFail($id);
        $paid_services = $this->paidService->whereStatus(1)->get();
        $gateways = $this->gateway->whereStatus(1)->where('is_offline',1)->get();
        return view('backend.admin.reservation.view',compact('reservation','gateways','paid_services'));
    }
    public function confirm($id){
        $reservation = $this->reservation->findOrFail($id);
        $night =  $reservation->night->groupBy('date');
        $room_type = RoomType::findOrFail($reservation->room_type_id);
        $night_data = [];
        foreach ($night as $key=>$ngt){
            $night_data[$key] = [];
            foreach ($room_type->room as $rm){
                $isbooked =  ReservationNight::where('room_id',$rm->id)
                    ->whereNotNull('room_id')
                    ->whereHas('reservation',function ($q){
                        $q->whereIn('status',['SUCCESS','PENDING']);
                    })
                    ->where('date',$key)->count();
                if($isbooked==0){
                    $night_data[$key][]=$rm;
                }
            }

        }
        return view('backend.admin.reservation.confirm',compact('reservation','night_data'));
    }
    public function confirmPost(Request $request,$id){
        if(!$request->room){
            return back()->with('error','Room Shortage');
        }
        $reservation = $this->reservation->findOrFail($id);
        $night =  $reservation->night->groupBy('date');
        if($reservation->night->where('room_id',null)->count()){
            foreach ($night as $key=>$ngt){
                if(!array_key_exists($key,$request->room)){
                    return back()->with('error','Properly select room');
                }
                if(count($request->room[$key]) < $reservation->number_of_room){
                    return back()->with('error','Room Shortage');
                }
            }
            foreach ($request->room as $key=>$rn){
                foreach ($rn as $v){
                    if($upd_n = $reservation->night->where('room_id',null)->where('date',$key)->first()){
                        $upd_n->room_id = $v;
                        $upd_n->save();
                    }
                }

            }
        }

        $reservation->status = 'SUCCESS';
        $reservation->save();
        return redirect()->route('backend.admin.reservation.view',$id)->with('success','Room Shortage');
    }
    public function changeStatus ($id,$status){
        $reservation = $this->reservation->findOrFail($id);
        if(!in_array($status,['pending','success','cancel']))
            abort(401);
        $reservation->status = strtoupper($status);
        $reservation->save();
        return back()->with('success','Status change Successful');
    }
    public function payment(Request $request,$id){
       $this->validate($request,[
          'payment_method'=>'required',
          'amount'=>'required|numeric|min:1'
       ]);
       $reservation = $this->reservation->findOrFail($id);
        $payment = new $this->payment;
        $payment->gateway_id = $request->payment_method;
        $payment->user_id = $reservation->user_id;
        $payment->reservetion_id = $id;
        $payment->amount = $request->amount;
        $payment->trx = time().'-'.rand(1111,9999);
        $payment->status =1;
        $payment->type ='offline';
        $payment->save();
        $tran = new Transaction();
        $tran->user_id = $reservation->user_id;
        $tran->gateway_id = $request->payment_method;
        $tran->amount = $request->amount;
        $tran->remarks = 'Payment for room reservation';
        $tran->trx = $payment->trx;
        $tran->save();
        return back()->with('success','Payment Successful');
    }
    public function addService(Request $request,$id){
       $this->validate($request,[
          'service'=>'required|integer',
          'qty'=>'required|integer|min:1'
       ]);
       $reservation = $this->reservation->findOrFail($id);
       $paid_service = $this->paidService->findOrFail($request->service);
        $service = new $this->res_paid_service;
        $service->date =Carbon::now();
        $service->reservation_id =$reservation->id;
        $service->pad_service_id = $request->service;
        $service->value = $paid_service->price;
        $service->qty = $request->qty;
        $service->price = $paid_service->price*$request->qty;
        $service->save();
        return back()->with('success','Service added Successful');
    }
    public function removeService($id){
        $reservation = $this->res_paid_service->findOrFail($id)->delete();
        return back()->with('success','Service remove Successful');
    }
    public function cancelRoom($id){
        $reservation = $this->night->findOrFail($id)->delete();
        return back()->with('success','Room cancel Successful');
    }
    public function getRoomTypeDetails(Request $request){
        $paid_service = [];
        if($room_type = $this->roomType
            ->where('id',$request->room_type)->first()){
            $booking_night = [];
            foreach ($this->availableRoom($request->room_type) as $key=>$value){
                if(!$value['available_room']->count()){
                    $booking_night[] = $key;
                }
            }
            return response()->json([
                'status'=>'ok',
                'message'=>'success',
                'room_type'=>$room_type,
                'booking_date'=>$booking_night
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'error',
                'room_type'=>[],
                'paid_service'=>$paid_service
            ]);
        }



    }

    public function getNightCalculation(Request $request){
        $data =[];
        $night_calculation = $this->nightCalculation([$request->check_in,$request->check_out],[general_setting()->check_in_time,general_setting()->check_out_time]);
        $total_price =0;
        $room_type = $this->roomType->findOrFail($request->room_type);
        $number_of_room = $request->number_of_room;
        foreach ($night_calculation as $k=>$v){

            $booking_night = $this->availableRoom($request->room_type,$request->check_in);
            $room_option = $room_type->room;
            if(array_key_exists($k,$booking_night)){
                $room_option = $booking_night[$k]['available_room'];
            }
            $price = $this->getPrice($k,$room_type);

            $selected_room = [];
            $r = 0;
            foreach ($room_option as $va){
                $r++;
                $selected_room[] = $va->id;
                if($number_of_room == $r){
                    break;
                }
            }
            $total_price +=$price*$r;
            $data[] = [
                'date'=>$k,
                'check_in'=>$v['start'],
                'check_out'=>$v['end'],
                'price'=>$price,
                'room_option'=>$room_option,
                'room'=>$selected_room,
                'room_qty'=>$r,
                'total_price'=>$total_price
            ];

        }

        $total_night =count($night_calculation);


        return response()->json([
           'status'=>'ok',
           'message'=> $night_calculation,
            'data'=>[
                'night_list'=>$data,
                'total_night'=>$total_night,
                'total_price'=>$total_price,
            ]
        ]);
    }
    public function getCheckOutAvailableDate(Request $request){
        $date = '';
        foreach ($this->availableRoom($request->room_type,$request->check_in_date) as $key=>$value){
            if(!$value['available_room']->count()){
                $date =Carbon::parse($key)->subDay()->format('Y/m/d') ;
                break;
            }
        }
        return response()->json([
            'status'=>'ok',
            'message'=>'success',
            'check_in_date'=>$request->room_type,
            'max_date'=>$date,
        ]);
    }
    public function applyCoupon(Request $request){
        $this->validate($request,[
            'coupon_code'=>'required',
            'guest'=>'required|integer'
        ]);
        $response = [];
        if($coupon = $this->couponMaster->where('code',$request->coupon_code)->first()){
            if(!$coupon->hasCoupon($request->guest,$request->amount)){
                throw ValidationException::withMessages([
                    'coupon_code' => [$coupon->getMessage($request->guest,$request->amount)]
                ]);
            }else{
                $response['status']='ok';
                $response['message']='Coupon apply success';
                $response['data']=$coupon;
            }
        }else{
            throw ValidationException::withMessages([
                'coupon_code' => ['Code is invalid']
            ]);
        }
        return response()->json($response);
    }
    /**
     * Trait create
     */
    public function availableRoom(int $room_type,$afterDate = null){
        $booking_night = $this->night
            ->whereHas('reservation',function($q) use($afterDate,$room_type) {
                $q->where('room_type_id',$room_type)->whereNotIn('status',['CANCEL','ONLINE_PENDING']);
            })
            ->where('date','>=',$afterDate!==null?$afterDate:date('Y/m/d'))->orderBy('date')->get()->groupBy('date');
        $date =[];
        foreach ($booking_night as $key=>$night){
            $night_booking = $night->pluck('room_id')->toArray();
            $date[date('Y/m/d',strtotime($key))] = [
                'reservation'=>$night,
                'booking_room'=>Room::find($night_booking),
                'available_room'=>Room::where('room_type_id',$room_type)->whereNotIn('id', $night_booking)->get()
            ];
        }
        return $date;
    }
    protected function nightCalculation(array $night_range,array $range_setup){

        $result = [];
        $date_range = $this->date_range($night_range[0],$night_range[1]);
        foreach ($date_range as $k=>$v){
            $s = Carbon::parse($v.' '.$range_setup[0]);
            $e = Carbon::parse($v.' '.$range_setup[0])->addHours(24)->format('Y/m/d');
            $result[$v]  = [
                'start'=>$s,
                'end'=>Carbon::parse($e.' '.$range_setup[1])
            ];
        }
        return $result;
    }
   protected function date_range($first, $last, $step = '+1 day', $output_format = 'Y/m/d' ) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
    protected function getPrice($date,RoomType $room_type){
        $day = Carbon::parse($date)->dayOfWeek+1;
        return $room_type->getDayByCurrentPrice($day);
    }

}
