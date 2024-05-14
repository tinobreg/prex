<?php

namespace App\Http\Controllers;

use App\Helpers\GiphyHelper;
use App\Http\Requests\GifFavouritesAddRequest;
use App\Repositories\GifFavouritesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GifController extends Controller
{

    protected GifFavouritesRepository $gifFavouriteRepository;

    public function __construct(GifFavouritesRepository $gifFavouriteRepository)
    {
        $this->gifFavouriteRepository = $gifFavouriteRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(Request $request): JsonResponse
    {
        $result = GiphyHelper::search($request->q, $request->limit ?? 25, $request->offset ?? 0);
        return response()->json($result, (int)$result['meta']['status'] ?? 400);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function view(string $id): JsonResponse
    {
        $result = GiphyHelper::view($id);
        return response()->json($result, (int)$result['meta']['status'] ?? 404);
    }

    /**
     * @param GifFavouritesAddRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFavourite(GifFavouritesAddRequest $request): JsonResponse
    {
        try {
            $result = $this->gifFavouriteRepository->add($request);
            $response = ['data' => $result, 'meta' => ['status' => 200, 'msg' => 'OK']];
        } catch (ModelNotFoundException|\Exception $e) {
            $response = ['data' => [], 'meta' => ['status' => 400, 'msg' => 'An error occurred while saving the favorite Gif.']];
        }

        return response()->json($response, (int)$response['meta']['status'] ?? 400);
    }
}
