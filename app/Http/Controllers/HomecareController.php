<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\VariantResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VariantCollection;
use App\Http\Resources\CategoryCollection;

class HomecareController extends Controller
{

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
    
    public function getCategories()
    {
        return new CategoryCollection(Category::get());
    }

    public function getBrands(Category $category)
    {
        $brands = $category->brand;
        return new BrandCollection($brands);
    }

    public function getVariants(Brand $brand)
    {
        $variants = $brand->variant;
        return new VariantCollection($variants);
    }
}


