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
        return User::with('items')->get()->map(function ($q) {
            $q->image_url = $q->getFirstMediaUrl('image');
            return $q;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return User
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->except('image'));

        if($request->image) {
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return $user;
    }

}
