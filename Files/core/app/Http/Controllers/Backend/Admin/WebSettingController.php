<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\MimeCheckRules;
use App\Model\WebSetting as WS;
use App\Model\WebSetting\WebGalleryCategory;
use App\Model\WebSetting\WebFaq;
use App\Model\WebSetting\WebOurTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class WebSettingController extends Controller
{
    private $faq;
    /**
     * @var WebOurTeam
     */
    private $ourTeam;
    /**
     * @var WS\WebGalleryCategory
     */
    private $galleryCategory;
    /**
     * @var WS\WebGallery
     */
    private $gallery;
    /**
     * @var WS\WebCounterSection
     */
    private $counterSection;
    /**
     * @var WS\WebOurClientFeedback
     */
    private $testimonial;
    /**
     * @var WS\WebSocial
     */
    private $social;
    /**
     * @var WS\WebFacility
     */
    private $facility;

    public function __construct(WebFaq $faq,
                                WebOurTeam $ourTeam,
                                WebGalleryCategory $galleryCategory,
                                WS\WebGallery $gallery,
                                WS\WebCounterSection $counterSection,
                                WS\WebOurClientFeedback $testimonial,
                                WS\WebSocial $social,WS\WebFacility $facility)
    {
        $this->faq = $faq;
        $this->ourTeam = $ourTeam;
        $this->galleryCategory = $galleryCategory;
        $this->gallery = $gallery;
        $this->counterSection = $counterSection;
        $this->testimonial = $testimonial;
        $this->social = $social;
        $this->facility = $facility;
    }
    public function sectionEdit($page,$section){
        $view = 'backend.admin.web_settings.'.str_replace('-','_',$page).'.'.str_replace('-','_',$section);
        if(view()->exists($view)){
            return view($view,compact('page','section'));
        }
        abort(404);
    }
    public function sectionUpdate(Request $request,$page,$section){
        if($this->getSectionMethod($page,$section)){
            $method = '_'.str_replace('-','_',$page).'_'.str_replace('-','_',$section);

           return $this->$method($request);
        }
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key=>$value){
            $field_name = str_replace('-','_',$page).'_'.str_replace('-','_',$section).'_'.$key;
            if(is_array($value)){
                if(array_key_exists('png',$value)){
                  $ext = 'png';
                }elseif (array_key_exists('jpg',$value)){
                    $ext = 'jpg';
                }
                $image_path = 'assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/';
                $name = $key.'.'.$ext;
                $this->validate($request,[
                    $key.'.'.$ext=>[
                        function($attribute, $value, $fail) use ($request,$key,$ext) {
                            if(!in_array($request[$key][$ext]->getClientOriginalExtension(), [$ext])) {
                                return $fail('Only '.$ext.' files are allowed');
                            }
                        },'max:2048'
                    ],
                ]);
                Image::make($request[$key][$ext])->save($image_path.$name);
            }else{
                $gs = WS::first();
                $gs->$field_name = $value;
                $gs->save();
            }
        }
        return redirect()->back()->with('success','Update successful');
    }
    private function getSectionMethod($page,$section,$request=null){
        $method = '_'.str_replace('-','_',$page).'_'.str_replace('-','_',$section);
        if (method_exists($this,$method)){
            return true;
        }
          return false;
    }

    /**
     * contact
     */
    private function _contact_all_section(Request $request){

        $height = '100%';
        $width = '100%';

        $iframe = preg_replace('/height="(.*?)"/i', 'height="' . $height .'"', $request->map);
        $iframe = preg_replace('/width="(.*?)"/i', 'width="' . $width .'"', $iframe);
        $ws = WS::first();
        $ws->contact_all_section_title_1 = $request->title_1;
        $ws->contact_all_section_title_2 = $request->title_2;
        $ws->contact_all_section_phone = $request->phone;
        $ws->contact_all_section_email_web = $request->email_web;
        $ws->contact_all_section_address = $request->address;
        $ws->contact_all_section_map =$iframe;
        $ws->save();
        return redirect()->back()->with('success','Update successful');
    }
    /**
     * Faq area
     */
    public function faqStore(Request $request){
        $faq = new $this->faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function faqUpdate(Request $request,$id){
        $faq =  $this->faq->findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function faqDelete($id){
        $this->faq->findOrFail($id)->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Facility area
     */
    public function facilityStore(Request $request){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $facility = new $this->facility;
        $facility->name = $request->name;
        if($request->has('image')){
            $path = 'assets/frontend/img/home/facility_section/';
            $facility->image = 'facility_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(270,357)->save($path.$facility->image);
        }
        $facility->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function facilityUpdate(Request $request,$id){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $facility =  $this->facility->findOrFail($id);
        $facility->name = $request->name;
        if($request->has('image')){
            $path = 'assets/frontend/img/home/facility_section/';
            @unlink($path.$facility->image);
            $facility->image = 'facility_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(270,357)->save($path.$facility->image);
        }
        $facility->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function facilityDelete($id){
        $facility=  $this->facility->findOrFail($id);

             $path = 'assets/frontend/img/home/facility_section/';
            @unlink($path.$facility->image);
        $facility->delete();
        return redirect()->back()->with('success','Successful delete');
    }

    /**
     * Home Team area
     */
    public function teamStore(Request $request){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $table = new $this->ourTeam;
        $table->name = $request->name;
        $table->title = $request->title;
        $table->fb = $request->fb;
        $table->tw = $request->tw;
        $table->lin = $request->lin;
        $table->gp = $request->gp;
        if($request->has('image')){
            $path = 'assets/frontend/img/home/team_section/';
            $table->image = 'team_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->image);
        }
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function teamUpdate(Request $request,$id){

        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $table =  $this->ourTeam->findOrFail($id);
        $table->name = $request->name;
        $table->title = $request->title;
        $table->fb = $request->fb;
        $table->tw = $request->tw;
        $table->lin = $request->lin;
        $table->gp = $request->gp;
        if($request->has('image')){
            $path = 'assets/frontend/img/home/team_section/';
            @unlink($path.$table->image);
            $table->image = 'team_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->image);
        }
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function teamDelete($id){
        $table= $this->ourTeam->findOrFail($id);
            $path = 'assets/frontend/img/home/team_section/';
            @unlink($path.$table->image);

        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Gallery Category area
     */
    public function galleryCategoryStore(Request $request){
        $table = new $this->galleryCategory;
        $table->name = $request->name;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function galleryCategoryUpdate(Request $request,$id){

        $table =  $this->galleryCategory->findOrFail($id);
        $table->name = $request->name;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function galleryCategoryDelete($id){
         $this->galleryCategory->findOrFail($id)->delete();
        return redirect()->back()->with('success','Successful delete');
    }

    /**
     * Gallery Category area
     */
    public function galleryStore(Request $request){
        $this->validate($request,[
            'category_id'=>'required|integer',
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $table = new $this->gallery;
        if($request->has('image')){
            $path = 'assets/frontend/img/gallery/gallery_section/';
            $table->image = 'gallery_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->image);
        }
        $table->category_id = $request->category_id;
        $table->type = $request->type;
        $table->link = $request->link;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function galleryUpdate(Request $request,$id){
        $this->validate($request,[
            'category_id'=>'required|integer',
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $table =  $this->gallery->findOrFail($id);
        if($request->has('image')){
            $path = 'assets/frontend/img/gallery/gallery_section/';
            @unlink($path.$table->image);
            $table->image = 'gallery_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->image);
        }
        $table->category_id = $request->category_id;
        $table->type = $request->type;
        $table->link = $request->link;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function galleryDelete($id){
        $table= $this->gallery->findOrFail($id);
        $path = 'assets/frontend/img/gallery/gallery_section/';
        @unlink($path.$table->image);

        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Counter Category area
     */
    public function counterStore (Request $request){
        $this->validate($request,[
            'number'=>'nullable|numeric',
        ]);
        $table = new $this->counterSection;
        $table->name = $request->name;
        $table->number = $request->number?$request->number:0;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function counterUpdate(Request $request,$id){
        $this->validate($request,[
            'number'=>'nullable|numeric',
        ]);
        $table =  $this->counterSection->findOrFail($id);
        $table->name = $request->name;
        $table->number = $request->number?$request->number:0;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function counterDelete($id){
        $this->counterSection->findOrFail($id)->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * testimonial Category area
     */
    public function testimonialStore (Request $request){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg'])]
        ]);
        $table = new $this->testimonial;
        $table->name = $request->name;
        $table->title = $request->title;
        $table->feed = $request->feed;
        if($request->has('image')){
            $path = 'assets/frontend/img/testimonial/testimonial_section/';
            $table->image = 'testimonial_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->image);
        }
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function testimonialUpdate(Request $request,$id){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg'])]
        ]);
        $table =  $this->testimonial->findOrFail($id);
        $table->name = $request->name;
        $table->title = $request->title;
        $table->feed = $request->feed;
        if($request->has('image')){
            $path = 'assets/frontend/img/testimonial/testimonial_section/';
            @unlink($path.$table->image);
            $table->image = 'testimonial_'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->image);
        }
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function testimonialDelete($id){
        $table =  $this->testimonial->findOrFail($id);
        $path = 'assets/frontend/img/testimonial/testimonial_section/';
             @unlink($path.$table->image);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }

    /**
     * Social area
     */
    public function socialStore (Request $request){
        $this->validate($request,[
            'icon'=>'nullable|string',
            'link'=>'nullable|string',
        ]);
        $table = new $this->social;
        $table->name = $request->name;
        $table->icon = $request->icon;
        $table->link = $request->link;
        $table->status = $request->status;
        $table->color = $request->color;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function socialUpdate(Request $request,$id){
        $this->validate($request,[
            'icon'=>'nullable|string',
            'link'=>'nullable|string',
        ]);
        $table =  $this->social->findOrFail($id);
        $table->name = $request->name;
        $table->icon = $request->icon;
        $table->link = $request->link;
        $table->status = $request->status;
        $table->color = $request->color;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function socialDelete($id){
        $this->social->findOrFail($id)->delete();
        return redirect()->back()->with('success','Successful delete');
    }
}
