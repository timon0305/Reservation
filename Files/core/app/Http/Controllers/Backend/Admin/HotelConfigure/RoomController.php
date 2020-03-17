<?php

namespace App\Http\Controllers\Backend\Admin\HotelConfigure;

use App\Http\Helper\MimeCheckRules;
use App\Model\Floor;
use App\Model\Room;
use App\Model\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class RoomController extends Controller
{
    /**
     * @var Room
     */
    private $room;
    /**
     * @var Floor
     */
    private $floor;
    /**
     * @var RoomType
     */
    private $roomType;

    public  function __construct(Room $room,Floor $floor,RoomType $roomType)
    {
        $this->room = $room;
        $this->floor = $floor;
        $this->roomType = $roomType;
    }

    public function index(){
        $rooms = $this->room->paginate(15);
        return view('backend.admin.hotel_configure.room.index',compact('rooms'));
    }
    public function create(){
        $floors = $this->floor->where('status',1)->get();
        $room_types = $this->roomType->where('status',1)->get();
        return view('backend.admin.hotel_configure.room.create',compact('floors','room_types'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'room_type'=>'required|integer',
            'floor'=>'required|integer',
            'number'=>'required|integer|unique:rooms',
            'image'=>[new  MimeCheckRules(['jpg']),'max:2048','image'],
        ]);
        $room = new $this->room;
        $room->room_type_id = $request->room_type;
        $room->floor_id = $request->floor;
        $room->number = $request->number;
        if($request->hasFile('image')){
            $path = 'assets/backend/image/room/';
            $room->image = time().'.png';
            Image::make($request->image)->save($path.$room->image);
        }
        $room->status = $request->has('status')?1:0;
        $room->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit($id){
        $room = $this->room->findOrFail($id);
        $floors = $this->floor->where('status',1)->get();
        $room_types = $this->roomType->where('status',1)->get();
        return view('backend.admin.hotel_configure.room.edit',compact('room','floors','room_types'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'room_type'=>'required|integer',
            'number'=>'required|integer|unique:rooms,number,'.$id,
            'image'=>[new  MimeCheckRules(['jpg']),'max:2048','image'],
        ]);

        $room = $this->room->findOrFail($id);
        $room->room_type_id = $request->room_type;
        $room->number = $request->number;
        if($request->hasFile('image')){
            $path = 'assets/backend/image/room/';
            @unlink($path.$room->image);
            $room->image = time().'.png';
            Image::make($request->image)->save($path.$room->image);
        }
        $room->status = $request->has('status')?1:0;
        $room->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function delete($id){
        $this->room->findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
}
