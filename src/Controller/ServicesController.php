<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 */
class ServicesController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function index() {
        $this->paginate = ['contain' => ['ServiceTypes'], 'sortWhitelist' => ['id', 'title', 'ServiceTypes.name', 'created', 'modified']];
        $this->set('services', $this->paginate($this->Services));
        $this->set('_serialize', ['services']);
    }

    public function view($id = null) {
        $service = $this->Services->get($id, ['contain' => ['ServiceTypes']]);
        $this->set('service', $service);
        $this->set('_serialize', ['service']);
    }

    public function add() {
        $service = $this->Services->newEntity();
        $types = $this->Services->ServiceTypes->find('list');

        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            if ($this->Services->save($service)) {
                $this->Flash->success('O serviço foi salvo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O serviço não pode ser salvo. Tente novamente.');
            }
        }
        $this->set(compact('service', 'types'));
        $this->set('_serialize', ['service']);
    }

    public function edit($id = null) {
        $service = $this->Services->get($id, ['contain' => ['ServiceTypes']]);
        $types = $this->Services->ServiceTypes->find('list');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            if ($this->Services->save($service)) {
                $this->Flash->success('O serviço foi salvo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O serviço não pode ser salvo. Tente novamente.');
            }
        }
        $this->set(compact('service', 'types'));
        $this->set('_serialize', ['service']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success('O serviço foi excluído.');
        } else {
            $this->Flash->error('O serviço não pode ser excluído. Tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
