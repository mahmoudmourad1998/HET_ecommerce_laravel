<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(Order::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $order = new Order();
      $order->user_id = $request->user_id;
      $order->status = $request->status;
      $order->total_price = $request->total_price;
      //$order->created_at = now();
      //$order->updated_at = now();
      $order->save();
      return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $order = Order::find($id);
      return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user_id= Auth::id();
      //DB::select('select * from orders where user_id = ?', [$user_id])->find($id)->delete();
      Order::where('user_id',$user_id)->find($id)->delete();
      return response()->json(['result' => 'delete was successful for the item with id '.$id.' of user id '.$user_id]);
    }

    public function getOrdersOfUser($id){
      //$user_id = Auth::id()
      return response()->json(Order::where('user_id', $id)->with('user')->get());
    }
}
