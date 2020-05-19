<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductSpecification;
use App\Models\Brand;
use DataTables;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function AddForm()
    {
        $category = Categories::where('parent_id','=',null)->where('status',1)->get();
        return view('admin.product.product_add_form',compact('category'));
    }

    public function insertProduct(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'brand' => 'required',
        ]);

        $name = $request->input('name');
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $slug = Str::slug($request->input('name'), '-');
        $brand = $request->input('brand');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');

        
        $size = $request->input('size'); // array of size Name
        $mrp = $request->input('mrp'); // array of MRP
        $customer_price = $request->input('customer_price'); // Array 
        $retailer_price = $request->input('retailer_price'); //Array
        $customer_discount = $request->input('customer_discount'); //Array
        $retailer_discount = $request->input('retailer_discount'); //Array
        $min_order_quantity = $request->input('min_order_quantity'); //Array
        $stock = $request->input('stock'); //Array

        $specification_name = $request->input('specification_name'); // array 
        $specification_details = $request->input('specification_details'); // array 



        $product = Product::create([
            'name'=>$name,
            'slug'=>$slug,
            'category_id'=>$category,
            'sub_category_id'=>$sub_category,
            'brand_id'=>$brand,
            'short_description'=>$short_description,
            'long_description'=>$long_description,
        ]);

        if ($product) {
            /** Images Upload **/
            $path = base_path().'/public/images/products/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/products/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);
            $banner = null;
            if ($request->hasFile('image')) {              
                for ($i=0; $i < count($request->file('image')); $i++) {                     
                    $image = $request->file('image')[$i];  
                    $image_name = $i.time().date('Y-M-d').'.'.$image->getClientOriginalExtension();
                    if ($i == 0){
                        $banner = $image_name;
                    }

                    //Product Original Image
                    $destinationPath =base_path().'/public/images/products';
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath.'/'.$image_name);

                    //Product Thumbnail
                    $destination = base_path().'/public/images/products/thumb';
                    $img = Image::make($image->getRealPath());
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination.'/'.$image_name);
                 
                    

                    ProductImage::create([
                        'image' => $image_name,
                        'product_id' => $product->id,
                    ]);
                }
                Product::where('id', $product->id)->update([
                    'main_image' => $banner
                ]);
            }

            if (isset($size) && !empty($size)) {
                
                for ($i=0; $i < count($size); $i++) { 

                    $p_size = isset($size[$i]) ? $size[$i] : null;
                    $p_mrp = isset($mrp[$i]) ? $mrp[$i] : null;
                    $p_customer_price = isset($customer_price[$i]) ? $customer_price[$i] : null;
                    $p_retailer_price = isset($retailer_price[$i]) ? $retailer_price[$i] : null;
                    $p_customer_discount = isset($customer_discount[$i]) ? $customer_discount[$i] : null;
                    $p_retailer_discount = isset($retailer_discount[$i]) ? $retailer_discount[$i] : null;
                    $p_min_order_quantity = isset($min_order_quantity[$i]) ? $min_order_quantity[$i] : null;
                    $p_stock = isset($stock[$i]) ? $stock[$i] : null;

                    ProductSize::create([
                        'name' => $p_size,
                        'product_id' => $product->id,
                        'mrp' => $p_mrp,
                        'customer_price' => $p_customer_price,                        
                        'customer_discount' => $p_customer_discount,
                        'retailer_price' => $p_retailer_price,
                        'retailer_discount' => $p_retailer_discount,
                        'min_ord_quantity' => $p_min_order_quantity,
                        'stock' => $p_stock,
                    ]);

                }
            }

            if (isset($specification_name) && !empty($specification_name)) {
                for ($i=0; $i < count($specification_name); $i++) { 
                    $p_specification_name = isset($specification_name[$i]) ? $specification_name[$i] : null;
                    $p_specification_details = isset($specification_details[$i]) ? $specification_details[$i] : null;

                    ProductSpecification::create([                        
                        'product_id' => $product->id,
                        'name' => $p_specification_name,
                        'value' => $p_specification_details,
                    ]);

                }
            }

            // return redirect()->back()->with('message','Product Added Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
        
    }

    public function productList()
    {
        return view('admin.product.product_list');
    }

    public function productListAjax(Request $request)
    {
        $query = Product::get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.product_view',['id'=>$row->id]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                <a href="'.route('admin.product_edit',['id'=>$row->id]).'" class="btn btn-warning btn-sm" target="_blank">Edit</a>
                <a href="'.route('admin.product_edit_sizes',['product_id'=>$row->id]).'" class="btn btn-warning btn-sm" target="_blank">Edit Sizes</a>  
                <a href="'.route('admin.product_edit_specifications',['product_id'=>$row->id]).'" class="btn btn-warning btn-sm" target="_blank">Edit Specifications</a>                
                <a href="'.route('admin.product_edit_images',['product_id'=>$row->id]).'" class="btn btn-warning btn-sm" target="_blank">Edit Images</a>';
                if ($row->status == '1') {
                    $btn .='<a href="'.route('admin.product_status_update',['id'=>$row->id,'status'=>'2']).'" class="btn btn-danger btn-sm" >Disable</a>';
                } else {
                    $btn .='<a href="'.route('admin.product_status_update',['id'=>$row->id,'status'=>'1']).'" class="btn btn-primary btn-sm" >Enable</a>';
                }
                
                return $btn;
            })->addColumn('category', function($row){
                if (isset($row->category->name)) {
                    return $row->category->name;
                } else {
                    return null;
                }
            })->addColumn('sub_category', function($row){
                if (isset($row->subCategory->name)) {
                    return $row->subCategory->name;
                } else {
                    return null;
                }
            })->addColumn('brand', function($row){
                if (isset($row->brand->name)) {
                    return $row->brand->name;
                } else {
                    return null;
                }
            })->addColumn('stock', function($row){
                if (isset($row->sizes) && !empty($row->sizes)) {
                    $size_data = '';
                    foreach ($row->sizes as $size) {
                        $size_data.= $size->name." - ".$size->stock.",";
                    }
                    return $size_data;
                } else {
                    return null;
                }
            })->addColumn('status_tab', function($row){
                if ($row->status == 1){
                    return '<a class="btn btn-primary btn-sm" target="_blank">Enabled</a>';
                } else {
                    return '<a class="btn btn-danger btn-sm" target="_blank">Disabled</a>';
                }
            })
            ->rawColumns(['action','category','sub_category','brand','stock','status_tab'])
            ->make(true);
    }

    public function productView($id)
    {
        $product = Product::where('id',$id)->first();
        return view('admin.product.product_details',compact('product'));
    }

    public function productEdit($id)
    {
        $product = Product::where('id',$id)->first();
        $category = Categories::where('parent_id','=',null)->where('status',1)->get();
        $sub_category = null;
        $brand = null;
        if ($product) {
            $sub_category =  Categories::where('parent_id',$product->category_id)->where('status',1)->get();
            $brand =  Brand::where('category_id',$product->category_id)->where('status',1)->get();
        }
        return view('admin.product.product_edit',compact('product','category','sub_category','brand'));
    }

    public function productUpdate(Request $request)
    {
        $this->validate($request, [
            'p_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'brand' => 'required',
        ]);

        $id = $request->input('p_id');
        $name = $request->input('name');
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $slug = Str::slug($request->input('name'), '-');
        $brand = $request->input('brand');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');

        $product = Product::where('id',$id)->update([
            'name'=>$name,
            'slug'=>$slug,
            'category_id'=>$category,
            'sub_category_id'=>$sub_category,
            'brand_id'=>$brand,
            'short_description'=>$short_description,
            'long_description'=>$long_description,
        ]);

        if ($product) {
            return redirect()->back()->with('message','Product Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }

    }

    public function editSizes($product_id)
    {
        $product = Product::where('id',$product_id)->first();
        return view('admin.product.edit_size',compact('product'));
    }

    public function addNewSize(Request $request)
    {
        $product_id = $request->input('product_id');
        $size = $request->input('size'); // array of size Name
        $mrp = $request->input('mrp'); // array of MRP
        $customer_price = $request->input('customer_price'); // Array 
        $retailer_price = $request->input('retailer_price'); //Array
        $customer_discount = $request->input('customer_discount'); //Array
        $retailer_discount = $request->input('retailer_discount'); //Array
        $min_order_quantity = $request->input('min_order_quantity'); //Array
        $stock = $request->input('stock'); //Array

        if (isset($size) && !empty($size) && !empty($product_id)) {
                
            for ($i=0; $i < count($size); $i++) { 

                $p_size = isset($size[$i]) ? $size[$i] : null;
                $p_mrp = isset($mrp[$i]) ? $mrp[$i] : null;
                $p_customer_price = isset($customer_price[$i]) ? $customer_price[$i] : null;
                $p_retailer_price = isset($retailer_price[$i]) ? $retailer_price[$i] : null;
                $p_customer_discount = isset($customer_discount[$i]) ? $customer_discount[$i] : null;
                $p_retailer_discount = isset($retailer_discount[$i]) ? $retailer_discount[$i] : null;
                $p_min_order_quantity = isset($min_order_quantity[$i]) ? $min_order_quantity[$i] : null;
                $p_stock = isset($stock[$i]) ? $stock[$i] : null;

                ProductSize::create([
                    'name' => $p_size,
                    'product_id' => $product_id,
                    'mrp' => $p_mrp,
                    'customer_price' => $p_customer_price,                        
                    'customer_discount' => $p_customer_discount,
                    'retailer_price' => $p_retailer_price,
                    'retailer_discount' => $p_retailer_discount,
                    'min_ord_quantity' => $p_min_order_quantity,
                    'stock' => $p_stock,
                ]);

            }
        }
        return redirect()->back();
    }

    public function updateSize(Request $request)
    {
        $size_id = $request->input('size_id');// array of size ids
        $size = $request->input('size'); // array of size Name
        $mrp = $request->input('mrp'); // array of MRP
        $customer_price = $request->input('customer_price'); // Array 
        $retailer_price = $request->input('retailer_price'); //Array
        $customer_discount = $request->input('customer_discount'); //Array
        $retailer_discount = $request->input('retailer_discount'); //Array
        $min_order_quantity = $request->input('min_order_quantity'); //Array
        $stock = $request->input('stock'); //Array

        if (isset($size_id) && !empty($size_id)) {
                
            for ($i=0; $i < count($size_id); $i++) { 

                $p_size = isset($size[$i]) ? $size[$i] : null;
                $p_mrp = isset($mrp[$i]) ? $mrp[$i] : null;
                $p_customer_price = isset($customer_price[$i]) ? $customer_price[$i] : null;
                $p_retailer_price = isset($retailer_price[$i]) ? $retailer_price[$i] : null;
                $p_customer_discount = isset($customer_discount[$i]) ? $customer_discount[$i] : null;
                $p_retailer_discount = isset($retailer_discount[$i]) ? $retailer_discount[$i] : null;
                $p_min_order_quantity = isset($min_order_quantity[$i]) ? $min_order_quantity[$i] : null;
                $p_stock = isset($stock[$i]) ? $stock[$i] : null;

                if (isset($size_id[$i]) && !empty($size_id[$i])) {
                    ProductSize::where('id',$size_id[$i])->update([
                        'name' => $p_size,
                        'mrp' => $p_mrp,
                        'customer_price' => $p_customer_price,                        
                        'customer_discount' => $p_customer_discount,
                        'retailer_price' => $p_retailer_price,
                        'retailer_discount' => $p_retailer_discount,
                        'min_ord_quantity' => $p_min_order_quantity,
                        'stock' => $p_stock,
                    ]);
                }

            }
        }
        return redirect()->back();
    }

    public function editSpecifications($product_id)
    {
        $product = Product::where('id',$product_id)->first();
        return view('admin.product.edit_specifications',compact('product'));
    }

    public function addNewSpecification(Request $request)
    {
        $product_id = $request->input('product_id');
        $specification_name = $request->input('specification_name'); // array 
        $specification_details = $request->input('specification_details'); // array 

        if (isset($specification_name) && !empty($specification_name)) {
            for ($i=0; $i < count($specification_name); $i++) { 
                $p_specification_name = isset($specification_name[$i]) ? $specification_name[$i] : null;
                $p_specification_details = isset($specification_details[$i]) ? $specification_details[$i] : null;
                
                ProductSpecification::create([                        
                    'product_id' => $product_id,
                    'name' => $p_specification_name,
                    'value' => $p_specification_details,
                ]);

            }
        }
        return redirect()->back();
    }

    public function updateSpecification(Request $request)
    {
        $sp_id = $request->input('sp_id'); //array
        $specification_name = $request->input('specification_name'); // array 
        $specification_details = $request->input('specification_details'); // array 

        if (isset($sp_id) && !empty($sp_id)) {
            for ($i=0; $i < count($sp_id); $i++) { 
                $p_specification_name = isset($specification_name[$i]) ? $specification_name[$i] : null;
                $p_specification_details = isset($specification_details[$i]) ? $specification_details[$i] : null;
                if (isset($sp_id[$i]) && !empty($sp_id[$i])) {
                    ProductSpecification::where('id',$sp_id[$i])->update([
                        'name' => $p_specification_name,
                        'value' => $p_specification_details,
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    public function deleteSpecification($sp_id)
    {
        ProductSpecification::where('id',$sp_id)->delete();
        return redirect()->back();
    }

    public function editImages($product_id)
    {
        $product = Product::where('id',$product_id)->first();
        return view('admin.product.product_image',compact('product'));
    }
    
    public function makeCoverImage($image_id)
    {
        $image = ProductImage::where('id',$image_id)->first();
        if ($image) {
            Product::where('id',$image->product_id)->update([
                'main_image' => $image->image,
            ]);
        }
        return redirect()->back();
    }
    
    public function deleteImage($image_id)
    {
        $image = ProductImage::where('id',$image_id)->first();
        if ($image) {
            $path = base_path().'/public/images/products/'.$image->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $path_thumb = base_path().'/public/images/products/thumb/'.$image->image;
            if ( File::exists($path_thumb)) {
                File::delete($path_thumb);
            }
        }
        ProductImage::where('id',$image_id)->delete();
        return redirect()->back();
    }

    public function addNewImages(Request $request)
    {
        $path = base_path().'/public/images/products/';
        File::exists($path) or File::makeDirectory($path, 0777, true, true);
        $path_thumb = base_path().'/public/images/products/thumb/';
        File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        $product_id = $request->input('p_id');

        if ($request->hasFile('image')) {              
            for ($i=0; $i < count($request->file('image')); $i++) {                     
                $image = $request->file('image')[$i];  
                $image_name = $i.time().date('Y-M-d').'.'.$image->getClientOriginalExtension();

                //Product Original Image
                $destinationPath =base_path().'/public/images/products';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath.'/'.$image_name);

                //Product Thumbnail
                $destination = base_path().'/public/images/products/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$image_name); 

                ProductImage::create([
                    'image' => $image_name,
                    'product_id' => $product_id,
                ]);
            }
        }
        return redirect()->back();
    }

    public function productStatusUpdate($id,$status)
    {
        Product::where('id',$id)->update([
            'status' => $status,
        ]);
        return redirect()->back();
    }
}
