<?php

namespace App\Repositories;

use App\Http\Requests\GifFavouritesAddRequest;
use App\Models\GifFavourites;
use Illuminate\Http\Client\Request;

class GifFavouritesRepository
{

    /**
     * @param Request|GifFavouritesAddRequest $request
     * @return mixed
     */
    public function add(Request|GifFavouritesAddRequest $request)
    {
        $user = $request->user();
        return GifFavourites::firstOrCreate(
            ['user_id' => $user->id, 'gif_id' => $request->gif_id],
            ['user_id' => $user->id, 'gif_id' => $request->gif_id, 'alias' => $request->alias]
        );
    }
}
