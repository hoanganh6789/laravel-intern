<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private const PATH_VIEW = 'client.';
    public function wishlist()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
}
