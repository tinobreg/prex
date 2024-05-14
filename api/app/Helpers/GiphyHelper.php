<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class GiphyHelper
{

    const API_VERSION = 'v1';
    const API_ENDPOINT = 'gifs';

    /**
     * @param string|null $q
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function search(?string $q = '', ?int $limit = 25, ?int $offset = 0): array
    {
        return self::makeRequest('search', ($q ?? ''), $limit, $offset);
    }

    /**
     * @param string $id
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function view(string $id): array
    {
        return self::makeRequest($id);
    }

    /**
     * @param string $id
     * @param string|null $q
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private static function makeRequest(string $id = 'search', ?string $q = null, ?int $limit = null, ?int $offset = null): array
    {
        try {
            $client = new Client();
            $endpointUrl = env('GIPHY_API_URL') . '/' . self::API_VERSION . '/' . self::API_ENDPOINT . '/' . $id . '?api_key=' . env('GIPHY_API_KEY');
            $endpointUrl .= $q != null ? '&q=' . $q : '';
            $endpointUrl .= $limit != null ? '&limit=' . $limit : '';
            $endpointUrl .= $offset != null ? '&offset=' . $offset : '';

            $response = $client->request('GET', $endpointUrl);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException|ConnectException $e) {
            return ['data' => [], 'meta' => ['status' => $e->getCode(), 'msg' => $e->getMessage()]];
        }
    }
}
