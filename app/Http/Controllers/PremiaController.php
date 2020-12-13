<?php

namespace App\Http\Controllers;

use App\Models\Premia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\Environment\Console;

// use App\Premia;
// use App\http\Requests;
// use App\Http\Resources\Premia as PremiaResource;

class PremiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function sendDetails(Request $request){

        
        $response = Http::post('https://ibell.frb.io/api/test/getJson', [
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'email' => $request->email,
            'id' => $request->id,
        ]);
        return $response;
    }


    public function postAboveFifty(Request $request){

        
        $response = Http::post('https://ibell.frb.io/zapier/add/lead/31198', [
            'שם_מלא' => $request->fullName,
            'טלפון' => $request->phone,
            'אימייל' => $request->email,
            'תעודת_זהות' => $request->id,
        ]);
        return $response;
    }


    public function postUnderFifty(Request $request){

        
        $response = Http::post('https://ibell.frb.io/zapier/add/lead/38754', [
            'שם_מלא' => $request->fullName,
            'טלפון' => $request->phone,
            'אימייל' => $request->email,
            'תעודת_זהות' => $request->id,
        ]);
        return $response;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premia  $premia
     * @return \Illuminate\Http\Response
     */
    public function show(Premia $premia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premia  $premia
     * @return \Illuminate\Http\Response
     */
    public function edit(Premia $premia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Premia  $premia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Premia $premia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premia  $premia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premia $premia)
    {
        //
    }
}
