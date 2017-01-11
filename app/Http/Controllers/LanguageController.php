<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsecode = 200;
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return response()->json(Language::all(), $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $validator = Validator::make(array('id' => $id), [
                    'id' => 'bail|required',
        ]);
        
        if ($validator->fails()) {
            $responsecode = 400;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json($validator->errors(), $responsecode, $header, JSON_UNESCAPED_UNICODE);
        }
        $responsecode = 200;
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return response()->json(Language::find($id), $responsecode, $header, JSON_UNESCAPED_UNICODE);  
    }
}
