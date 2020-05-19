<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    public function mainCategoryList()
    {
        $category = Categories::where('parent_id','=',null)->get();
        return view('admin.category.main_category_list',compact('category'));
    }

    public function mainCategoryAddForm()
    {
        return view('admin.category.add_new_main_category');
    }

    public function mainCategoryInsertForm(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $image_name = null;
        if($request->hasfile('image'))
        {
           
            $path = base_path().'/public/images/category/main_category';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/main_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/main_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/main_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);
        }

        $category = Categories::create([
            'name'=>$request->input('name'),
            'image'=>$image_name,
            'slug' => Str::slug($request->input('name'), '-'),
        ]);

        if ($category) {
            return redirect()->back()->with('message','Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
        
    }

    public function mainCategoryStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Categories::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }

    public function mainCategoryEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Categories::where('id',$id)->first();
        return view('admin.category.add_new_main_category',compact('category'));
    }

    public function mainCategoryUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $image_name = null;
        if($request->hasfile('image'))
        {
            $cat_prev_image = Categories::where('id',$id)->first();

            $path = base_path().'/public/images/category/main_category';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/main_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/main_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/main_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = base_path().'/public/images/category/main_category/'.$cat_prev_image->image;
            $prev_img_delete_path_thumb = base_path().'/public/images/category/main_category/thumb/'.$cat_prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

            Categories::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'image'=>$image_name,
                'slug' => Str::slug($request->input('name'), '-'),
            ]);

            return redirect()->back()->with('message','Category Updated Successfully');
        }else{
            Categories::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'slug' => Str::slug($request->input('name'), '-'),
            ]);
            return redirect()->back()->with('message','Category Updated Successfully');
        }
    }

    public function subCategoryList()
    {
        $sub_category = Categories::where('parent_id','!=',null)->get();

        return view('admin.category.sub_category_list',compact('sub_category'));
    }

    public function subCategoryAddForm()
    {
        $category = Categories::where('parent_id','=',null)->pluck('name', 'id');
        return view('admin.category.add_new_sub_category',compact('category'));
    }

    public function subCategoryInsertForm(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $image_name = null;
        if($request->hasfile('image'))
        {
           
            $path = base_path().'/public/images/category/sub_category';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/sub_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/sub_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/sub_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);
        }

        $sub_category = Categories::create([
            'name'=>$request->input('name'),
            'image'=>$image_name,
            'parent_id'=>$request->input('category'),
            'slug' => Str::slug($request->input('name'), '-'),
        ]);

        if ($sub_category) {
            return redirect()->back()->with('message','Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function subCategoryEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Categories::where('parent_id','=',null)->pluck('name', 'id');
        $sub_category = Categories::where('id',$id)->first();
        return view('admin.category.add_new_sub_category',compact('sub_category','category'));
    }

    public function subCategoryUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $image_name = null;
        if($request->hasfile('image'))
        {
            $cat_prev_image = Categories::where('id',$id)->first();

            $path = base_path().'/public/images/category/sub_category';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/sub_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/sub_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/sub_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = base_path().'/public/images/category/sub_category/'.$cat_prev_image->image;
            $prev_img_delete_path_thumb = base_path().'/public/images/category/sub_category/thumb/'.$cat_prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

            Categories::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'image'=>$image_name,
                'parent_id' => $request->input('category'),
                'slug' => Str::slug($request->input('name'), '-'),
            ]);

            return redirect()->back()->with('message','Sub Category Updated Successfully');
        }else{
            Categories::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'parent_id' => $request->input('category'),
                'slug' => Str::slug($request->input('name'), '-'),
            ]);
            return redirect()->back()->with('message','Sub Category Updated Successfully');
        }
    }

    public function subCategoryListWithCategory($category_id)
    {
        $sub_category = Categories::where('parent_id',$category_id)->where('status',1)->get();
        return $sub_category;
    }
}
