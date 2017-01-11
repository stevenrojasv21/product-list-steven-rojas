<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null) {
        //        
        $validator = Validator::make($request->all(), [
                    'id' => 'bail|required|max:5',
                    'name' => 'bail|required|max:255',
        ]);

        if ($validator->fails()) {
            $responsecode = 400;
            $header = array(
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            return response()->json($validator->errors(), $responsecode, $header, JSON_UNESCAPED_UNICODE);
        }
        $language = null;
        $idLanguage = $request->input('id');
        $name = $request->input('name');
        
        //DB::beginTransaction();
        try {
            if ($id === null) {
                if (Language::where('id', '=' ,$idLanguage)->first()) {
                    $responsecode = 400;
                    $header = array(
                        'Content-Type' => 'application/json; charset=UTF-8',
                        'charset' => 'utf-8'
                    );
                    return response()->json("Language code $idLanguage already exists", $responsecode, $header, JSON_UNESCAPED_UNICODE);
                }
                $language = Language::firstOrNew(['id' => $idLanguage]);
            } else {
                $language = Language::firstOrNew(['id' => $id]);
            }

            $language->name = $name;
            $language->save();            
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
}
