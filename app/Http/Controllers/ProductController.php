<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select([
            'b.id',
            'b.name',
            'b.price',
            'b.maker',
            'b.size',
            'b.detail',
            'b.user_id',
            'u.name as user_name',
            'r.str as category',
            ])
            ->from('products as b')
            ->join('categories as r', function($join) {
            $join->on('b.category', '=', 'r.id');
            })
            ->join('users as u',function($join){
                $join->on('b.user_id','=','u.id');
            })
            ->orderBy('b.id', 'DESC')
            ->paginate(5);
            if(isset(\Auth::user()->name)){
                return view('index',compact('products'))
                    ->with('page_id',request()->page)
                    ->with('i', (request()->input('page', 1) - 1) * 5)
                    ->with('user_name',\Auth::user()->name);
            }else{
                return view('index',compact('products'))
                    ->with('page_id',request()->page)
                    ->with('i', (request()->input('page', 1) - 1) * 5);
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('create')->with('categories',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:20',
            'price'=>'required|integer',
            'maker'=>'required|max:20',
            'category'=>'required|integer',
            'detail'=>'required|max:140',
        ]);
        $product = new Product;
        $product->name = $request->input(["name"]);
        $product->price = $request->input(["price"]);
        $product->maker = $request->input(["maker"]);
        $product->size = $request->input(["size"]);
        $product->category = $request->input(["category"]);
        $product->detail = $request->input(["detail"]);
        $product->user_id = \Auth::user()->id;
        $product->save();

        return redirect()->route('products.index')
        ->with('success','新規登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        return view('show',compact('product'))
        ->with('page_id',request()->page_id)
        ->with('categories',$categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('edit',compact('product'))
        ->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|max:20',
            'price'=>'required|integer',
            'maker'=>'required|max:20',
            'category'=>'required|integer',
            'detail'=>'required|max:140',
        ]);

        $product->name = $request->input(["name"]);
        $product->price = $request->input(["price"]);
        $product->maker = $request->input(["maker"]);
        $product->size = $request->input(["size"]);
        $product->category = $request->input(["category"]);
        $product->detail = $request->input(["detail"]);
        $product->user_id = \Auth::user()->id;
        $product->save();

        return redirect()->route('products.index') 
        ->with('success','内容を変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success','商品'.$product->name.'を削除しました');
    }
}
