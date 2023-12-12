<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
    public function index(){
        // $urls = Url::all();

        //get urls created by authenticated user
        // $userId = auth()->user()->id;
        // $urls = Url::where('user_id',$userId)->get();
        
        // $urls = auth()->user()->urls;

        $user_id = auth()->id();
        // Log::debug($user);
        $urls = Url::where('user_id',$user_id)->pagInate(3);

        // $count = $urls->count();
        $count = Url::where('user_id',$user_id)->count();

        return view('url.index',compact('urls','count'));
        // return view('url.index');
    }

    public function review($id){
        // return view('url.view');
        $url = Url::FindOrFail($id);
        if($url->user_id != auth()->user()->id){
            abort(401);
        }
        return view('url.view',compact('url'));
    }

    public function create(){
        return view('url.create');
    }

    public function store(CreateUrlRequest $request){
        // $request->validate([
        //     'url'=>'url|max:2048'
        // ]);
        // dd($request);
        $random_string = Str::random(8);
        Url::create([
        'user_id' => auth()->user()->id,
        'original_url'=>$request->url,
         'short_url'=>$random_string
        ]);
        
        // $url = new Url();
        // $url->original_url = $request->url;
        // $url->short_url = $random_string;
        // $url->save();
        $request->session()->flash('success','Created Succesfully.');
        return redirect()->action([UrlController::class,'index']);       
    }

    public function edit($id){
        // $user_id = auth()->id();
        // $query = Url::where('user_id',$user_id)->where('id',$id)->first();
        // if(!$query){
        //     abort(401);
        // }

        $urls = Url::findOrFail($id);
    
        if($urls->user_id != auth()->user()->id){
            abort(401);
        }
        // Log::info($urls);
        return view('url.edit',compact('urls'));
    }

    public function update(UpdateUrlRequest $request, $id){
        // $request->validate([
        //     'url'=>'url|max:2048'
        // ]);  //validated from request class

        $url = Url::findOrFail($id);
        // if($url->user_id != auth()->id){
        //     abort(401);
        // }        //Authenticated from request 
        $url->update([
            'original_url'=>$request->url
        ]);

        $request->session()->flash('success','Updated Succesfully.');
        return redirect()->action([UrlController::class,'index']);
    }

    Public function delete(Request $request, $id){
        $url = Url::FindOrFail($id);
        if($url->user_id != auth()->user()->id){
            abort(401);
        }
        $url->delete();
        $request->session()->flash('success','Deleted Succesfully.');
        return redirect()->action([UrlController::class,'index']);
    }

    public function redirect(Request $request, $short_url){
        // $query = Url::query();
        $url = Url::where("short_url",$short_url)->first();
        // dd($query);
        // $url = $query::where('short_url',$short_url)->first();
        if($url){
            //record ip and user agent
            Visitor::create([
                'url_id' => $url->id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent() 
            ]); 
            //Increment visitor count
            $url->increment('visitor_count');
            // $url->visitor_count++;
            // $url->save();
            return redirect()->away($url->original_url);
        }
        abort(404);
    }

}
