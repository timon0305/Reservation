<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\MimeCheckRules;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class GuestController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index(){
        $guests = $this->user->paginate(15);
        return view('backend.admin.guests.index',compact('guests'));
    }
    public function create(){
        return view('backend.admin.guests.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'username'=>'required|max:191|string|unique:users',
            'first_name'=>'required|max:191|string',
            'last_name'=>'required|max:191|string',
            'phone'=>'required|max:191|string',
            'email'=>'required|max:191|string',
            'address'=>'required|string',
            'sex'=>'required|string',
            'password'=>'required|string',
            'picture'=>['nullable',new MimeCheckRules(['png']),'max:2048','image'],
            'id_card_image'=>['nullable',new MimeCheckRules(['png','jpg']),'max:2048','image'],
        ]);
        $guests = new $this->user;
        $guests->username = $request->username;
        $guests->first_name = $request->first_name;
        $guests->last_name = $request->last_name;
        $guests->phone = $request->phone;
        $guests->email = $request->email;
        $guests->dob = $request->dob;
        $guests->address = $request->address;
        $guests->sex = $request->sex;
        if($request->has('picture')){
            $path_pic = 'assets/backend/image/guest/pic/';
            $guests->picture = 'pic_'.time().'.png';
            Image::make($request->picture)->save($path_pic.$guests->picture);
        }
        $guests->password = bcrypt($request->password);
        $guests->id_type = $request->id_type;
        $guests->id_number = $request->id_number;
        if($request->has('id_card_image')){
            $path_card_image = 'assets/backend/image/guest/card_image/';
            $guests->id_card_image = 'id_'.time().'.'.$request->id_card_image->getClientOriginalExtension();
            Image::make($request->id_card_image)->save($path_card_image.$guests->id_card_image);
        }
        $guests->remarks = $request->remarks;
        $guests->vip = $request->has('vip')?1:0;
        $guests->status = $request->has('status')?1:0;
        $guests->save();
        return redirect()->back()->with('success','Guest save successful');
    }
    public function view($id){
        $guest = $this->user->findOrFail($id);
        return view('backend.admin.guests.view',compact('guest'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'first_name'=>'nullable|max:191|string',
            'last_name'=>'nullable|max:191|string',
            'phone'=>'required|max:191|string',
            'email'=>'required|max:191|string',
            'address'=>'nullable|string',
            'sex'=>'required|string',
            'picture'=>['nullable',new MimeCheckRules(['png']),'max:2048','image'],
            'id_card_image'=>['nullable',new MimeCheckRules(['png','jpg']),'max:2048','image'],
        ]);
        $guests = $this->user->findOrFail($id);
        $guests->first_name = $request->first_name;
        $guests->last_name = $request->last_name;
        $guests->phone = $request->phone;
        $guests->email = $request->email;
        $guests->address = $request->address;
        $guests->sex = $request->sex;
        $guests->dob = $request->dob;
        if($request->has('picture')){
            $path_pic = 'assets/backend/image/guest/pic/';
            @unlink($path_pic.$guests->picture);
            $guests->picture = 'pic_'.time().'.png';
            Image::make($request->picture)->save($path_pic.$guests->picture);
        }
        $guests->password = bcrypt($request->password);
        $guests->id_type = $request->id_type;
        $guests->id_number = $request->id_number;
        if($request->has('id_card_image')){
            $path_card_image = 'assets/backend/image/guest/card_image/';
            @unlink($path_card_image.$guests->id_card_image);
            $guests->id_card_image = 'id_'.time().'.'.$request->id_card_image->getClientOriginalExtension();
            Image::make($request->id_card_image)->save($path_card_image.$guests->id_card_image);
        }
        $guests->remarks = $request->remarks;
        $guests->vip = $request->has('vip')?1:0;
        $guests->status = $request->has('status')?1:0;
        $guests->save();
        return redirect()->back()->with('success','Guest update successful');
    }
}
