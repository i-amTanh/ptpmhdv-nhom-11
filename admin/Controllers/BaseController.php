<?php

namespace Admin\Controllers;

use App\Controllers\BaseController as Controller;

/**
 * Class BaseController.
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
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
        'paths' => [ADMIN_PATH . 'Views'],

    ];

    protected function getApiData(string $url, string $method = 'GET', array $data = []): string {

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        if (strtolower($method) === 'post') {
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        $curl = curl_init(); // Khởi tạo phiên cURL.
        curl_setopt_array($curl, $options); // Đặt các tùy chọn cho phiên.
        $response = curl_exec($curl); // Thực hiện yêu cầu và lưu kết quả.
        curl_close($curl); // Đóng phiên cURL.

        return $response;
    }


}
