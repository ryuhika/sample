<?php

namespace App\Http\Controllers;

use App\Models\Receive;
use App\Models\Product;
use App\Models\Client;
use App\Models\Condition;

use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receives = Receive::select([
            'r.id',
            'r.client_id',
            'r.product_id',
            'r.number',
            'r.condition',
            'r.user_id',
            'c.name as client_name',
            'p.name as product_name',
            'u.name as user_name',
            'g.name as condition',
            ])
            ->from('receives as r')
            ->join('clients as c', function($join) {
            $join->on('r.client_id', '=', 'c.id');
            })
            ->join('products as p', function($join) {
                $join->on('r.product_id', '=', 'p.id');
            })
            ->join('users as u', function($join) {
                $join->on('r.user_id', '=', 'u.id');
            })
            ->join('conditions as g', function($join) {
                $join->on('r.condition', '=', 'g.id');
            })
            ->orderBy('r.id', 'DESC')
            ->paginate(5);
        return view('receive.index',compact('receives'))
        ->with('user_name',\Auth::user()->name)
        ->with('page_id',request()->page)
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        return view('receive.create')
        ->with('products',$products)
        ->with('clients',$clients);
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
            'client_id' => 'required|integer',
            'product_id' => 'required|integer',
            'number' => 'required|integer|min:1|max:12',
            ]);
            $receive = new Receive;
            $receive->client_id = $request->input(["client_id"]);
            $receive->product_id = $request->input(["product_id"]);
            $receive->number = $request->input(["number"]);
            $receive->condition = 1;
            $receive->user_id = \Auth::user()->id;
            $receive->save();
            return redirect()->route('receives.index')
            ->with('success','受注登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function show(Receive $receive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(Receive $receive)
    {
        $products = Product::all();
        $clients = Client::all();
        $conditions = Condition::all();
        return view('receive.edit',compact('receive'))
        ->with('products',$products)
        ->with('conditions',$conditions)
        ->with('clients',$clients);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receive $receive)
    {
        $request->validate([
            'client_id' => 'required|integer',
            'product_id' => 'required|integer',
            'number' => 'required|integer|min:1|max:12',
            'condition_id'=>'required|integer',
            ]);
            $receive->client_id = $request->input(["client_id"]);
            $receive->product_id = $request->input(["product_id"]);
            $receive->number = $request->input(["number"]);
            $receive->condition = $request->input(["condition_id"]);
            $receive->user_id = \Auth::user()->id;
            $receive->save();
            
            return redirect()->route('receives.index')
            ->with('success','内容を変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receive $receive)
    {
        $receive->delete();
        return redirect()->route('receives.index')
        ->with('success','受注ID'.$receive->id.'を削除しました');
    }
}
