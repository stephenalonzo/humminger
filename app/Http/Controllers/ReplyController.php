<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Rehum;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    // Repost (rehum) as hum
    public function rehum(Reply $reply)
    {

        $userInput['name']          = auth()->user()->name;
        $userInput['username']      = auth()->user()->username;
        $userInput['reply_id']      = $reply->id;

        Rehum::create($userInput);

        if (DB::table('replies')->where('rehums', null)->find($reply->id, 'id'))
        {

            return back()->with(Reply::where('rehums', null)->where('id', $reply->id)->update(['rehums' => 1]));

        } else {

            return back()->with(Reply::where('id', $reply->id)->increment('rehums', 1));

        }

    }

    // Like a hum
    public function like(Reply $reply)
    {

        $userInput['name']          = auth()->user()->name;
        $userInput['username']      = auth()->user()->username;
        $userInput['like_id']       = $reply->id;

        Like::create($userInput);

        if (DB::table('replies')->where('likes', NULL)->find($reply->id))
        {

            return back()->with(DB::table('replies')->where('likes', NULL)->update(['likes' => 1]));

        } else {

            return back()->with(Reply::where('id', $reply->id)->increment('likes', 1));

        }

    }
    
}
