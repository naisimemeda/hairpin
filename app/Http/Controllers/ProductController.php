<?php

namespace App\Http\Controllers;

use  App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () use ($skus, $request){
            $product = new Product([
               'table' => $request->input('table'),
               'description' => $request->input('description'),
               'image' => $request->input('image'),
               'explain' => $request->input('explain'),
                //取商品sku 金额最小的值
               'price' => $this->SkuMinPrice($skus),
            ]);
            //获取当前登陆商家
            $shop = Shop::ShopInfo();
            //关联商家
            $product->shop()->associate($shop->id);
            $product->save();
            //循环添加商品sku
            foreach ($skus as $sku) {
                $skus = new ProductSku([
                    'title' => $sku['title'],
                    'description' => $sku['description'],
                    'price' => $sku['price'],
                ]);
                $skus->product()->associate($product->id);
                $skus->save();
            }
        });
        return $this->setStatusCode(201)->success('成功');
    }

    public function show(Product $product, Request $request){
        $product = Product::with(['Skus'])->find($product->id);
        return $this->setStatusCode(201)->success($product);
    }

    public function update(Product $product, Request $request){
        DB::transaction(function () use ($product, $request){
            $skus = $request->input('skus');
            $request->price = $this->SkuMinPrice($skus);
            $product->update($request->only([
                'table', 'description', 'image', 'price', 'explain'
            ]));
            //过滤空的 sku_id
            $SkuId = array_filter(Arr::pluck($skus, 'id'));
            //删除没有提交的sku
            ProductSku::query()->where('product_id', $product->id)->whereNotIn('id', $SkuId)->delete();
            foreach ($skus as $sku){
                //如果有id 就更新, 没有就新增
                if(isset($sku['id'])){
                    $productSku = ProductSku::find($sku['id']);
                    $productSku->update([
                        'title' => $sku['title'],
                        'description' => $sku['description'],
                        'price' => $sku['price'],
                    ]);
                }else{
                    $skus = new ProductSku([
                        'title' => $sku['title'],
                        'description' => $sku['description'],
                        'stock' => $sku['stock'],
                        'price' => $sku['price'],
                    ]);
                    $skus->product()->associate($product->id);
                    $skus->save();
                }
            }
        });
        return $this->setStatusCode(201)->success('成功');
    }

    public function SkuMinPrice($skus){
        return collect($skus)->min('price') ?: 0;
    }
}
