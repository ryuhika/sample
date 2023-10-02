@extends('app')

@section('content')
    @auth
    <div class="row" style="text-align:right;">
      <div class="col-lg-12">
        ログイン者:{{ $user_name }}
      </div>
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="ログアウト" class="btn btn-outline-secondary">
      </form>
    </div>
    @endauth
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">商品管理画面</h2>
            </div>
            <div class="text-right">
            @auth
            <a class="btn btn-success" href="{{ route('product.create') }}">新規登録</a>
            @endauth
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @if($message = Session::get('success'))
          <div class="alert alert-success mt-1"><p>{{ $message }}</p></div>
        @endif
      </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>名前</th>
            <th>価格</th>
            <th>メーカー</th>
            <th>サイズ</th>
            <th>分類</th>
            @auth
            <th>変更</th>
            <th>削除</th>
            <th>編集者</th>
            @endauth
        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td style="text-align:right">{{ $product->name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->maker }}</td>
            <td style="text-align:right">{{ $product->size }}</td>
            <td style="text-align:right">{{ $product->category }}</td>
            @auth
            <td style="text-align:center">
              <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">変更</a>
            </td>
            @endauth
            @auth
            <td style="text-align:center">
              <form action="{{ route('product.destroy',$product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？")';>削除</button>
              </form>
            </td>
            @endauth
            @auth<td>{{ $product->user_name }}</td>@endauth
        </tr>
        @endforeach
    </table>
 
    {!! $products->links('pagination::bootstrap-4') !!}
 
@endsection