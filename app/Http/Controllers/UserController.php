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
        $users = User::with('items');

        if (request('uf')) {
            $users = $users->where('uf', request('uf'));
        }
        if (request('city')) {
            $users = $users->where('city', request('city'));
        }

        if (request('items')) {
            $users = $users->has('items', '>=', 1)->whereHas('items', function ($query) {
                foreach (explode(',', request('items')) as $item_id) {
                    $query->orWhere('item_id', $item_id);
                }
            });
        }
        return $users->get()->map(function ($q) {
            $q->image_url = $q->getFirstMediaUrl('image');
            return $q;
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        $user->image_url = $user->getFirstMediaUrl('image');
        $user->items_ids = implode(',', $user->items()->pluck('item_id')->toArray());
        return $user;
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

        if ($request->image) {
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if ($request->items) {
            $user->items()->sync(explode(',', $request->items));
        }

        return $user;
    }

}
