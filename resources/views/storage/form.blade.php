<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>入庫登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @include('storage/message')
            <form action="/storage/storing" method="post">
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
                <div class="form-group">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <a href="/storage"class="btn btn-default" >戻る</a>                
                </div>
            </form>
        </div>
    </div>
</div>