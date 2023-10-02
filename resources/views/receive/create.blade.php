@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">商品登録画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/receives') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="{{ route('receive.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-12 mb-2 mt-2 mb-2">
            <div class="form-group">
                <select name="client_id" class="form-select">
                    <option>客先を選択してください</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                <span style="color:red;">客先を選択してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2 mb-2">
            <div class="form-group">
                <select name="product_id" class="form-select">
                    <option>商品を選択してください</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                <span style="color:red;">文房具を選択してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="number" class="form-control" placeholder="個数">
                @error('number')
                <span style="color:red;">個数を1～12までの数値で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
    </div>      
</form>
</div>
@endsection