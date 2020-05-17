<?php

namespace App\Http\Controllers;
use App\t_storing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\t_stock;

class StoringController extends Controller
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
        $dataList = DB::table('t_storings')
        ->select(DB::raw('t_storings.product_no, m_products.name as product_name ,count(*) as cnt '))        
        ->leftJoin('m_products', 'm_products.product_no', '=', 't_storings.product_no')
        ->where('stock_no',null)
        ->groupBy('t_storings.product_no','m_products.name')
        ->get();
        return view('storage/storing', compact('dataList'));
    }  
    /**
     * 入庫確定処理
     * @access public
     * @param bbRequest $request
     */
    public function store(Request $request)
    {
        /*         if (!Auth::check()) {
            return view('home');
        }     */
        $cnt = t_stock::max('stock_no') + 1;

        $t_storings = DB::select('select * from t_storings where stock_no is null');

        foreach ($t_storings as $storingData) {        
            $stockData = new t_stock();
            $stockData->stock_no = $cnt ;
            $stockData->cost = $storingData->cost;
            $stockData->product_no = $storingData->product_no;
            $stockData->stock_category_no = 1;
            $stockData->save();
            $cnt++;
        }

        DB::delete('delete from t_storings');
        

        return redirect("storage");
    }

}
