<?php

namespace App\Http\Controllers;

use App\Category;
use App\product;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9; /*max products op shop pagina*/
        $categories = Category::all(); /*get alle categories van db*/

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category); /*als item meer dan 1 categorie heeft geef het item weer in meedere categories*/
            });

            $categoryName = optional($categories->where('slug', request()->category)->first())->name;

        } else {
            $products = Product::where('featured', true);
            $categoryName = 'COLLECTION'; /*naam als geen category is active*/
        }

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
            /*order by prijs*/
        }
        elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } /*order by prijs*/
        else {
            $products = $products->paginate($pagination);
        } /*order random*/

        return view('layout.shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        /*eroror als product niet bestaat*/

        return view('layout.product')->with('product', $product);

    }
}
