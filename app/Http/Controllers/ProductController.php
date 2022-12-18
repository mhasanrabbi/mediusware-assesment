<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('product_variant_prices')->orderby('id', 'ASC')->paginate(3);
        // $variants = Variant::with('productVariants')->get();
        // $productVariants = ProductVariant::with('variants')->first();
        $productVariants = ProductVariant::with('variants')->get()->unique('variant')->values();
        $variants = Variant::with('productVariants')->get();
        // dd($variants);

        // foreach ($variants as $type) {
        //     // echo $type;
        //     return $type;
        //     foreach ($type as $product) {
        //         // dd($product);
        //         return $product;
        //         foreach ($product as $variant) {
        //             dd($variant);
        //         }
        //     }
        // }
        // dd($variantTitle);
        // dd($ids);
        // $variantTitle =
        // dd($productVariants);
        // dd($variants->id);
        // foreach ($variants as $type) {
        //     $variant = $type->productVariants;

        //     foreach ($variant as $product) {
        //         // dd($product->variant);
        //     }
        // }
        // foreach ($productVariants as $item) {
        //     dd($item->variants->title->unique('id')->values());
        // }

        // $variants = $productVariants->groupBy('variant_id');

        // dd($variants->productVariants);
        return view('products.index', compact('products', 'productVariants', 'variants'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


    public function filter(Request $request)
    {
        $title = $request->title;
        $min_price = $request->price_from;
        $max_price = $request->price_to;
        $date = $request->date;
        $variant = $request->variant;
        // dd($variant);

        // $products = Product::with('product_variant_prices')->get();
        // $productVariants = ProductVariant::with('variants')->get();

        // $images = Images::when(!is_null($approved), function ($query) use ($approved) {
        //     return $query->where('approved', $approved);
        // })->when(!is_null($featured), function ($query) use ($featured) {
        //     return $query->where('featured', $featured);
        // })->latest()->get();

        // $products = $products->when(!is_null($title), function ($query) use ($title) {
        //     return $query->where('title', 'LIKE', '%' . $title . '%');
        // })->when(!is_null($variant), function ($query) use ($variant) {
        //     return $query->where('variant', $variant);
        // })->paginate(10);


        //     if ((isset($min_price) && isset($max_price)) || $title) {
        //         $query->where('title', 'LIKE', '%' . $title . '%')->where('price', '>=', $min_price)->where('price', '<=', $max_price);
        //     }
        // })->paginate(10);

        // if (($min_price && $max_price) || $title || $date) {
        //     $products = $products->where('title', 'LIKE', '%' . $title . '%')
        //         ->where('product_variant_prices', '>=', $min_price)->where('product_variant_prices', '<=', $max_price)->get();
        // }

        $productVariants = ProductVariant::with('variants')->get()->unique('variant')->values();
        $products = Product::where('title', 'like', "%" . $request->title . "%")->paginate(10);
        return view('products.index', compact('products', 'productVariants'));
    }
}