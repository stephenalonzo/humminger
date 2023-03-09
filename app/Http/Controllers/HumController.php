<?php

namespace App\Http\Controllers;

use App\Models\Hum;
use App\Models\Like;
use App\Models\User;
use App\Models\Rehum;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HumController extends Controller
{
    // Show feed
    public function index()
    {
        return view('hums.index', ['hums' => Hum::latest()->get(), 'rehums' => Rehum::all()]);
    }

    // Create job
    public function create()
    {

        return view('hums.index');

    }

    // Create hum
    public function store(Request $request)
    {
        $userInput = $request->validate([
            'hum'       => 'required'
        ]);

        $userInput['name']          = auth()->user()->name;
        $userInput['username']      = auth()->user()->username;
        $userInput['user_id']       = auth()->id();

        Hum::create($userInput);

        return redirect('/');
        
    }

    // Show reply
    public function reply(Request $request)
    {
        
        return view('hums.reply', [
            'hums'  => DB::table('hums')->where('id', $request->hum)->get(), 
            'replies' => Reply::where('hum_id', $request->hum)->get()
        ]);

    }
    
    // Store reply
    public function send_reply(Request $request, Hum $hum)
    {

        $userInput = $request->validate([
            'reply' => 'required'
        ]);

        $userInput['name']          = auth()->user()->name;
        $userInput['username']      = auth()->user()->username;
        $userInput['hum_id']        = $hum->id;

        Reply::create($userInput);

        if (DB::table('hums')->where('replies', null)->find($hum->id, 'id'))
        {

            return back()->with(DB::table('hums')->where('replies', null)->where('id', $hum->id)->update(['replies' => 1]));

        } else {

            return back()->with(Hum::where('id', $hum->id)->increment('replies', 1));

        }

    }

    // Repost (rehum) as hum
    public function rehum(Hum $hum)
    {

        $userInput['name']          = auth()->user()->name;
        $userInput['username']      = auth()->user()->username;
        $userInput['hum_id']        = $hum->id;

        Rehum::create($userInput);

        if (DB::table('hums')->where('rehums', null)->find($hum->id, 'id'))
        {

            return back()->with(Hum::where('rehums', null)->where('id', $hum->id)->update(['rehums' => 1]));

        } else {

            return back()->with(Hum::where('id', $hum->id)->increment('rehums', 1));

        }

    }

    // Like a hum
    public function like(Hum $hum)
    {

        $userInput['name']          = auth()->user()->name;
        $userInput['username']      = auth()->user()->username;
        $userInput['hum_id']        = $hum->id;

        Like::create($userInput);

        if (DB::table('hums')->where('likes', null)->find($hum->id, 'id'))
        {

            return back()->with(Hum::where('likes', null)->where('id', $hum->id)->update(['likes' => 1]));

        } else {

            return back()->with(Hum::where('id', $hum->id)->increment('likes', 1));

        }

    }

}
