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

    /**
     * 商品列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $builder = Product::query()->where('on_sale', true)->where('shop_id', Shop::ShopInfo()->id);

        if ($search = $request->input('search')) {
            $like = '%' . $search . '%';
            $builder->where(function ($query) use ($like) {
                $query->where('table', 'like', $like);
            });
        }

        $builder->withCount(['card']);

        $result = $this->result($builder);

        return $this->setStatusCode(201)->success($result);
    }


    /**
     * 添加商品
     * @param ProductRequest $request
     * @return mixed
     */
    public function store(ProductRequest $request)
    {
        DB::transaction(function () use ($request) {
            $product = new Product([
                'table' => $request->input('table'),
                'description' => $request->input('description'),
                'image' => $request->input('image'),
                'explain' => $request->input('explain'),
                //取商品sku 金额最小的值
                'price' => $request->input('price'),
                'on_sale' => true
            ]);
            //获取当前登陆商家
            $shop = Shop::ShopInfo();
            //关联商家
            $product->shop()->associate($shop->id);
            $product->category()->associate($request->input('category_id'));
            $product->save();
        });
        return $this->setStatusCode(201)->success('成功');
    }

    /**
     * 商品详情
     * @param Product $product
     * @param Request $request
     * @return mixed
     */
    public function show(Product $product, Request $request)
    {
        $product = Product::with(['card'])->find($product->id);
        return $this->setStatusCode(201)->success($product);
    }

    /**
     * 修改商品
     * @param Product $product
     * @param Request $request
     * @return mixed
     */
    public function update(Product $product, Request $request)
    {
        DB::transaction(function () use ($product, $request) {
            $product->update($request->only([
                'table', 'description', 'image', 'price', 'explain'
            ]));
        });
        return $this->setStatusCode(201)->success('成功');
    }
}
