<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemsController extends Controller
{

    public function index()
    {
        return Item::all();
    }

}
