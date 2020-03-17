<?php

namespace App\Http\Controllers\Backend\Admin;


use App\Model\BlogCategory;
use App\Model\BlogPost;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use File;
use App\Http\Controllers\Controller;
class PostController extends Controller
{
    public function category()
    {
        $data['page_title'] = 'Blog Category';
        $data['events'] = BlogCategory::latest()->get();
        return view('backend.admin.blog.post-category', $data);
    }
    public function UpdateCategory(Request $request)
    {
        $macCount = BlogCategory::where('name', $request->name)->where('id', '!=', $request->id)->count();
        if ($macCount > 0) {
            $notification = array('message' => 'This one Already Exist', 'alert-type' => 'error');
            return back()->with($notification);
        }
        if ($request->id == 0) {
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            $res = BlogCategory::create($data);
            if ($res) {
                $notification = array('message' => 'Saved Successfully!', 'alert-type' => 'success');
                return back()->with($notification);
            } else {
                $notification = array('message' => 'Problem With Adding New Category!', 'alert-type' => 'error');
                return back()->with($notification);
            }
        } else {
            $mac = BlogCategory::findOrFail($request->id);
            $mac['name'] = $request->name;
            $mac['status'] = $request->status;
            $res = $mac->save();

            if ($res) {
                $notification = array('message' => 'Updated Successfully!', 'alert-type' => 'success');
                return back()->with($notification);
            } else {
                $notification = array('message' => 'Problem With Updating Category!', 'alert-type' => 'error');
                return back()->with($notification);
            }
        }
    }

    public function index()
    {
        $data['page_title'] = "All Blogs";
        $data['posts'] = BlogPost::latest()->paginate(15);
        return view('backend.admin.blog.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Add Blog';
        $data['category'] = BlogCategory::whereStatus(1)->get();
        return view('backend.admin.blog.add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000'
        ],
            [
                'title.required' => 'Post Title Must not be empty',
                'cat_id.required' => 'Category Must be selected',
            ]
        );

        $in = Input::except('_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'post_'.time().'.jpg';
            $location = 'assets/backend/image/blog/post/' . $filename;
            Image::make($image)->resize(700,350)->save($location);
            $in['image'] = $filename;
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'post_thumb'.time().'.jpg';
            $location = 'assets/backend/image/blog/post/' . $filename;
            Image::make($image)->resize(350,213)->save($location);
            $in['thumb'] = $filename;
        }


        $in['status'] =  $request->status == 'on' ? '1' : '0';
        $res = BlogPost::create($in);
        if ($res) {
            $notification = array('message' => 'Updated Successfully!', 'alert-type' => 'success');
            return back()->with($notification);
        } else {
            $notification = array('message' => 'Problem With Updating Post', 'alert-type' => 'error');
            return back()->with($notification);
        }

    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Blog';
        $data['post'] = BlogPost::findOrFail($id);
        $data['category'] = BlogCategory::whereStatus(1)->get();
        return view('backend.admin.blog.edit', $data);
    }
    public function updatePost(Request $request)
    {

        $data = BlogPost::find($request->id);
        $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
            'image' => 'nullable | mimes:jpeg,jpg,png | max:1000'
        ],
            [
                'title.required' => 'Post Title Must not be empty',
                'cat_id.required' => 'Category Must be selected',
                'details.required' => 'Post Details  must not be empty',
            ]
        );


        $in = Input::except('_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'post_'.time().'.jpg';
            $location = 'assets/backend/image/blog/post/' . $filename;
            Image::make($image)->resize(700,350)->save($location);
            $path = 'assets/backend/image/blog/post/';
            @unlink($path.$data->image);
            $in['image'] = $filename;
        }


        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'post_thumb'.time().'.jpg';
            $location = 'assets/backend/image/blog/post/' . $filename;
            Image::make($image)->resize(350,213)->save($location);

            $path = 'assets/backend/image/blog/post/';
            @unlink($path.$data->thumb);
            $in['thumb'] = $filename;
        }
        $in['status'] =  $request->status == 'on' ? '1' : '0';
        $res = $data->fill($in)->save();

        if ($res) {
            $notification = array('message' => 'Updated Successfully!', 'alert-type' => 'success');
            return back()->with($notification);
        } else {
            $notification = array('message' => 'Problem With Updating Post!', 'alert-type' => 'error');
            return back()->with($notification);
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $data = BlogPost::findOrFail($request->id);
        $path = 'assets/backend/image/blog/post/';
        @unlink($path.$data->image);
        @unlink($path.$data->thumb);
        $res =  $data->delete();

        if ($res) {
            $notification = array('message' => 'Post Delete Successfully!', 'alert-type' => 'success');
            return back()->with($notification);
        } else {
            $notification = array('message' => 'Problem With Deleting Post!', 'alert-type' => 'error');
            return back()->with($notification);
        }
    }
}
