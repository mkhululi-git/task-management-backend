<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    /**
     * Display a listing of tasks for the board.
     *
     * @return \Illuminate\Http\Response
     */
    public function tasks($id)
    {
        $board = Board::find($id);
        return $board ?
            response( $board->tasks ) :
            response('Board not found', 404);
    }

}
