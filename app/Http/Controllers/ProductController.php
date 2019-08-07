<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request){
        $builder = Product::query()->where('on_sale', true);
        if ($search = $request->input('search', '')){
            $like = '%'.$search.'%';
            $builder->where(function ($query) use ($like){
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like){
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }
        if ($order = $request->input('order', '')) {
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }
        $products = $builder->paginate(16);
        return $this->setStatusCode(201)->success([
            'products' => $products
        ]);
    }


    public function store(ProductRequest $request){
        //获取商品全部sku
        $skus = $request->input('skus');
        $product = new Product([
           'table' => $request->input('table'),
           'description' =>$request->input('description'),
           'image' => $request->input('image'),
            //取商品sku 金额最小的值
           'price' => collect($skus)->min('price') ?: 0,
        ]);
        //获取当前登陆商家
        $shop = Shop::ShopInfo();
        //关联商家
        $product->shop()->associate($shop->id);
        $product->save();
        //循环添加商品sku
        foreach ($skus as $sks) {
            $skus = new ProductSku([
                'title' => $sks['title'],
                'description' => $sks['description'],
                'stock' => $sks['stock'],
                'price' => $sks['price'],
            ]);
            $skus->product()->associate($product->id);
            $skus->save();
        }
    }
}
