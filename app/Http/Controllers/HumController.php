<?php

namespace App\Http\Controllers;

use App\Models\Hum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HumController extends Controller
{
    // Show feed
    public function index()
    {
        return view('hums.index', ['hums' => Hum::all()]);
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

        $userInput['user_id'] = auth()->id();

        Hum::create($userInput);

        return redirect('/');
        
    }
}
