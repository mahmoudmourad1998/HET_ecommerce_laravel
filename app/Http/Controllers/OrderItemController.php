<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $order_item = new OrderItem();
    $order_item->order_id = $request->order_id;
    $order_item->product_id = $request->product_id;
    $order_item->item_price = $request->item_price;
    $order_item->item_quantity = $request->item_quantity;
    $order_item->item_total_price = $request->item_total_price;
    $order_item->save();
    return response()->json($order_item);
  }

  /**
   * Display the specified resource.
   *
   * @param \App\OrderItem $orderItem
   * @return \Illuminate\Http\Response
   */
  public function show(OrderItem $orderItem)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\OrderItem $orderItem
   * @return \Illuminate\Http\Response
   */
  public function edit(OrderItem $orderItem)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\OrderItem $orderItem
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, OrderItem $orderItem)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\OrderItem $orderItem
   * @return \Illuminate\Http\Response
   */
  public function destroy(OrderItem $orderItem)
  {
    //
  }

  public function getAllItemsOfOrder($id)
  {
    $query0 = OrderItem::where('order_id', $id)->with(['order', 'product'])->get();
    return response()->json($query0);

//    $query1 = DB::select('select * from order_items where order_id = ?', [$id]);
//    $result_of_query1 = array_map(
//      function ($value) {
//        return (array)$value;
//      },
//      $query1
//    );
//    $items = [];
//    foreach ($result_of_query1 as &$value) {
//      $order_id = $value['order_id'];
//      $query00 = DB::select('select * from orders where id = ?', [$order_id]);
//      $result_of_query00 = array_map(
//        function ($value) {
//          return (array)$value;
//        },
//        $query00
//      );
//      $value['order'] = $result_of_query00[0];
//      $item_id = $value['item_id'];
//      $query01 = DB::select('select * from products where id = ?', [$item_id]);
//      $result_of_query01 = array_map(
//        function ($value) {
//          return (array)$value;
//        },
//        $query01
//      );
//      $value['product'] = $result_of_query01[0];
//      //$item = [$value, $result_of_query00, $result_of_query01];
//      array_push($items, $value);
//    }
//    return response()->json($items);
  }
}
