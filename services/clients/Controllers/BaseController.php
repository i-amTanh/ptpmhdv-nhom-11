<?php
/**
 * @project ptpmhdv-nhom-7
 * @email hiepnguyen3624@gmail.com
 * @date 14/11/2024
 * @time 11:20
 */

namespace Client\Controllers;

use App\Controllers\BaseController as Controller;

class BaseController extends Controller
{
    /**
     * Defines the Twig configuration.
     * This array contains all the defined Twig configuration params.
     *
     * Examples:
     *
     * ```
     * $twig = [
     *      'functions' => ['my_helper'],
     *      'safeFunctions' => ['my_safe_helper'],
     *      'filters' => ['my_filter'],
     * ]
     *```
     *
     * @see https://twig.symfony.com/doc/3.x/api.html#environment-options
     */
    protected array $twigConfig = [
        'paths' => [CLIENT_PATH . 'Views'],
    ];

    protected function getApiData(string $url, string $method = 'GET', array $data = []):string
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        if(strtolower($method) == 'post'){
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        $curl = curl_init();

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

}
