<?php

namespace App\Http\Controllers;

use App\m_stock;
use App\t_leaving;
use App\t_stock;
use App\t_storing;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * 初期
     * @access public
     * @param bbRequest $request
     */
    public function index()
    {
        /*         if (!Auth::check()) {
            return view('home');
        }   */
        //商品毎の在庫合計数量を表示
        $dataList = DB::table('t_stocks')
        ->select(DB::raw('t_stocks.product_no, m_products.name as product_name ,count(*) as stock_cnt ,avg(t_stocks.cost) as cost,avg(t_stocks.selling) as selling,avg(t_stocks.profit) as profit'))        
        ->leftJoin('m_products', 'm_products.product_no', '=', 't_stocks.product_no')
        ->where('t_stocks.stock_category_no', '=', 1)
        ->groupBy('t_stocks.product_no','m_products.name')
        ->get();
        return view('storage/index', compact('dataList'));
    }

    /**
     * 在庫編集
     * @access public
     * @param bbRequest $request
     */
    public function editStock($storageNo)
    {
        /*         if (!Auth::check()) {            
            return view('home');
        }    */
        // DBよりURIパラメータと同じIDを持つBookの情報を取得
        $StockData = t_stock::findOrFail($storageNo);

        // 取得した値をビュー「book/edit」に渡す
        return view('storage/edit', compact('StockData'));
    }
    /**
     * 出庫処理
     * @access public
     * @param bbRequest $request
     */
    public function leavingStock($storageNo, $selling)
    {
        /*         if (!Auth::check()) {
            return view('home');
        }    */
        $StockData = m_stock::findOrFail($storageNo);
        $StockData->selling = $selling;
        $StockData->stock_category = 2;
        $StockData->save();

        $leavingData = new t_leaving();
        $leavingData->stock_no = $StockData->stock_no;
        $leavingData->product_no = $StockData->product_no;
        $leavingData->selling = $StockData->selling;
        $leavingData->save();

        return redirect("storage/index");
    }

    /**
     * 在庫削除
     * @access public
     * @param bbRequest $request
     */
    public function deleteStock($storageNo)
    {
        /*         if (!Auth::check()) {
            return view('home');
        } */
        $StockData = m_stock::findOrFail($storageNo);
        $StockData->stock_category = 3;
        $StockData->save();

        return redirect("storage/index");
    }

    /**
     * 入庫ボタン
     * @access public
     * @param bbRequest $request
     */
    public function create()
    {
        /*         if (!Auth::check()) {
            return view('home');
        }   */
        // 空の$bookを渡す
        $storingData = new t_storing();
        return view('storage/create', compact('storingData'));
    }
    /**
     * 入庫処理
     * @access public
     * @param bbRequest $request
     */
    public function store(Request $request)
    {
        /*         if (!Auth::check()) {
            return view('home');
        }     */
        
        for ($i=0; $i < $request->cnt; $i++) { 
            $storingData = new t_storing();
            $storingData->product_no = $request->product_no;
            $storingData->cost = $request->cost;
            $storingData->save();    
        }
        return redirect("/storage");
    }  

}