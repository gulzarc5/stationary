<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function brandList()
    {
        $brands = Brand::get();
        return view('admin.brand.brand_list',compact('brands'));
    }
    public function AddForm()
    {
        $category = Categories::where('parent_id','=',null)->pluck('name', 'id');
        return view('admin.brand.add_new_brand',compact('category'));
    }

    public function BrandInsertForm(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
        ]);

        $brand = Brand::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'category_id' => $request->input('category'),
        ]);

        if ($brand) {
            return redirect()->back()->with('message','Brand Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function brandStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        Brand::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }

    public function brandEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $brand = Brand::where('id',$id)->first();
        $category = Categories::where('parent_id','=',null)->pluck('name', 'id');
        return view('admin.brand.add_new_brand',compact('brand','category'));
    }

    public function brandUpdate(request $request,$id)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
        ]);

        $brand = Brand::where('id',$id)->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'category_id' => $request->input('category'),
        ]);

        if ($brand) {
            return redirect()->back()->with('message','Brand Updated Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function brandListWithCategory($category_id)
    {
        $brand = Brand::where('category_id',$category_id)->where('status',1)->get();
        return $brand;
    }
}
