<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function isAuthorized($user) {
        if($user && $this->request->action === 'dashboard') {
            return true;
        }

        if ($user && $this->request->action === 'edit') {
            $userId = intval($this->request->params['pass'][0]);

            if($userId  === $user['id']) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'logout']);
    }

    public function index() {
        $this->set('users', $this->paginate($this->Users->filterByRole($this->Auth->user())));
        $this->set('_serialize', ['users']);
    }

    public function view($id = null) {
        $user = $this->Users->get($id);
        $roles = $this->Users->rolesList($this->Auth->user());
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    public function add() {
        $user = $this->Users->newEntity();
        $roles = $this->Users->rolesList($this->Auth->user());

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->active = true;
            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O usuário não pode ser salvo. Tente novamente.');
            }
        }

        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null) {
        $user = $this->Users->get($id);
        $roles = $this->Users->rolesList($this->Auth->user());
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O usuário não pode ser salvo. Tente novamente.');
            }
        }
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('O usuário foi deletado.');
        } else {
            $this->Flash->error('O usuário não pode ser deletado. Tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function dashboard() {
        $this->set('user', $this->Auth->user());
    }

    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Seu usuário ou senha está incorreto.');
        }
    }

    public function logout() {
        $this->Flash->success('Você está desconectado, até breve.');
        return $this->redirect($this->Auth->logout());
    }

    public function toggleActive($id = null) {
        $user = $this->Users->get($id);
        $user->active = !($user->active);

        $this->Users->save($user);

        return $this->redirect(['action' => 'index']);
    }
}
