<?php

namespace Web\Controllers;

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
        'paths' => [WEB_PATH . 'Views'],

    ];
}
