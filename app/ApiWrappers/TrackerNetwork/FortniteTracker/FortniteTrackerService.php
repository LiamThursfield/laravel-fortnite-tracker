<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker;

use App\ApiWrappers\TrackerNetwork\FortniteTracker\Models\PlayerProfile;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class FortniteTrackerService {

    /** @var string */
    private $base_url = "https://api.fortnitetracker.com/v1/";
    /** @var string */
    private $api_key;
    /** @var array  */
    private $headers;
    /** @var Client */
    private $client;
    /** @var Response */
    private $response;
    /** @var Collection */
    private $errors;

    /**
     * FortniteTrackerService constructor.
     * @param $api_key
     * @param null $base_url
     * @param array $custom_headers
     */
    public function __construct($api_key, $base_url = null, $custom_headers = []) {
        if ($base_url) {
            $this->base_url = $base_url;
        }

        $this->api_key = $api_key;

        $this->headers = array_merge([
            'TRN-Api-Key' => $this->api_key
        ], $custom_headers);

        $this->resetClient();
    }

    /**
     * Reset the client to it's initial state
     * Clear the response and any errors
     */
    public function resetClient() {
        $this->client = new Client([
            'base_uri' => $this->base_url,
            'headers' => $this->headers
        ]);
        $this->errors = new Collection();
        $this->response = null;
    }

    /**
     * Check if there are any errors
     * @return bool
     */
    public function hasErrors() {
        return $this->errors->isNotEmpty();
    }

    /**
     * Get the errors
     * @return Collection
     */
    public function getErrors() {
        return $this->errors;
    }


    /**
     * Get a player profile for a specific platform
     * @param $platform
     * @param $epic_nickname
     *
     * @return PlayerProfile|bool
     */
    public function getPlayerProfile($platform, $epic_nickname) {
        $url = "profile/{$platform}/{$epic_nickname}";

        if (empty($platform)) {
            $this->errors->push('Platform must be set.');
        }
        if (empty($epic_nickname)) {
            $this->errors->push('Epic Nickname must be set.');
        }
        if ($this->hasErrors()) {
            return false;
        }

        $result = $this->sendGetRequest($url);
        if (!$result) {
            return false;
        }

        try {
            $player_profile = new PlayerProfile($result);
            return $player_profile;
        } catch (\Exception $exception) {
            $this->errors->push($exception->getMessage());
            return false;
        }
    }


    /**
     * Send a GET Request and process the response
     * @param $url
     *
     * @return false|\stdClass
     */
    private function sendGetRequest($url) {
        try {
            $this->response = $this->client->get($url);

            if ($this->response->getStatusCode() !== 200) {
                throw new \Exception('Request Failed', $this->response->getStatusCode());
            }
        } catch (\Exception $exception) {
            if ($exception->getCode() === 403) {
                $this->errors->push('Invalid API key.');
            } else {
                $this->errors->push($exception->getMessage());
            }
            return false;
        }

        $result = trim($this->response->getBody()->getContents());
        if (empty($result)) {
            $this->errors->push('Unknown Error Occurred: Empty Response');
            return false;
        }

        $result = \GuzzleHttp\json_decode($result);
        if (isset($result->error)) {
            $this->errors->push($result->error);
            return false;
        }

        return $result;
    }




}
