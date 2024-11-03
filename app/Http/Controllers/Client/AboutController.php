<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private const PATH_VIEW = 'client.';

    public function index(){
        return view(self::PATH_VIEW . 'about');
    }
}
