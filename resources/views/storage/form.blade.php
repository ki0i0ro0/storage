<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>書籍登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <form action="/storage" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">商品コード</label>
                    <input type="text" class="form-control" name="product_no" value="{{ $storingData->product_no }}">
                </div>
                <div class="form-group">
                    <label for="cost">仕入値</label>
                    <input type="text" class="form-control" name="cost" value="{{ $storingData->cost }}">
                </div>
                <div class="form-group">
                    <label for="cnt">数量</label>
                    <input type="text" class="form-control" name="cnt" value="{{ $storingData->cnt }}">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/storage">戻る</a>
            </form>
        </div>
    </div>
</div>
