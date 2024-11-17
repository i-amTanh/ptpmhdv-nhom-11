<?php

namespace Auth\Controllers;

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
        'paths' => [AUTH_PATH . 'Views'],
    ];

}