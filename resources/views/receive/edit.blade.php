@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">商品変更画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/receives') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="{{ route('receive.update',$receive->id) }}" method="POST">
    @method('PUT')
    @csrf
     <div class="row">
        <div class="col-12 mb-2 mt-2 mb-2">
            <div class="form-group">
                <select name="client_id" class="form-select">
                    <option>客先を選択してください</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}"@if($client->id==$receive->client_id) selected @endif>{{ $client->name }}</option>
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
                        <option value="{{ $product->id }}"@if($product->id==$receive->product_id) selected @endif>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                <span style="color:red;">商品を選択してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="number" value="{{ $receive->number }}" class="form-control" placeholder="個数">
                @error('number')
                <span style="color:red;">個数を1～12までの数値で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2 mb-2">
            <div class="form-group">
                <select name="condition_id" class="form-select">
                    <option>状態を選択してください</option>
                    @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}"@if($condition->id==$receive->condition) selected @endif>{{ $condition->name }}</option>
                    @endforeach
                </select>
                @error('condition_id')
                <span style="color:red;">状態を選択してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">変更</button>
        </div>
    </div>      
</form>
</div>
@endsection