@extends('app')

@section('content')
    @auth
    <div class="row" style="text-align:right">
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
                <h2 style="font-size:1rem;">受注入力画面</h2>
            </div>
            <div class="text-right">
            @auth
            <a class="btn btn-success" href="{{ route('receive.create') }}">新規登録</a>
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
            <th>ID</th>
            <th>客先</th>
            <th>商品</th>
            <th>個数</th>
            <th>状態</th>
            <th>更新者</th>
            <th>変更</th>
            <th>削除</th>
        </tr>

        @foreach ($receives as $receive)
        <tr>
            <td style="text-align:right">{{ $receive->id }}</td>
            <td>{{ $receive->client_name }}</td>
            <td>{{ $receive->product_name }}</td>
            <td style="text-align:right">{{ $receive->number }}</td>
            <td style="text-align:right">{{ $receive->condition }}</td>
            <td style="text-align:right">{{ $receive->user_name }}</td>
            @auth
            <td style="text-align:center">
              <a class="btn btn-primary" href="{{ route('receive.edit',$receive->id) }}">変更</a>
            </td>
            @endauth
            @auth
            <td style="text-align:center">
              <form action="{{ route('receive.destroy',$receive->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？")';>削除</button>
              </form>
            </td>
            @endauth
        </tr>
        @endforeach
    </table>
 
    {!! $receives->links('pagination::bootstrap-4') !!}
 
@endsection
