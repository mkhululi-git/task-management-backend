<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users ?
            response($users) :
            response('User not found');
    }
    /**
     * Display a listing of the boards for the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function boards($user_id)
    {
        $user = User::find($user_id);
        return $user ?
            response($user->boards) :
            response('User not found');
    }

    /**
     * Display a single board for the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function board($user_id)
    {
        $user = User::find($user_id);
        return $user ?
            response($user->boards->first()) :
            response('User not found');
    }
}
