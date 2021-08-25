<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $board = Auth::user()->boards->first();
        $tasks = $board->tasks;
        return view('home')
            ->with('users', $users)
            ->with('board', $board)
            ->with('tasks', $tasks);
    }
}
