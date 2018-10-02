<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
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
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login', 'login']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
	// Users router
    $routes->connect('/login/*', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/users/logout/*', ['controller' => 'Users', 'action' => 'logout']);
	$routes->connect('/users/add/*', ['controller' => 'Users', 'action' => 'add']);
	// Format router
	$routes->connect('/formats/*', ['controller' => 'Formats', 'action' => 'index']);
	$routes->connect('/formats/add/*', ['controller' => 'Formats', 'action' => 'add']);
	$routes->connect('/formats/edit/*', ['controller' => 'Formats', 'action' => 'edit']);
	$routes->connect('/formats/delete/*', ['controller' => 'Formats', 'action' => 'delete']);
	// Role router
	$routes->connect('/roles/*', ['controller' => 'Roles', 'action' => 'index']);
	$routes->connect('/roles/add/*', ['controller' => 'Roles', 'action' => 'add']);
	$routes->connect('/roles/edit/*', ['controller' => 'Roles', 'action' => 'edit']);
	$routes->connect('/roles/delete/*', ['controller' => 'Roles', 'action' => 'delete']);
	// Reports router
	$routes->connect('/reports/get/*', ['controller' => 'Reports', 'action' => 'get']);
	$routes->connect('/reports/*', ['controller' => 'Reports', 'action' => 'index']);
	$routes->connect('/reports/add/*', ['controller' => 'Reports', 'action' => 'add']);
	$routes->connect('/reports/edit/*', ['controller' => 'Reports', 'action' => 'edit']);
	$routes->connect('/reports/delete/*', ['controller' => 'Reports', 'action' => 'delete']);
	// Dashboard router
	$routes->connect('/dashboards/view/*', ['controller' => 'Reports', 'action' => 'view']);
	$routes->connect('/dashboards/update-read/*', ['controller' => 'Dashboards', 'action' => 'read']);
	$routes->connect('/dashboards/search/*', ['controller' => 'Dashboards', 'action' => 'search']);
	// Threads router
	$routes->connect('/threads/*', ['controller' => 'Threads', 'action' => 'index']);
	$routes->connect('/threads/add/*', ['controller' => 'Threads', 'action' => 'add']);
	$routes->connect('/threads/edit/*', ['controller' => 'Threads', 'action' => 'edit']);
	$routes->connect('/threads/delete/*', ['controller' => 'Threads', 'action' => 'delete']);
	// Messages router
	$routes->connect('/messages/*', ['controller' => 'Messages', 'action' => 'index']);
	$routes->connect('/messages/add/*', ['controller' => 'Messages', 'action' => 'add']);
	$routes->connect('/messages/edit/*', ['controller' => 'Messages', 'action' => 'edit']);
	$routes->connect('/messages/get/*', ['controller' => 'Messages', 'action' => 'get']);
	$routes->connect('/messages/delete/*', ['controller' => 'Messages', 'action' => 'delete']);
	$routes->connect('/messages/getMessage/*', ['controller' => 'Messages', 'action' => 'getMessage']);
	$routes->connect('/messages/search/*', ['controller' => 'Messages', 'action' => 'search']);
	$routes->connect('/messages/updateMsgRead/*', ['controller' => 'Messages', 'action' => 'updateMsgRead']);
	
	/**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});
