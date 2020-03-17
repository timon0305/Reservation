<?php

namespace App\Http\Controllers\Backend\Admin\HotelConfigure;

use App\Http\Helper\MimeCheckRules;
use App\Model\PaidService;
use App\Model\Room;
use App\Model\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class PaidServiceController extends Controller
{
    /**
     * @var Room
     */
    private $room;
    /**
     * @var RoomType
     */
    private $roomType;
    /**
     * @var PaidService
     */
    private $paidService;

    public  function __construct(PaidService $paidService,Room $room,RoomType $roomType)
    {
        $this->room = $room;
        $this->roomType = $roomType;
        $this->paidService = $paidService;
    }

    public function index(){
        $paid_services = $this->paidService->get();
        return view('backend.admin.hotel_configure.paid_service.index',compact('paid_services'));
    }
    public function create(){
        $room_types = $this->roomType->where('status',1)->get();
        return view('backend.admin.hotel_configure.paid_service.create',compact('room_types'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|max:191|unique:paid_services',
            'price'=>'required|numeric'
        ]);
        $paidService = new $this->paidService;
        $paidService->icon = $request->icon;
        $paidService->title = $request->title;
        $paidService->price = $request->price;
        $paidService->status = $request->has('status')?1:0;
        $paidService->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit($id){
        $paidService = $this->paidService->findOrFail($id);
        $room_types = $this->roomType->where('status',1)->get();
        return view('backend.admin.hotel_configure.paid_service.edit',compact('paidService','room_types'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|max:191|unique:paid_services,title,'.$id,
            'price'=>'required|numeric',
        ]);
        $paidService =  $this->paidService->findOrFail($id);
        $paidService->icon = $request->icon;
        $paidService->title = $request->title;
        $paidService->price = $request->price;
        $paidService->status = $request->has('status')?1:0;
        $paidService->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function delete($id){
        $this->paidService->findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
}
