<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\CodeManager;
use App\Model\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralSettingController extends Controller
{
    public function generalSetting(){
        $setting_data = GeneralSetting::first();
        return view('backend.admin.setting.general_setting',compact('setting_data'));
    }
    public function generalSettingUpdate(Request $request){
        $general_setting = GeneralSetting::first();
        $general_setting->title = $request->title;
        $general_setting->name = $request->name;
        $general_setting->address = $request->address;
        $general_setting->email = $request->email;
        $general_setting->phone = $request->phone;
        $general_setting->color = $request->color;
        $general_setting->cur = $request->cur;
        $general_setting->cur_sym = $request->cur_sym;
        $general_setting->check_in_time = $request->check_in_time;
        $general_setting->check_out_time = $request->check_out_time;
        $general_setting->en = $request->has('en')?1:0;
        $general_setting->mn = $request->has('mn')?1:0;
      $general_setting->save();
      return redirect()->back()->with('success','Update Successful');
    }

    public function emailSetting(){
        return view('backend.admin.setting.email_setting');
    }
    public function emailSettingUpdate(Request $request){
        $email_template = GeneralSetting::first();
        $email_template->sender_email = $request->sender_email;
        $email_template->email_message = $request->email_message;
        $email_template->save();
        return redirect()->back()->with('success','Update has been successful');
    }
    public function smsSetting(){
        return view('backend.admin.setting.sms_setting');
    }
    public function smsSettingUpdate(Request $request){
        $email_template = GeneralSetting::first();
        $email_template->sms_api = $request->sms_api;
        $email_template->save();
        return redirect()->back()->with('success','Update has been successful');
    }
    public function logoAndFavicon(){
        return view('backend.admin.setting.logo_and_favicon');
    }
    public function logoAndFaviconUpdate(Request $request){
        $this->validate($request,[
            'logo'=>'image|mimes:png',
            'favicon'=>'image|mimes:png'
        ]);
        if($request->hasFile('logo')){
            $site_logo_image = $request->file('logo');
            $site_logo_image_ext = $site_logo_image->getClientOriginalExtension();
            $site_logo_image->move('assets','logo.'.$site_logo_image_ext);
        }
        if($request->hasFile('favicon')){
            $site_favicon_image = $request->file('favicon');
            $site_favicon_image_ext = $site_favicon_image->getClientOriginalExtension();
            $site_favicon_image->move('assets','favicon.'.$site_favicon_image_ext);
        }
        return redirect()->back()->with('success','Update has been successful');
    }
    public function codeSetting(){
        $codes = CodeManager::all();
        return view('backend.admin.setting.code_setting',compact('codes'));
    }
    public function codeSettingUpdate(Request $request,$name){
        if($codes = CodeManager::where('name',$name)->first()){
            $codes->prefix = $request->prefix;
            $codes->divider = $request->divider;
            $codes->from = $request->from;
            $codes->auto_generate =1;
            $codes->save();
            return redirect()->back()->with('success','Update has been successful');
        }
        return abort(404);
    }
}
