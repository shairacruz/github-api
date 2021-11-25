<?php

namespace App\Library;

class ConstantLibrary
{
    /**
     * Github API Endpoint
     */
    const GITHUB_ENDPOINT = 'https://api.github.com/users/';

    /**
     * Prefix for redis cache key
     */
    const GITHUB_CACHE_KEY = 'github_';

    /**
     * Status code: Max username searched
     */
    const STATUS_CODE_100 = 100;

    /**
     * Status 100 message
     */
    const STATUS_CODE_100_MESSAGE = 'Search exceeds max of 10 username';

    /**
     * Status code: Success
     */
    const STATUS_CODE_200 = 200;

    /**
     * Status code: Wrong login credentials
     */
    const STATUS_CODE_300 = 300;

    /**
     * Status 300 message
     */
    const STATUS_CODE_300_MESSAGE = 'Wrong username or password';

    /**
     * Status code: Client Error
     */
    const STATUS_CODE_400 = 400;

    /**
     * Cached duration: 2 mins
     */
    const CACHE_TIME = 120;
}
