<?php

// classe para controlar o acesso de contracts fora do UWA
// o cliente da A3 irá acessar essa parte
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Table\ContractsTable;
use Cake\Datasource\Exception\RecordNotFoundException;

class ClientsController extends Controller {
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

        $this->layout = 'client';

        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'Clients',
                'action' => 'login'
            ],
            'authError' => 'Sem permissão de acesso.',
            'authenticate' => [
                'Basic' => [
                    'userModel' => 'Contracts',
                    'fields' => ['username' => 'name']
                ],
                'Form' => [
                    'userModel' => 'Contracts',
                    'fields' => ['username' => 'name']
                ],
            ],
            'unauthorizedRedirect' => ['controller' => 'Clients', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Clients', 'action' => 'home'],
        ]);
    }

    public function isAuthorized($client) {
        if (isset($client)) {
            return true;
        }
        return false;
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->sessionKey = 'Auth.Contracts';
    }

    public function home() {
        $authUser = $this->Auth->user();
        $table = TableRegistry::get('Contracts');

        $client = $table->get($authUser['id'], ['contain' => ['ContractImages']]);
        $this->set('client', $client);
    }

    public function login() {
        if ($this->request->is('post')) {
            $client = $this->Auth->identify();

            if ($client) {
                $this->Auth->setUser($client);
                return $this->redirect(['_name' => 'client_home']);
            }

            $this->Flash->error('Seu contrato ou senha está incorreto.');
        }
    }

    public function logout() {
        $this->Flash->success('Você está desconectado, até breve.');
        return $this->redirect($this->Auth->logout());
    }

    public function download() {
        $id = $this->request->params['id'];
        $client = $this->Auth->user();

        try {
            $contract_image = TableRegistry::get('Contracts')->getContractImageById($id);
        } catch(RecordNotFoundException $e) {
            $this->Flash->error('Esse arquivo não existe');
            return $this->redirect(['_name' => 'client_home']);
        }

        if($client['id'] === $contract_image['contract_id']) {
            $this->response->file($contract_image->fullPath, array(
                'download' => true,
                'name' => $contract_image->name,
            ));

            return $this->response;
        } else {
            $this->Flash->error('Esse arquivo não pertence a esse contrato');
            return $this->redirect(['_name' => 'client_home']);
        }
    }
}