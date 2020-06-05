<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array User
     */
    public function index()
    {
        return User::with('items')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return User
     */
    public function store(UserStoreRequest $request)
    {

        return User::create($request->all());
    }

}
