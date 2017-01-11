<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Product;
use App\ProductLanguage;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $responsecode = 200;
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return response()->json(Product::all(), $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null) {
        //        
        $validator = Validator::make($request->all(), [
                    'product_code' => 'bail|integer|required',
                    'title' => 'bail|required|max:255',
                    'description' => 'bail|required|max:255',
                    'language' => 'bail|required|exists:language,id|max:5',
        ]);

        if ($validator->fails()) {
            $responsecode = 400;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json($validator->errors(), $responsecode, $header, JSON_UNESCAPED_UNICODE);
        }

        $productCode = $request->input('product_code');
        $title = $request->input('title');
        $description = $request->input('description');
        $language = $request->input('language');
        //DB::beginTransaction();
        try {
            if ($id === null) {
                if (Product::where('product_code','=',$productCode)->first()) {
                    $responsecode = 400;
                    $header = array(
                        'Content-Type' => 'application/json; charset=UTF-8',
                        'charset' => 'utf-8'
                    );
                    return response()->json("Product code $productCode already exists", $responsecode, $header, JSON_UNESCAPED_UNICODE);
                }
                $product = Product::firstOrNew(['product_code' => $productCode]);
            } else {
                $product = Product::firstOrNew(['id' => $id]);
            }

            $product->product_code = $productCode;
            $product->save();
            $productLanguage = ProductLanguage::firstOrNew(['product_id' => $product->id, 'language_id' => $language]);
            $productLanguage->product_id = $product->id;
            $productLanguage->language_id = $language;
            $productLanguage->title = $title;
            $productLanguage->description = $description;
            $productLanguage->save();
            //DB::commit();
            $responsecode = 201;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json('Successfully request', $responsecode, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            //DB::rollback();
            $responsecode = 400;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json('Unsuccessfully request', $responsecode, $header, JSON_UNESCAPED_UNICODE);        
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        //        
        $validator = Validator::make(array('id' => $id), [
                    'id' => 'bail|integer|required',
        ]);
        
        if ($validator->fails()) {
            $responsecode = 400;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json($request->input('id'), $responsecode, $header, JSON_UNESCAPED_UNICODE);
        }
        
        $responsecode = 200;
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return response()->json(Product::find($id), $responsecode, $header, JSON_UNESCAPED_UNICODE);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        return $this->store($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        DB::beginTransaction();
        try {            
            $product = Product::find($id);
            $productsLanguages = ProductLanguage::where('product_id','=',$product->id)->delete();
            $product->delete();
            DB::commit();
            $responsecode = 200;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json('Successfully deleted', $responsecode, $header, JSON_UNESCAPED_UNICODE);        
        } catch (\Exception $e) {
            DB::rollback();
            $responsecode = 400;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json('Unsuccessfully deleted', $responsecode, $header, JSON_UNESCAPED_UNICODE);        
        }
        
    }

}
