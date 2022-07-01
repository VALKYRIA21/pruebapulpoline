<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){   
        //Id del usuario contectado en ese momento
        $idUser = auth()->user()->id;
        // dd($idUser); Test 
        //Api key
        $apiKey = '772831bfdf6210ee6d51';
        $json = Http::get("https://free.currconv.com/api/v7/currencies?apiKey={$apiKey}");
        $obj = json_decode($json, true);
        $arrayOfCurrencie = $obj['results'];
        // dd($arrayOfCurrencie); test
        return view('home', compact('idUser', 'arrayOfCurrencie'));
    }
}
