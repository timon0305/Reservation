<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\Gateway;
use App\Model\Payment;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
class GatewayController extends Controller
{
    /**
     * @var Gateway
     */
    private $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function index($type=null){
        $items = $this->gateway;
        if($type !== null){
            if($type === 'online'){
                $items =$items->where('is_online',1);
            }
            if($type === 'offline'){
                $items =$items->where('is_offline',1);
            }
        }

        $items = $items->get();
        return view('backend.admin.payment.gateway', compact('items'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'gateimg' => 'image|mimes:jpg,jpeg,png|max:2048'
        ],
            [
                'gateimg.image' => 'Gateway image should be an image',
                'gateimg.mimes' => 'Gateway image support only jpeg, jpg, png type file',
                'gateimg.max' => 'Gateway image size is too large',
            ]);
        $excp = $request->except('_token', 'gateimg', 'status');
        $get_id = $this->gateway->max('id') +1;

        if($request->hasFile('gateimg'))
        {
            $path = 'assets/backend/image/gateway/';
            $image = $get_id . '.jpg';
            Image::make($request->file('gateimg')->getRealPath())->resize(800, 800)->save($path. $image);
        }
        $gateway = new $this->gateway;
        $gateway->id = $get_id;
        $gateway->name = $request->name;
        $gateway->main_name = $request->name;
        $gateway->rate = $request->rate;
        $gateway->fixed_charge = $request->fixed_charge;
        $gateway->percent_charge = $request->percent_charge;
        $gateway->status = $request->status =="1" ?1:0;
        $gateway->is_online = $request->is_online  =="1" ?1:0 ;
        $gateway->is_offline = $request->is_offline  =="1" ?1:0 ;
        $gateway->save();
        session()->flash('success', 'Gateway Updated');
        return back();
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'gateimg' => 'image|mimes:jpg,jpeg,png|max:2048'
        ],
            [
                'gateimg.image' => 'Gateway image should be an image',
                'gateimg.mimes' => 'Gateway image support only jpeg, jpg, png type file',
                'gateimg.max' => 'Gateway image size is too large',
            ]);
        $excp = $request->except('_token', 'gateimg', 'status');
        if($request->hasFile('gateimg'))
        {
            $path = 'assets/backend/image/gateway/';
            @unlink($path. $id.'.jpg');
            $image = $id . '.jpg';
            Image::make($request->file('gateimg')->getRealPath())->resize(800, 800)->save($path. $image);
        }
        $staus = $request->status =="1" ?1:0 ;
        $is_online = $request->is_online  =="1" ?1:0 ;
        $is_offline = $request->is_offline  =="1" ?1:0 ;
        Gateway::findOrFail($id)->update($excp + [
            'status' => $staus,
            'is_online' => $is_online,
            'is_offline' => $is_offline,
            ]);
        session()->flash('success', 'Gateway Updated');
        return back();
    }

    public function paymentLog($id=null){
        $logs = Payment::whereStatus(1);
        $gateway = null;
        if($id !== null){
            $gateway = $this->gateway->findOrFail($id);
            $logs=$logs->where('gateway_id',$id);

        }

           $logs=$logs->latest()->paginate(20);
        return view('backend.admin.payment.payment_log', compact('logs','gateway'));
    }


}
