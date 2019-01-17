<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Mockery\Exception;

class FortniteTrackerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Get the duos stats - for coops and deej
     *
     * @return bool|array
     */
    public function duos() {
        // Define the player profiles to lookup
        $profiles = [
            'Coopswastaken' => [
                'platform' => 'ps4',
                'profile_name' => 'psn(coopswastaken)'
            ],
            'LiamThursfield' => [
                'platform' => 'ps4',
                'profile_name' => 'Liam_Thursfield'
            ],
        ];

        // Get the stats for each player
        $stats = [];
        foreach ($profiles as $player_name => $profile) {
            $url = "profile/{$profile['platform']}/{$profile['profile_name']}";
            $result = $this->apiCall($url);
            if ($result && property_exists($result, 'accountId')) {
                $stats[$player_name] = $result;
            }
            unset($url);
            unset($result);
        }
        unset($player_name);
        unset($profile);

        // Get the match history for each player
        $match_history = [];
        foreach ($stats as $player_name => $player_stats) {
            $url = "profile/account/{$player_stats->accountId}/matches";
            $result = $this->apiCall($url);
            if ($result) {
                $match_history[$player_name] = $result;
            }
            unset($url);
            unset($result);
        }
        unset($player_name);
        unset($player_stats);

        // Build the return payload
        $result = [];
        foreach ($stats as $player_name => $player_stats) {
            $player_result = [];

            $player_result['player'] = [
                'name' => $player_name,
                'platform' => $player_stats->platformNameLong
            ];

            $duos_stats_current = $player_stats->stats->curr_p10;
            $player_result['stats']['duos'] = [
                'score' => $duos_stats_current->score->displayValue,
                'score_rank' => $duos_stats_current->score->rank,
                'top_1' => $duos_stats_current->top1->valueInt,
                'top_5' => $duos_stats_current->top5->valueInt,
                'top_10' => $duos_stats_current->top10->valueInt,
                'kd' => $duos_stats_current->kd->valueDec,
                'kills' => $duos_stats_current->kills->valueInt,
                'kpg' => $duos_stats_current->kpg->valueDec
            ];
            unset($duos_stats_current);

            if ($match_history[$player_name]) {
                foreach ($match_history[$player_name] as $match) {
                   if ($match->playlist == "p10") { // duos
                       $player_result['match_history'][] = [
                           'date' => $match->dateCollected,
                           'matches' => $match->matches,
                           'kills' => $match->kills,
                       ];
                   }
                }
                unset($match);
            }

            $result[$player_name] = $player_result;
        }
        unset($stats);
        unset($profiles);
        unset($player_stats);
        unset($match_history);
        unset($player_name);
        unset($player_result);

        if (count($result) === 0) {
            return false;
        }

        return $result;
    }

    /**
     * Make an API Call to the FNT api
     *
     * @param string $url
     * @return bool| \stdClass
     */
    private function apiCall(string $url) {
        $base_url = 'https://api.fortnitetracker.com/v1/';
        $headers = ['TRN-Api-Key' => env('TRN_API_KEY', '')];

        // Make the api call
        try {
            $client = new Client([
                'base_uri' => $base_url,
                'headers' => $headers
            ]);
            $response = $client->get($url);
        } catch (Exception $exception) {
            return false;
        }

        // Ensure the call was successful
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        $result = $response->getBody()->getContents();
        if (strlen(trim($result)) === 0) {
            return false;
        }

        return \GuzzleHttp\json_decode($result);
    }
}
