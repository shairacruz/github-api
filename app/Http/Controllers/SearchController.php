<?php

namespace App\Http\Controllers;

use App\Library\UtilityLibrary;
use App\Library\ConstantLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Cache;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index($sUsername)
    {
        $aUsername = explode (',', $sUsername);
        if (count($aUsername) > 10) {
            return [
                'status_code' => ConstantLibrary::STATUS_CODE_100,
                'message'     => ConstantLibrary::STATUS_CODE_100_MESSAGE
            ];
        }
        sort($aUsername);
        $aUserInfo = [];
        foreach ($aUsername as $sUser) {
            $aUserInfo[$sUser] = $this->getUsernameInformation($sUser);
        }
        return [
            'status_code' => ConstantLibrary::STATUS_CODE_200,
            'data'        => $aUserInfo
        ];
    }

    private function getUsernameInformation($sUsername){
        $aCachedId = Cache::store('redis')->get(ConstantLibrary::GITHUB_CACHE_KEY . $sUsername);
        $aDecodeCache = json_decode($aCachedId, true);

        if (UtilityLibrary::isValidArray($aDecodeCache) === true) {
            return $aDecodeCache;
        } else {
            $aUserInfo = $this->getUserFromGithub($sUsername);
            Cache::store('redis')->put(ConstantLibrary::GITHUB_CACHE_KEY . $sUsername, json_encode($aUserInfo), ConstantLibrary::CACHE_TIME); // 2 minutes
            return $aUserInfo;
        }
    }

    private function getUserFromGithub($sUsername){

        $sGithubEndpoint = ConstantLibrary::GITHUB_ENDPOINT . $sUsername;
        $oClient = new \GuzzleHttp\Client();

        $oResponse = $oClient->request('GET', $sGithubEndpoint, ['http_errors' => false]);
        $aContent = json_decode($oResponse->getBody()->getContents(), true);
        if ($oResponse->getStatusCode() === 200) {
            $dAverageFollowers = 0;
            if ($aContent['public_repos'] != 0) {
                $dAverageFollowers = $aContent['followers'] / $aContent['public_repos'];
            }

            return [
                'name'              => $aContent['name'],
                'login'             => $aContent['login'],
                'company'           => $aContent['company'],
                'followers'         => $aContent['followers'],
                'public_repos'      => $aContent['public_repos'],
                'average_followers' => $dAverageFollowers,
            ];
        }

        return [
            'status_code' => ConstantLibrary::STATUS_CODE_400,
            'message'     => $aContent['message']
        ];
    }
}
