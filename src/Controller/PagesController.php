<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 */
class PagesController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function isAuthorized($user) {
        // All registered users can add, view and list articles
        if (in_array($this->request->action, ['view', 'index'])) {
            return true;
        }

        // only dev can add and delete pages
        if (in_array($this->request->action, ['add', 'delete'])) {
            if ($user['role'] != 'dev') {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->set('pages', $this->paginate($this->Pages));
        $this->set('_serialize', ['pages']);
    }

    /**
     * View method
     *
     * @param string|null $id Page id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $page = $this->Pages->newEntity();
        if ($this->request->is('post')) {
            $page = $this->Pages->patchEntity($page, $this->request->data);
            if ($this->Pages->save($page)) {
                $this->Flash->success('A página foi salva.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('A página não pode ser salva. Tente novamente.');
            }
        }
        $this->set(compact('page'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->data);
            if ($this->Pages->save($page)) {
                $this->Flash->success('A página foi salva.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('A página não pode ser salva. Tente novamente.');
            }
        }
        $this->set(compact('page'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success('A página foi excluída.');
        } else {
            $this->Flash->error('A página não pode ser excluída. Tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
