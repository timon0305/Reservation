<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Helper\PaymentMaster;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\AppliedCouponCode;
use App\Model\BlogCategory;
use App\Model\BlogPost;
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
use App\Model\WebSetting\WebFaq;
use App\Model\WebSetting\WebOurTeam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use DB;
class HomeController extends Controller
{
use SendEmail,PaymentMaster,SendSms;
    public function error(){
        return view('frontend.error');
    }
    public function index(){
        $dd =$this->getRoomByDate(1,Carbon::parse('2019/04/24')->format('Y/m/d'),Carbon::parse('2019/04/27')->subDay()->format('Y/m/d'));

        $search = [
            'arrival'=>'',
            'departure'=>'',
            'adults'=>'',
            'children'=>'',
        ];
        $room_types = RoomType::whereStatus(1)->inRandomOrder()->take(3)->get();
        $services = PaidService::whereStatus(1)->inRandomOrder()->get();
        session()->forget('reservation');
        $section['our_latest_blog'] = BlogPost::whereStatus(1)->latest()->take(9)->get();
        return view('frontend.home',compact('room_types','search','section','services'));
    }
    public function roomList (Request $request){
        $search = [
            'arrival'=>'',
            'departure'=>'',
            'adults'=>'',
            'children'=>'',
        ];
        $room_types = RoomType::whereStatus(1);
            if($request->search){
                $this->validate($request,[
                    'search.arrival'=>'required|date',
                    'search.departure'=>'required|date',
                    'search.adults'=>'required|integer',
                    'search.children'=>'nullable|integer',
                ],[
                    'search.arrival.required'=>'Arrival is required',
                    'search.arrival.date'=>'Arrival must be date',
                    'search.departure.required'=>'Departure is required',
                    'search.departure.date'=>'Departure must be date',
                    'search.adults.required'=>'Adults is required',
                    'search.adults.integer'=>'Adults must be integer',
                    'search.children.integer'=>'Children must be integer',
                ]);
                $room_types=  $room_types->get();

                $arr=[];
                foreach ($room_types as $room_v){
                    if($result = $this->getRoomByDate($room_v->id,Carbon::parse($request->search['arrival'])->format('Y/m/d'),Carbon::parse($request->search['departure'])->subDay()->format('Y/m/d'))){
                        $arr[] = $room_v->id;
                    }
                }
                $room_types = RoomType::whereIn('id',$arr);
                $search = [
                    'arrival'=>$request->search['arrival'],
                    'departure'=>$request->search['departure'],
                    'adults'=>$request->search['adults'],
                    'children'=>$request->search['children'],
                ];
            }

            $room_types=$room_types->paginate(9);
        session()->forget('reservation');
        return view('frontend.room_list',compact('room_types','search'));
    }
    public function calculateNoOfRoom(){

    }
    public function roomDetails ($id){
        $room_type = RoomType::findOrFail($id);
        $search = [
            'arrival'=>\request()->arrival,
            'departure'=>\request()->departure,
            'adults'=>\request()->adults,
            'children'=>\request()->children,
        ];
        if(!$room_type->status)
        return view('frontend.error');
        $reletade_rooms = RoomType::whereStatus(1)->latest()->take(3)->get();
        return view('frontend.room_details',compact('room_type','search','reletade_rooms'));
    }

    public function blog(BlogPost $postModel,BlogCategory $category,$cat_id=null){
        $cat = null;
        $posts = $postModel->whereStatus(1);
            if($cat_id !== null){
                $cat=$category->findOrFail($cat_id);
                $posts=$posts->where('cat_id',$cat_id);
            }
        $posts=$posts->latest()->paginate(9);
        return view('frontend.blog',compact('posts','cat'));
    }

    public function blogDetails(BlogPost $postModel,BlogCategory $category,$id,$slug){
        $post = $postModel->findOrFail($id);
        $post->increment('hit');
        $categories = $category->withCount('post')->whereStatus(1)->orderBy('name','ASC')->take(10)->get();
        $most_view_post = $postModel->whereNotIn('id',[$id])->orderBy('hit','DSC')->take(6)->get();
        return view('frontend.blog_details',compact('post','categories','most_view_post'));
    }

    public function about(){
        $our_teams = WebOurTeam::get();
        $section['our_latest_blog'] = BlogPost::whereStatus(1)->latest()->take(9)->get();
        return view('frontend.about',compact('our_teams','section'));
    }

    public function gallery(){
        return view('frontend.gallery');
    }

    public function faq(){
        $faqs = WebFaq::get();
        return view('frontend.faq',compact('faqs'));
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function contactSubmit(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
        ]);
        $this->sendEmail($request->email,$request->subject,$request->subject,$request->message);
        return redirect()->back()->with('success','Submit Successful');
    }
















    public function reservationSuccess(){
            if(!session()->has('reservation_confirm')){
                return view('frontend.error');
            }
             $reservation = Reservation::findOrFail(session()->get('reservation_confirm'));
        return view('frontend.reservation_confirmation',compact('reservation'));
    }



    public function booking(Request $request,$id){

            $this->validate($request,[
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required',
                'adult'=>'required|integer',
                'children'=>'nullable|integer',
                'arrival'=>'required|date',
                'departure'=>'required|date',
            ]);
        $room_type = RoomType::findOrFail($id);
        $required_room = $this->roomCalculate($id,$request->adult,$request->children);
        $err = 0;
        $night =$this->nightCalculation([$request->arrival,Carbon::parse($request->departure)->subDay()->format('Y/m/d')],[general_setting()->check_in_time,general_setting()->check_out_time]);
        foreach ($night as $key=>$ngt){
        $avl = 0;
            foreach ($room_type->room as $rm){
              $isbooked =  ReservationNight::where('room_id',$rm->id)->where('date',$key)
                  ->whereHas('reservation',function ($q) {
                      $q->whereNotIn('status',['CANCEL','ONLINE_PENDING']);
                  })
                  ->count();
              if($isbooked==0){
                  $avl++;
              }
            }
            if($avl<$required_room){
                $err++;
                break;
            }

         }
        if($err){
            return back()->with('error','Not available room for your selected booking duration.');
        }

        $sub_total=0;
        $payable_amount =0;
       $night_list = $this->getNightCalculation($room_type,$night,$required_room);
        $sub_total += $night_list['total_price'];
        $payable_amount = $sub_total;
        $tex_list = TaxManager::whereStatus(1)->get();
       if($tex_list->count()){
           $tex_list->map(function ($item,$key) use($request,$sub_total){
               $cal_price = 0;
               switch ($item->type){
                   case 'PERCENTAGE':
                       $cal_price = $item->rate * $sub_total/100;
                       break;
                   case 'FIXED':
                       $cal_price = $item->rate;
                       break;
               }
               $item['cal_price']=$cal_price;
               return $item;
           });
           $payable_amount += $tex_list->sum('cal_price');
       }else{
           $tex_list =null;
       }
      $reservation_data = collect([
            'room_type'=>$id,
            'user'=>null,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'adult'=>$request->adult,
            'children'=>$request->children,
            'arrival'=>$request->arrival,
            'departure'=>$request->departure,
            'rooms_per_night'=>$required_room,
            'gateway'=>null,
            'night_list'=>$night_list,
            'tax_list'=>$tex_list,
            'payable_amount'=>$payable_amount,
            'sub_total'=>$sub_total,
            'coupon'=>null
        ]);
        session()->put('reservation',$reservation_data);
        return redirect()->route('checkout');

    }
    public function getNightCalculation($room_type,$night_calculation,$requir_room = 1){
        $data =[];
       $total_price =0;
        foreach ($night_calculation as $k=>$v){
            $price = $this->getPrice($k,$room_type);

            $data[] = [
                'date'=>$k,
                'check_in'=>$v['start'],
                'check_out'=>$v['end'],
                'price'=>$price,
                'sub_total'=>$price*$requir_room,
            ];
            $total_price +=$price*$requir_room;
        }

        $total_night =count($night_calculation);


       return [
           'night_list'=>$data,
           'total_night'=>$total_night,
           'total_price'=>$total_price,
       ];
    }
    protected function getPrice($date,RoomType $room_type){
        $day = Carbon::parse($date)->dayOfWeek+1;
        return $room_type->getDayByCurrentPrice($day);
    }
    public function applyCoupon(Request $request){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $this->validate($request,[
            'code'=>'required'
        ]);
        $reservation_data = session()->get('reservation');
        $response = [];
        if($reservation_data['user'] === null){
            $user = new User();
            $user->first_name = $reservation_data['name'];
            $user->username = str_random(6);
            $user->email = $reservation_data['email'];
            $user->phone = $reservation_data['phone'];
            $user->password = bcrypt(123456);
            $user->save();
            $reservation_data['user'] = $user;
        }
        if($coupon = CouponMaster::where('code',$request->code)->first()){
            if(!$coupon->hasCoupon($reservation_data['user']->id,$reservation_data['sub_total'])){
                throw ValidationException::withMessages([
                    'code' => [$coupon->getMessage($reservation_data['user']->id,$reservation_data['sub_total'])]
                ]);
            }else{
                $response['status']='ok';
                $response['message']='Coupon apply success';
                $response['data']=$coupon;
            }
        }else{
            throw ValidationException::withMessages([
                'code' => ['Code is invalid']
            ]);
        }
        if($coupon->type === 'PERCENTAGE'){
            $coupon['cal_price'] = $coupon->value * $reservation_data['sub_total']/100;
        }else{
            $coupon['cal_price'] = $coupon->value;
        }
        $sub_total = $reservation_data['sub_total']-$coupon['cal_price'];

        $tex_list = TaxManager::whereStatus(1)->get();
        if($tex_list->count()){
            $tex_list->map(function ($item,$key) use($request,$sub_total){
                $cal_price = 0;
                switch ($item->type){
                    case 'PERCENTAGE':
                        $cal_price = $item->rate * $sub_total/100;
                        break;
                    case 'FIXED':
                        $cal_price = $item->rate;
                        break;
                }
                $item['cal_price']=$cal_price;
                return $item;
            });
            $reservation_data['payable_amount'] = $tex_list->sum('cal_price')+$sub_total;
        }else{
            $reservation_data['payable_amount'] = $sub_total;
            $tex_list =null;
        }
        $reservation_data['sub_total'] = $sub_total;
        $reservation_data['tax_list']=$tex_list;
        $reservation_data['coupon']=$response['data'];
        session()->put('reservation',$reservation_data);
        return back()->with('success',$response['message']);
    }
    public function checkout(){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $reservation_data = session()->get('reservation');
        $room_type = RoomType::findOrFail($reservation_data['room_type']);
        return view('frontend.checkout',compact('reservation_data','room_type'));
    }
    public function confirmCheckout(){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        return redirect()->route('select_gateway');
    }
    public function selectGateway(Request $request){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $gateway = Gateway::whereStatus(1)->where('is_online',1)->get();
        return view('frontend.select_gateway',compact('gateway'));
    }
    public function insertReservation($gateway_id){

        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $reservation_data = session()->get('reservation');
        if($reservation_data['user'] === null){
            $user = new User();
            $user->first_name = $reservation_data['name'];
            $user->username = str_random(6);
            $user->email = $reservation_data['email'];
            $user->phone = $reservation_data['phone'];
            $user->password = bcrypt(123456);
            $user->save();
            $reservation_data['user'] = $user;
        }

        $reservation_data['gateway'] = $gateway_id;
        session()->put('reservation',$reservation_data);



        $amount = $reservation_data['payable_amount'];
        if($amount<=0)
        {
            return back()->with('error', 'Invalid Amount');
        }
        else
        {

            $gate = Gateway::findOrFail($gateway_id);

            if(isset($gate))
            {
                if($gate->minamo <= $amount || $gate->maxamo >= $amount)
                {
                    $charge = 0;
                    $usdamo = ($amount + $charge)/$gate->rate;

                    $payment = new Payment();
                    $payment->user_id = $reservation_data['user']->id;
                    $payment->gateway_id = $gate->id;
                    $payment->amount = $amount;
                    $payment->usd_amo = $usdamo;
                    $payment->trx = time().'-'.rand(1111,9999);
                    $payment->save();

                    session()->put($this->session_name,$payment->trx);

                    return redirect()->route('payment.preview');

                }
                else
                {
                    return back()->with('error', 'Please Follow Payment Limit');
                }
            }
            else
            {
                return back()->with('error', 'Please Select Payment gateway');
            }
        }
    }
    public function paymentPreview(){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $track = session()->get('Track');
        $data = Payment::where('status',0)->where('trx',$track)->first();
        $pt = 'Payment Preview';

        return view('frontend.users.payment.preview',compact('pt','data'));
    }
    public function checkAvailableRoom(Request $request,$id){
        if($request->ajax()){

            $arrival = Carbon::parse($request->arrival)->format('Y/m/d');
            $departure = Carbon::parse($request->departure)->subDay()->format('Y/m/d');
            $adult = $request->adult;
            $children = $request->children;

            $data['number_of_room'] = $this->roomCalculate($id,$adult,$children);
            $getRoomByDate = $this->getRoomByDate($id,$arrival,$departure);
            $data['total_night'] = count($getRoomByDate['night']);
            $data['available'] = $getRoomByDate['available'];
            return response()->json([
                'status'=>'success',
                'class'=>'text-success',
                'message'=>'Available room for your selected booking duration.',
                'data'=>$data
            ]);
        }
    }
    public function roomCalculate(int $room_type,$adults,$kids){
        $room_type = RoomType::find($room_type);

         $adults_room =ceil( $adults/$room_type->higher_capacity);
        $adults_room = $adults_room>0?$adults_room:1;
        $kids_room =ceil( $kids/$room_type->kids_capacity);
        $kids_room = $kids_room>0?$kids_room:1;
        if($adults_room > $kids_room){
          return  $adults_room;
        }else{
            return $kids_room;
        }
    }
    public function getRoomByDate(int $room_type,$arrival,$departure){
        $night =$this->nightCalculation([$arrival,$departure],[general_setting()->check_in_time,general_setting()->check_out_time]);

        $arr_key = array_keys($night);
        $data['night'] = $arr_key;
        $data['available'] = 1;
        return $data;
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





    public function userDataUpdate($data)
    {
        $i=0;
        if($data->status==0 && session()->has('reservation')){
            $booking_data = session()->get('reservation');

            DB::beginTransaction();
            try{
                $room_type = RoomType::findOrFail($booking_data['room_type']);
                $reservation = new Reservation();
                $reservation->uid = rand(1111,9999).'-'.time();
                $reservation->user_id = $booking_data['user']->id;
                $reservation->room_type_id = $room_type->id;
                $reservation->online = 1;
                $reservation->adults = $booking_data['adult'];
                $reservation->kids = $booking_data['children'];
                $reservation->check_in = $booking_data['arrival'];
                $reservation->check_out = $booking_data['departure'];
                $reservation->number_of_room = $booking_data['rooms_per_night'];
                $reservation->status = 'ONLINE_PENDING';
                $reservation->save();
                $data['reservetion_id'] = $reservation->id;
                $data['status'] = 1;
                $data->update();
                foreach ($booking_data['night_list']['night_list'] as $v){
                    for($i=1;$i<= $reservation->number_of_room;$i++){
                        $night = new ReservationNight();
                        $night->reservation_id = $reservation->id;
                        $night->date = $v['date'];
                        $night->check_in = $v['check_in'];
                        $night->check_out =  $v['check_out'];
                        $night->price = $v['price'];
                        $night->save();
                    }
                }


                if(null !== $booking_data['tax_list']){
                    foreach ($booking_data['tax_list'] as $v){
                        $tax = new ReservationTax();
                        $tax->reservation_id = $reservation->id;
                        $tax->tax_id = $v->id;
                        $tax->type = $v->type;
                        $tax->value = $v->rate;
                        $tax->price = $v->cal_price;
                        $tax->save();
                    }
                }


                if(null !== $booking_data['coupon']){
                    $appliedCouponCode = new AppliedCouponCode();
                    $appliedCouponCode->reservation_id = $reservation->id;
                    $appliedCouponCode->coupon_id = $booking_data['coupon']->id;
                    $appliedCouponCode->user_id = $booking_data['user']->id;
                    $appliedCouponCode->date = Carbon::now();
                    $appliedCouponCode->coupon_type = $booking_data['coupon']->type;
                    $appliedCouponCode->coupon_rate =  $booking_data['coupon']->value;
                    $appliedCouponCode->save();
                }
                $tran = new Transaction();
                $tran->user_id = $booking_data['user']->id;
                $tran->gateway_id = $data->gateway_id;
                $tran->amount = $data->amount;
                $tran->remarks = 'Payment for room reservation';
                $tran->trx = $data->trx;
                $tran->save();
                $msg =  "Successful your reservation.Your reservation no <b>#".$reservation->uid."</b>";
                $user = $booking_data['user'];

                $this->sendEmail($user->email, $user->username, 'Reservation Successful', $msg);
                $sms =  "Successful your reservation.Your reservation no #".$reservation->uid;
                $this->sendSms($user->mobile, $sms);
                $status = true;
                DB::commit();
            }catch (\Exception $e){
                $status = false;
                DB::rollback();
                dd($e->getMessage());
            }

        }
        session()->put('reservation_confirm',$reservation->id);
        session()->forget('reservation');
    }


    public function cancelUrl()
    {
        session()->forget('reservation');
        return route('home');
    }

    public function successUrl()
    {
        session()->forget('reservation');
        $this->success_message = 'Reservation Successful';
        return route('reservation.success');
    }

    public function viewPath()
    {
        return 'frontend.users.payment';
    }
}
