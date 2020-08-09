<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Brand;
use Session;
use Auth;

class ProductController extends Controller
{
	public function list($slug,$category_id,$type)
	{
		Session::forget('product_category');
		Session::forget('product_type');		
		Session::forget('sort');
		if (!empty($category_id)) {
			Session::put('product_category', $category_id); 
		}
		if (!empty($type)) {
		Session::put('product_type', $type); 
		}

		$products = Product::where('status',1);
		//$type = 1 means main category else sub category
		if ($type == 1) {
		$products = $products->where('category_id',$category_id)->orderBy('id','desc')->paginate(12);
		} else {      
		$products = $products->where('sub_category_id',$category_id)->orderBy('id','desc')->paginate(12);
		}

		$category_name = Categories::where('id',$category_id)->first();
		$category_list = Categories::where('status',1)->whereNull('parent_id')->get();
		$brands = null;
		if ($type == 1) {
		$brands = Brand::where('category_id',$category_id)->where('status',1)->get();
		}else{
		$brands = Brand::where('category_id',$category_name->parent_id)->where('status',1)->get();
		}
		return view('web.product.shop-list',compact('products','category_name','category_list','brands'));
	}

	public function listAjax(Request $request)
	{
		$category = Session::get('product_category');   
		$product_type = Session::get('product_type');
		$sort = $request->input('sort');
		$brand = $request->input('brand');
		$chanel = $request->input('chanel');
		if (empty($sort) && $chanel != 1) {
			$sort = Session::get('sort');
		}else{
			Session::put('sort', $sort); 
		}
		if (empty($brand) && $chanel != 1) {
			$brand = Session::get('brand');
		}else{
			Session::put('brand', $brand); 
		}
		$products = Product::where('status',1);
		//$product_type = 1 means main category else sub category
		if ($product_type == 1) {
			$products = $products->where('category_id',$category);
		} else {
			$products = $products->where('sub_category_id',$category);
		}
		/*sort 1 = newest,	2 = A to Z,	3 = Z to A,	4 = High to Low,	5 = Low to high */
		if (!empty($sort)) {
			if ($sort == '1') {
				$products = $products->orderBy('id','desc');
			} elseif ($sort == '2') {
				$products = $products->orderBy('name','asc');
			}elseif ($sort == '3') {
				$products = $products->orderBy('name','desc');
			}elseif ($sort == '4') {
				$products = $products->orderBy('customer_min_price','desc');
			}else{
				$products = $products->orderBy('customer_min_price','asc');
			}
		}else{
			$products = $products->orderBy('id','desc');
		}

		if (!empty($brand)) {
			$products = $products ->where(function($q) use ($brand) {
				$brand_count = 1;
				foreach ($brand as $key => $b) {
					if ($brand_count == 1) {
						$q->where('brand_id',$b);
					}else{
						$q->orWhere('brand_id',$b);
					}                       
					$brand_count++;
				}
            });
		}
		$products = $products->paginate(12);
		return view('web.product.product_pagination_list_page',compact('products'));
	}

	public function productDetail($slug,$id)
	{
		$product = Product::where('id',$id)->first();
		$related_product = null;
		if ($product) {
			$related_product = Product::where('sub_category_id',$product->sub_category_id)->get();
		}
		return view('web.product.shop-detail',compact('product','related_product'));
	}

	public function getAddToCart(Request $request, $id){
		$product = Product::where('id',$id)->first();
        if(!$product) {
            abort(404);
		}
		$cart = session()->get('cart');
        //  if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "id" => $product->id,
                        "name" => $product->name,
                        "slug" => $product->slug,
                        "category_id" => $product->category_id,
						"quantity" => 1,
						"retailer_min_price" => $product->retailer_min_price,
                        "main_image" => $product->main_image,
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back();
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back();
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
			"id" => $product->id,
			"name" => $product->name,
			"slug" => $product->slug,
			"category_id" => $product->category_id,
			"quantity" => 1,
			"main_image" => $product->main_image,
        ];

        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if(($request->id) && ($request->quantity))
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
