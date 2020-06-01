<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductSpecification;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::truncate();
        // ProductImage::truncate();
        // ProductSize::truncate();
        // ProductSpecification::truncate();
        $faker = Faker::create();
        for ($i=0; $i < 30; $i++) { 
            $name = $faker->name;
            $main_category = rand(1,2);
            if ($main_category == '1') {
                $sub_category = rand(3,4);
                $brand = rand(1,2);
            }else{
                $sub_category = rand(5,6);
                $brand = rand(3,4);
            }
            $product = Product::create([
                'name'=> $name,
                'slug'=>Str::slug($name, '-'),
                'category_id'=>$main_category,
                'sub_category_id'=>$sub_category,
                'brand_id'=>$brand,
                'short_description'=>$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                'long_description'=>$faker->paragraph($nbSentences = 15, $variableNbSentences = true),
            ]);

            if ($product) {
                $image_flag = true;
                for ($j=0; $j < rand(2,6); $j++) {
                    $image = $faker->image('public/images/products/thumb/',300,400, null, false);
                    if ($image_flag) {
                        $banner = $image;
                        $image_flag=false;
                    }
                    ProductImage::create([
                        'image' => $image,
                        'product_id' => $product->id,
                    ]);
                }
                Product::where('id', $product->id)->update([
                    'main_image' => $banner
                ]);

                for ($k=0; $k < rand(1,5); $k++) { 
                    $mrp = rand(900,2000);
                    $customer_price = rand(100,$mrp);
                    $retailer_price = rand(50,$mrp);

                    ProductSize::create([
                        'name' => strtoupper(Str::random(rand(2,4))),
                        'product_id' => $product->id,
                        'mrp' => $mrp,
                        'customer_price' => $customer_price,                        
                        'customer_discount' => rand(10,50),
                        'retailer_price' => $retailer_price,
                        'retailer_discount' => rand(10,60),
                        'min_ord_quantity' => rand(5,15),
                        'stock' => rand(10,100),
                    ]);
                }

                for ($l=0; $l < rand(2,8) ; $l++) { 
                    ProductSpecification::create([                        
                        'product_id' => $product->id,
                        'name' => $faker->name,
                        'value' => $faker->name,
                    ]);
                }

            }
    
        }
    }
}
