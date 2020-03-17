<?php

namespace App\Http\Controllers\Backend\Admin\HotelConfigure;

use App\Model\TaxManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TaxController extends Controller
{
    /**
     * @var TaxManager
     */
    private $tax;

    public  function __construct(TaxManager $tax)
    {
        $this->tax = $tax;
    }

    public function index(){
        $taxes = $this->tax->get();
        return view('backend.admin.hotel_configure.tax.index',compact('taxes'));
    }
    public function create(){
        return view('backend.admin.hotel_configure.tax.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:191',
            'code'=>'required|max:191',
            'type'=>'required',
            'rate'=>'required|numeric',
        ]);
        $tax = new $this->tax;
        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->type = $request->type;
        $tax->rate = $request->rate;
        $tax->status = $request->has('status')?1:0;
        $tax->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit($id){
        $tax = $this->tax->findOrFail($id);
        return view('backend.admin.hotel_configure.tax.edit',compact('tax'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|max:191',
            'code'=>'required|max:191',
            'type'=>'required',
            'rate'=>'required|numeric',
        ]);
        $tax = $this->tax->findOrFail($id);
        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->type = $request->type;
        $tax->rate = $request->rate;
        $tax->status = $request->has('status')?1:0;
        $tax->save();
        return redirect()->back()->with('success','Update successful');
    }
}
