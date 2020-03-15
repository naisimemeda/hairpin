<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    /**
     * 添加商品分类
     * @param ProductCategoryRequest $request
     * @return mixed
     */
    public function store(ProductCategoryRequest $request){
        ProductCategory::query()->create([
            'name' => $request->input('name'),
            'shop_id' => Shop::ShopInfo()->id
        ]);

        return $this->setStatusCode(201)->success('成功');
    }

    /**
     * 分类列表
     * @param Request $request
     * @return mixed
     */
    public function CategoryList(Request $request){
        $pageSize = $request->input('pageSize') ?: 16;
        $page = $pageSize * ($request->input('page') - 1);

        $category = ProductCategory::query()->where('shop_id', Shop::ShopInfo()->id);

        $result =  $this->result($category);

        return $this->setStatusCode(201)->success($result);
    }

    public function CategoryProduct(Request $request){
        $category =  ProductCategory::with(['product:id,table,category_id'])->where('shop_id', Shop::ShopInfo()->id)->get();
        return $this->setStatusCode(201)->success($category);
    }
}
