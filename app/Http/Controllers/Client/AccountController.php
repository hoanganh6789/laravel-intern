<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private const PATH_VIEW = 'client.';

    public function index()
    {
        return view(self::PATH_VIEW . 'account');
    }
}
