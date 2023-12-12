<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class HomepageController extends Controller
{
    public function index(){
        // Log::info('user visited the homepage');
        return view('welcome');
    }
    public function upload_file(){
        return view('file');
        
    }
    public function upload(Request $request){
        $request->validate([
            'file'=> 'required|image'
        ]);
        $path = $request->file('file')->store('public');
        return redirect()->back()->with('path',$path);

    }
    
}
