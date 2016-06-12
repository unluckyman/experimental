<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\i18n\i18n;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $helpers = [
        'Html' => ['className' => 'Bootstrap3.BootstrapHtml'],
        'Form' => [
            'className' => 'Bootstrap3.BootstrapForm',
            'useCustomFileInput' => false
        ],
        'Paginator' => ['className' => 'Bootstrap3.BootstrapPaginator'],
        'Modal' => ['className' => 'Bootstrap3.BootstrapModal']
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authError' => 'Sem permissão de acesso.',
            'unauthorizedRedirect' => ['controller' => 'Users', 'action' => 'dashboard'],
            'loginRedirect' => ['controller' => 'Users', 'action' => 'dashboard']
        ]);
    }

    public function isAuthorized($user) {
        // dev and admin can access every action
        if (isset($user['role']) && ($user['role'] === 'admin' || $user['role'] === 'dev')) {
            return true;
        }

        // default deny
        return false;
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->sessionKey = 'Auth.User';

        //instância de usuário caso esteja autenticado
        if($this->Auth->user()) {
            $authUser = new User($this->Auth->user(), ['markClean' => true, 'markNew' => false, 'source' => 'Users']);
            $this->set(compact('authUser'));
        }
    }
}
