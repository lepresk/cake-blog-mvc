<?php

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {

        $builder->scope('/posts', ['controller' => 'Posts'], function (RouteBuilder $builder) {
            $builder->get('/', ['action' => 'index'], 'posts:index');

            $builder->connect('/add', ['action' => 'add'], ['_name' => 'posts:add']);
            
            $builder
                ->connect('/edit/{id}', ['action' => 'edit'], ['_name' => 'posts:edit'])
                ->setPass(['id'])
                ->setPatterns(['id' => '\d+']);

            $builder
                ->connect('/delete/{id}', ['action' => 'delete'], ['_name' => 'posts:delete'])
                ->setPass(['id'])
                ->setPatterns(['id' => '\d+']);
        });

        $builder->scope('/categories', ['controller' => 'Categories'], function (RouteBuilder $builder) {
            $builder->get('/', ['action' => 'index'], 'categories:index');
            $builder->get('/add', ['action' => 'add'], 'categories:add');
            $builder->post('/add', ['action' => 'add']);


            $builder->connect('/edit/{id}', ['action' => 'edit'], ['_name' => 'categories:edit'])
                ->setPass(['id'])
                ->setPatterns(['id' => '\d+']);

            $builder->connect('/delte/{id}', ['action' => 'delete'], ['_name' => 'categories:delete'])
                ->setPass(['id'])
                ->setPatterns(['id' => '\d+']);
        });

        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        //$builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
