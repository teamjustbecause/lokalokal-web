<?php

namespace LokaLocal\Http\Controllers\Api;

use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;

class UserController extends Controller
{
    public function self()
    {
        return \Auth::user();
    }
}
