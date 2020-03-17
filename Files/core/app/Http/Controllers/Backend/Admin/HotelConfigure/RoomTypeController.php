<?php

namespace App\Http\Controllers\Backend\Admin\HotelConfigure;

use App\Http\Helper\MimeCheckRules;
use App\Model\Amenity;
use App\Model\RegularPrice;
use App\Model\RoomType;
use App\Model\RoomTypeImage;
use App\Model\SpecialPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class RoomTypeController extends Controller
{
    /**
     * @var RoomType
     */
    private $roomType;
    /**
     * @var Amenity
     */
    private $amenity;
    /**
     * @var RoomTypeImage
     */
    private $roomTypeImage;
    /**
     * @var RegularPrice
     */
    private $regularPrice;
    /**
     * @var SpecialPrice
     */
    private $specialPrice;

    public  function __construct(RoomType $roomType,Amenity $amenity,RoomTypeImage $roomTypeImage,RegularPrice $regularPrice,SpecialPrice $specialPrice)
    {
        $this->roomType = $roomType;
        $this->amenity = $amenity;
        $this->roomTypeImage = $roomTypeImage;
        $this->regularPrice = $regularPrice;
        $this->specialPrice = $specialPrice;
    }

    public function index(){
        $roomTypes = $this->roomType->get();
        return view('backend.admin.hotel_configure.room_type.index',compact('roomTypes'));
    }
    public function create(){
        $amenities = $this->amenity->where('status',1)->get();
        return view('backend.admin.hotel_configure.room_type.create',compact('amenities'));
    }

    public function store(Request $request){
        $request['slug'] = str_slug($request->title);
        $this->validate($request,[
            'title'=>'required|max:191|unique:room_types',
            'slug'=>'required|max:191|unique:room_types',
            'short_code'=>'required|max:191|unique:room_types',
            'higher_capacity'=>'required|integer|min:1',
            'kids_capacity'=>'required|integer|min:0',
            'base_price'=>'required|numeric|min:0',
            'amenities'=>'nullable'
        ]);
        $roomType= new $this->roomType;
        $roomType->title = $request->title;
        $roomType->slug = $request->slug;
        $roomType->short_code = $request->short_code;
        $roomType->description = $request->description;
        $roomType->higher_capacity = $request->higher_capacity;
        $roomType->kids_capacity = $request->kids_capacity;
        $roomType->base_price = $request->base_price;
        $roomType->status = $request->has('status')?1:0;
        $roomType->save();
        if($request->has('amenities')){
            $roomType->amenity()->attach($request->amenities);
        }

        return redirect()->back()->with('success','Save successful');
    }

    public function view($id){
        $roomType = $this->roomType->with('roomTypeImage')->findOrFail($id);
        return view('backend.admin.hotel_configure.room_type.view',compact('roomType'));
    }
    public function edit($id){
        $roomType = $this->roomType->findOrFail($id);
        $amenities = $this->amenity->where('status',1)->get();
        return view('backend.admin.hotel_configure.room_type.edit',compact('roomType','amenities'));
    }
    public function update(Request $request,$id){
        $request['slug'] = str_slug($request->title);

        $this->validate($request,[
            'title'=>'required|max:191|unique:room_types,title,'.$id,
            'slug'=>'required|max:191|unique:room_types,slug,'.$id,
            'short_code'=>'required|max:191|unique:room_types,short_code,'.$id,
            'higher_capacity'=>'required|integer|min:1',
            'kids_capacity'=>'required|integer|min:0',
            'base_price'=>'required|numeric|min:0',
            'amenities'=>'nullable'
        ]);
        $roomType = $this->roomType->findOrFail($id);
        $roomType->title = $request->title;
        $roomType->slug = $request->slug;
        $roomType->short_code = $request->short_code;
        $roomType->description = $request->description;
        $roomType->higher_capacity = $request->higher_capacity;
        $roomType->kids_capacity = $request->kids_capacity;
        $roomType->base_price = $request->base_price;
        $roomType->status = $request->has('status')?1:0;
        $roomType->save();
        if($request->has('amenities')){
            $roomType->amenity()
            ->sync($request->amenities);
        }else{
            $roomType->amenity()
                ->sync([]);
        }
        return redirect()->back()->with('success','Update successful');
    }
    public function delete($id){
        $this->amenity->findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }

    /**
     *Upload image
     */
    public function uploadImage(Request $request){
        $this->validate($request,[
            'room_type'=>'required|integer',
            'image'=>['required','max:2048','image',new MimeCheckRules(['jpg'])]
        ]);
        if(($featured_image =$this->roomTypeImage->where('featured',1)->where('room_type_id', $request->room_type)->first()) && $request->has('featured')){
            $featured_image->featured = 0;
            $featured_image->save();
        }
        $roomTypeImage = new $this->roomTypeImage;
        $roomTypeImage->room_type_id = $request->room_type;
        if($request->hasFile('image')){
            $path = 'assets/backend/image/room_type_image/';
            $path_th = 'assets/backend/image/room_type_image_th/';
            $roomTypeImage->image = time().'_'.$request->room_type.'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(350,270)->save($path_th.$roomTypeImage->image);
            Image::make($request->image)->save($path.$roomTypeImage->image);
        }

        $roomTypeImage->featured = $request->has('featured')?1:0;
        $roomTypeImage->save();
        return redirect()->back()->with('success','Upload successful');
    }
    public function deleteImage (Request $request){
        $room_type_img = $this->roomTypeImage->findOrFail($request->id);
        $path = 'assets/backend/image/room_type_image/';
        $path_th = 'assets/backend/image/room_type_image_th/';
        @unlink($path.$room_type_img->image);
        @unlink($path_th.$room_type_img->image);
        $room_type_img->delete();
        return redirect()->back()->with('success','Delete successful');

    }
    public function setAsFeatured($room_type_id,$id){
        if($featured_image =$this->roomTypeImage->where('featured',1)->where('room_type_id', $room_type_id)->first()){
            $featured_image->featured = 0;
            $featured_image->save();
        }
        $roomTypeImage = $this->roomTypeImage->findOrFail($id);
        $roomTypeImage->featured = 1;
        $roomTypeImage->save();
        return redirect()->back()->with('success','Upload successful');
    }

    public function regularPriceUpdate(Request $request,$id){
        $this->validate($request,[
            'day'=>'required'
        ]);
        $roomType = $this->roomType->findOrFail($id);
        if(!$regularPrice =$roomType->regularPrice){
            $regularPrice = new $this->regularPrice;
            $regularPrice->room_type_id = $id;
        }
        foreach ($request->day as $key=>$value){
            $this->validate($request,[
                'day.1.amount'=>'required|numeric|min:0'
            ],[
                'day.1.amount.required'=>days_arr()[$key].' amount is required',
                'day.1.amount.min'=>days_arr()[$key].' amount must be at last 0',
                'day.1.amount.numeric'=>days_arr()[$key].' amount must be numeric',
            ]);
            $regularPrice['day_'.$key] =$value['amount']?$value['type']:'ADD';

            $regularPrice['day_'.$key.'_amount'] =$value['amount'];
        }
        $regularPrice->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function specialPriceUpdate(Request $request,$id){
        $this->validate($request,[
            'day'=>'required',
            'title'=>'required',
            'start_time'=>'required|date|after_or_equal:today',
            'end_time'=>'required|date|after_or_equal:period_start_time',
        ]);
        $roomType = $this->roomType->findOrFail($id);
        $specialPrice = new $this->specialPrice;
        $specialPrice->room_type_id = $id;
        $specialPrice->title =$request->title;
        $specialPrice->start_time =$request->start_time;
        $specialPrice->end_time =$request->end_time;
        foreach ($request->day as $key=>$value){
            $this->validate($request,[
                'day.1.amount'=>'required|numeric|min:0'
            ],[
                'day.1.amount.required'=>days_arr()[$key].' amount is required',
                'day.1.amount.min'=>days_arr()[$key].' amount must be at last 0',
                'day.1.amount.numeric'=>days_arr()[$key].' amount must be numeric',
            ]);
            $regularPrice['day_'.$key] =$value['amount']?$value['type']:'ADD';

            $regularPrice['day_'.$key.'_amount'] =$value['amount'];
        }
        $specialPrice->save();
        return redirect()->back()->with('success','Save successful');
    }
}
