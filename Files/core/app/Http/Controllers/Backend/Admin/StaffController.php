<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\MimeCheckRules;
use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class StaffController extends Controller
{
    /**
     * @var $staff
     */
    private $staff;

    public function __construct(Admin $staff)
    {
        $this->staff = $staff;
    }
    public function index(){
        $staffs = $this->staff->whereRole(1)->paginate(15);
        return view('backend.admin.staff.index',compact('staffs'));
    }
    public function create(){
        return view('backend.admin.staff.create');
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
            'picture'=>['nullable',new MimeCheckRules(['png']),'max:2048','image']
        ]);
        $staffs = new $this->staff;
        $staffs->username = $request->username;
        $staffs->first_name = $request->first_name;
        $staffs->last_name = $request->last_name;
        $staffs->phone = $request->phone;
        $staffs->email = $request->email;
        $staffs->address = $request->address;
        $staffs->sex = $request->sex;
        $staffs->role =1;
        if($request->has('picture')){
            $path_pic = 'assets/backend/image/staff/pic/';
            $staffs->picture = 'pic_'.time().'.png';
            Image::make($request->picture)->save($path_pic.$staffs->picture);
        }
        $staffs->password = bcrypt($request->password);
        $staffs->status = $request->has('status')?1:0;
        $staffs->save();
        return redirect()->back()->with('success','Staff save successful');
    }
    public function view($id){
        $staff = $this->staff->findOrFail($id);
        return view('backend.admin.staff.view',compact('staff'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'first_name'=>'nullable|max:191|string',
            'last_name'=>'nullable|max:191|string',
            'phone'=>'required|max:191|string',
            'email'=>'required|max:191|string',
            'address'=>'nullable|string',
            'sex'=>'required|string',
            'password'=>'nullable|string',
            'picture'=>['nullable',new MimeCheckRules(['png']),'max:2048','image'],
        ]);
        $staffs = $this->staff->findOrFail($id);
        $staffs->first_name = $request->first_name;
        $staffs->last_name = $request->last_name;
        $staffs->phone = $request->phone;
        $staffs->email = $request->email;
        $staffs->address = $request->address;
        $staffs->sex = $request->sex;
        if($request->has('picture')){
            $path_pic = 'assets/backend/image/staff/pic/';
            @unlink($path_pic.$staffs->picture);
            $staffs->picture = 'pic_'.time().'.png';
            Image::make($request->picture)->save($path_pic.$staffs->picture);
        }
        if($request->password){
            $staffs->password = bcrypt($request->password);
        }

        $staffs->status = $request->has('status')?1:0;
        $staffs->save();
        return redirect()->back()->with('success','Staff update successful');
    }
}
