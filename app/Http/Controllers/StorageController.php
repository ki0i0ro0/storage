<?php

namespace App\Http\Controllers;

use App\t_leaving;
use App\t_stock;
use App\t_storing;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\storageRequest;
use App\Http\Requests\storingRequest;


class StorageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 初期画面
     * @access public
     */
    public function index()
    {
        //商品毎の在庫合計数量を表示
        $dataList = DB::table('t_stocks')
            ->select(DB::raw('t_stocks.product_no, m_products.product_name as product_name 
                ,count(*) - count(t_stocks.selling > 0) as stock_cnt 
                ,avg(t_stocks.cost) as cost
                ,avg(t_stocks.selling) as selling
                ,avg(t_stocks.selling) - avg(t_stocks.cost) as profit'))
            ->leftJoin('m_products', 'm_products.product_no', '=', 't_stocks.product_no')
            ->groupBy('t_stocks.product_no', 'm_products.product_name')
            ->get();
        return view('storage/index', compact('dataList'));
    }

    /**
     * 入庫入庫画面を表示
     * @access public
     */
    public function create()
    {
        $storingData = new t_storing();
        return view('storage/create', compact('storingData'));
    }
    /**
     * 仮入庫処理
     * @access public
     * @param Request $request
     */
    public function store(storingRequest $request)
    {
        for ($i = 0; $i < $request->cnt; $i++) {
            $storingData = new t_storing();
            $storingData->product_no = $request->product_no;
            $storingData->cost = $request->cost;
            $storingData->save();
        }
        return redirect("/storage/storing");
    }

    /**
     * 一括入庫処理
     * @access public
     */
    public function postStoring()
    {
        $cnt = t_stock::max('stock_no') + 1;
        //仮入庫(null)のデータを抽出
        $t_storing = DB::select('select * from t_storings where stock_no is null');

        foreach ($t_storing as $value) {
            //仮入庫したデータを確定させる
            $stockData = new t_stock();
            $stockData->stock_no = $cnt;
            $stockData->cost = $value->cost;
            $stockData->product_no = $value->product_no;
            $stockData->save();

            //在庫登録した入庫明細に在庫番号を付番
            DB::update('update t_storings set stock_no = ? where seq_no = ?', [$cnt, $value->seq_no]);

            $cnt++;
        }
        return redirect("storage");
    }

    /**
     * 入庫確認画面表示
     * 
     * @access public
     */
    public function showStoring()
    {
        //商品毎の在庫合計数量を表示
        $dataList = DB::table('t_storings')
            ->select(DB::raw('t_storings.product_no, m_products.product_name ,count(*) as cnt '))
            ->leftJoin('m_products', 'm_products.product_no', '=', 't_storings.product_no')
            ->where('stock_no', null)
            ->groupBy('t_storings.product_no', 'm_products.product_name')
            ->get();
        return view('storage/storing', compact('dataList'));
    }

    /**
     * 出庫処理
     * @access public
     * @param storageRequest $request
     * @param int $product_no 商品番号
     */
    public function postLeaving(storageRequest $request, $product_no)
    {
        $StockData = t_stock::where('product_no', $product_no)
            ->where('selling', null)
            ->orderBy('stock_no')->get();
        $leavingCnt = $request->cnt;

        if ($leavingCnt>$StockData->count()) {
            return redirect("storage");
        }

        foreach ($StockData as $value) {
            $leavingData = new t_leaving();
            $leavingData->stock_no = $value->stock_no;
            $leavingData->product_no = $value->product_no;
            $leavingData->selling = $request->selling;
            $leavingData->save();
            
            //在庫登録した入庫明細に在庫番号を付番
            DB::update('update t_stocks set selling = ? where stock_no = ?', [$request->selling, $value->stock_no]);
            $leavingCnt--;

            if ($leavingCnt < 1) {
                break;
            }
        }
        return redirect("storage");
    }
}
