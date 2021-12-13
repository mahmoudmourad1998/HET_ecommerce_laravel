<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return response()->json(Product::all());
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
    $product = new Product();
    $product->name = $request->name;
    $product->image_url = $request->image_url;
    $product->category_id = $request->category_id;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->review = $request->review;
    $product->save();
    UserController::NotifyAllUsers($product);
    return response()->json($product);
  }



  /**
   * Display the specified resource.
   *
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $product = Product::find($id);
    return response()->json($product);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id, $field)
  {
    $product = Product::find($id);
    $product->$field = $request->$field;
    $product->save();
    return response()->json($product);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $product = Product::find($id);
    $product->id = $id;
    $product->name = $request->name;
    $product->image_url = $request->image_url;
    $product->category_id = $request->category_id;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->review = $request->review;
    $product->save();
    return response()->json($product);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Product::find($id)->delete();
    return response()->json(['result' => 'delete was successful for the item with id '.$id.'.']);
  }

  public function ShowCategoryOfProduct($product_id)
  {
    $query1 = Product::where('id', $product_id)->with('category')->get();
    return response()->json($query1);
//    $query1 = DB::select('select * from products where id = ?', [$product_id]);
//    $result_of_query1 = array_map(
//      function ($value) {
//        return (array)$value;
//      },
//      $query1
//    );
//    $category_id = $result_of_query1[0]['category_id'];
//    $query2 = DB::select('select * from categories where id = ?', [$category_id]);
//    $result_of_query2 = array_map(
//      function ($value) {
//        return (array)$value;
//      },
//      $query2
//    );
//    $category = $result_of_query2[0];
//    $category_title = $category['title'];
//    return response()->json($category);
  }
}
