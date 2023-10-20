<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = category::get();
        return CategoryIndexResource::collection($categories);


    }

    public function products($slug){
        $category = category::where('slug', $slug)->with(['products'])->first();
//        $product = $category->products;

//        dd($category);
        return CategoryIndexResource::make($category);
    }
}
