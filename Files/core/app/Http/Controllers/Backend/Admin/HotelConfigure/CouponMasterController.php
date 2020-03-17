<?php

namespace App\Http\Controllers\Backend\Admin\HotelConfigure;

use App\Model\CouponMaster;
use App\Model\PaidService;
use App\Model\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class CouponMasterController extends Controller
{
    /**
     * @var CouponMaster
     */
    private $couponMaster;
    /**
     * @var RoomType
     */
    private $roomType;
    /**
     * @var PaidService
     */
    private $paidService;

    public  function __construct(CouponMaster $couponMaster,RoomType $roomType,PaidService $paidService
    )
    {
        $this->couponMaster = $couponMaster;
        $this->roomType = $roomType;
        $this->paidService = $paidService;
    }

    public function index(){
        $couponMasters = $this->couponMaster->get();

        return view('backend.admin.hotel_configure.coupon_master.index',compact('couponMasters'));
    }
    public function create(){
        $room_types = $this->roomType->where('status',1)->get();
        $paid_services = $this->paidService->where('status',1)->get();
        return view('backend.admin.hotel_configure.coupon_master.create',compact('room_types','paid_services'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'code'=>'required|max:191|unique:coupon_masters',
            'offer_title'=>'required|max:191',
            'period_start_time'=>'required|date|after_or_equal:today',
            'period_end_time'=>'required|date|after_or_equal:period_start_time',
            'type'=>'required',
            'min_amount'=>'required|numeric|min:0',
            'max_amount'=>'required|numeric|min:0',
            'value'=>'required|numeric|min:0',
            'limit_per_user'=>'required|integer|min:0',
            'limit_per_coupon'=>'required|integer|min:0',
            'room_type'=>'required',
        ]);
        $couponMaster = new $this->couponMaster;
        $couponMaster->offer_title = $request->offer_title;
        $couponMaster->description = $request->description;

        if($request->hasFile('image')){
            $path = 'assets/backend/image/coupon/';
            $couponMaster->image = time().'.png';
            Image::make($request->image)->save($path.$couponMaster->image);
        }
        $couponMaster->period_start_time = $request->period_start_time;
        $couponMaster->period_end_time = $request->period_end_time;
        $couponMaster->code = $request->code;
        $couponMaster->type = $request->type;
        $couponMaster->value = $request->value;
        $couponMaster->min_amount = $request->min_amount;
        $couponMaster->max_amount = $request->max_amount;
        $couponMaster->limit_per_user = $request->limit_per_user;
        $couponMaster->limit_per_coupon = $request->limit_per_coupon;
        $couponMaster->status = $request->has('status')?1:0;
        $couponMaster->save();
        $couponMaster->roomType()->attach($request->room_type);
        if($request->has('paid_service'))
        $couponMaster->paidService()->attach($request->paid_service);
        return redirect()->back()->with('success','Save successful');
    }
    public function edit($id){
        $couponMaster = $this->couponMaster->findOrFail($id);
        $room_types = $this->roomType->where('status',1)->get();
        $paid_services = $this->paidService->where('status',1)->get();
        return view('backend.admin.hotel_configure.coupon_master.edit',compact('couponMaster','room_types','paid_services'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'code'=>'required|max:191|unique:coupon_masters,code,'.$id,
            'offer_title'=>'required|max:191',
            'period_start_time'=>'required|date|after_or_equal:today',
            'period_end_time'=>'required|date|after_or_equal:period_start_time',
            'type'=>'required',
            'min_amount'=>'required|numeric|min:0',
            'max_amount'=>'required|numeric|min:0',
            'value'=>'required|numeric|min:0',
            'limit_per_user'=>'required|integer|min:0',
            'limit_per_coupon'=>'required|integer|min:0',
            'room_type'=>'required',
        ]);
        $couponMaster =$this->couponMaster->findOrFail($id);
        $couponMaster->offer_title = $request->offer_title;
        $couponMaster->description = $request->description;

        if($request->hasFile('image')){
            $path = 'assets/backend/image/coupon/';
            @unlink($path.$couponMaster->image);
            $couponMaster->image = time().'.png';
            Image::make($request->image)->save($path.$couponMaster->image);
        }
        $couponMaster->period_start_time = $request->period_start_time;
        $couponMaster->period_end_time = $request->period_end_time;
        $couponMaster->code = $request->code;
        $couponMaster->type = $request->type;
        $couponMaster->value = $request->value;
        $couponMaster->min_amount = $request->min_amount;
        $couponMaster->max_amount = $request->max_amount;
        $couponMaster->limit_per_user = $request->limit_per_user;
        $couponMaster->limit_per_coupon = $request->limit_per_coupon;
        $couponMaster->status = $request->has('status')?1:0;
        $couponMaster->save();
        $couponMaster->roomType()->sync($request->room_type);
        if($request->has('paid_service')){
            $couponMaster->paidService()->sync($request->paid_service);
        }else{
            $couponMaster->paidService()->sync([]);
        }

        return redirect()->back()->with('success','Update successful');
    }
    public function delete($id){
        $this->couponMaster->findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
}
