<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

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
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Frontend',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Frontend/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Frontend', 'action' => 'home'], ['_name' => 'home']);
    $routes->connect(
        '/servico/:id',
        ['controller' => 'Frontend', 'action' => 'servico'],
        ['_name' => 'servico'],
        ['id' => '\d+', 'pass' => ['id']]
    );
    $routes->connect(
        '/projeto/:id',
        ['controller' => 'Frontend', 'action' => 'projeto'],
        ['_name' => 'projeto'],
        ['id' => '\d+', 'pass' => ['id']]
    );
    $routes->connect(
        '/noticia/:id',
        ['controller' => 'Frontend', 'action' => 'noticia'],
        ['_name' => 'noticia'],
        ['id' => '\d+', 'pass' => ['id']]
    );
});

Router::scope('/cliente', function($routes){
    $routes->connect('/login', ['controller' => 'Clients', 'action' => 'login'], ['_name' => 'client_login']);
    $routes->connect('/logout', ['controller' => 'Clients', 'action' => 'logout'], ['_name' => 'client_logout']);

    $routes->connect(
        '/download/:id',
        ['controller' => 'Clients', 'action' => 'download'],
        ['_name' => 'client_download'],
        ['id' => '\d+', 'pass' => ['id']]
    );


    $routes->connect('/', ['controller' => 'Clients', 'action' => 'home'], ['_name' => 'client_home']);
});

Router::scope('/uwa', function($routes) {
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login'], ['_name' => 'login']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout'], ['_name' => 'logout']);
    $routes->connect('/', ['controller' => 'Users', 'action' => 'dashboard'], ['_name' => 'dashboard']);

    $routes->fallbacks('InflectedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
