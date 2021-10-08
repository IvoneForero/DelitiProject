<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Inertia\Inertia;

class ProductsController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = products::join('category_prods','products.id_prod_category','category_prods.id')
        ->select('products.name as product', 'products.description', 'price', 'products.state', 'picture', 'category_prods.name as category')
        ->get();
        return Inertia::render('Producto',['consulta'=>$reg]);
    }

    public function index2(Request $request)
    {
        $reg = products::join('category_prods','products.id_prod_category','category_prods.id')
        ->select('products.id as id','products.name as product', 'products.description', 'price', 'products.state', 'picture', 'category_prods.id as id_category', 'category_prods.name as category')
        ->get();
        return ['consulta'=>$reg];
    }

    public function getData(Request $request)
    {
        $reg = products::select('id','name','price')->get();
        return ['consulta'=>$reg];
    }

    public function store(Request $request)
    {
        $reg = new products;
        $reg->name = $request->name;
        $reg->description = $request->description;
        $reg->id_prod_category = $request->id_prod_category;
        $reg->price = $request->price;
        $reg->state = $request->state;
        $reg->picture = $request->picture;
        $reg->save();
    }

    public function update(Request $request)
    {
        $reg = products::find($request->id);
        $reg->name = $request->name;
        $reg->description = $request->description;
        $reg->id_prod_category = $request->id_prod_category;
        $reg->price = $request->price;
        $reg->state = $request->state;
        $reg->picture = $request->picture;
        $reg->save();
    }  

    public function destroy(Request $request)
    {
        $reg = products::findOrFail($request->id);
        $reg->delete();
    }
}
