<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Logs;
use App\User;
use Auth;

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
    public function index()
    {
        $men = 0;
        $women = 0;
        $other = 0;
        $logs = Logs::all();
        $userLogs = Logs::where('email', '=', Auth::user()->email)->get();
        $users = User::select('sex')->get();

        foreach ($users as $u) {
            if ($u->sex === 0) {
                $men += 1;
            } elseif ($u->sex === 1) {
                $women += 1;
            } elseif ($u->sex === 2) {
                $other += 1;
            }
        }
        
        return view('home')->with(compact('logs', 'userLogs', 'men', 'women', 'other'));
    }
}
