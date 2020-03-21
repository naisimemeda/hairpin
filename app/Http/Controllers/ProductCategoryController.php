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
            'name'   => $request->input('name'),
            'status' => $request->input('status'),
            'sort'   => $request->input('sort'),
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

        $category = ProductCategory::query()->withCount(['product'])->where('shop_id', Shop::ShopInfo()->id);

        $result =  $this->result($category);

        return $this->setStatusCode(201)->success($result);
    }


    public function update(ProductCategory $category, ProductCategoryRequest $request)
    {

        $category->update($request->only(['name', 'status', 'sort']));

        return $this->setStatusCode(201)->success('成功');

    }

    public function delete(ProductCategory $category)
    {

        $category->delete();
        return $this->setStatusCode(201)->success('成功');

    }
}
