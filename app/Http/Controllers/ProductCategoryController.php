<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
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
            'name' => $request->input('name')
        ]);

        return $this->setStatusCode(201)->success('成功');
    }

    /**
     * 分类列表
     * @param Request $request
     * @return mixed
     */
    public function CategoryList(Request $request){
        $category = ProductCategory::query()->get();
        return $this->setStatusCode(201)->success($category);
    }

    public function CategoryProduct(Request $request){
        $category =  ProductCategory::with(['product:id,table,category_id'])->get();
        return $this->setStatusCode(201)->success($category);
    }
}
