<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function index() {
        $this->set('customers', $this->paginate($this->Customers));
        $this->set('_serialize', ['customers']);
    }

    public function view($id = null) {
        $customer = $this->Customers->get($id);
        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }

    public function add() {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            $customer->path = $this->Customers->upload($this->request->data['path']);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('O cliente foi salvo'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O cliente não pode ser salvo. Tente novamente.'));
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

    public function edit($id = null) {
        $customer = $this->Customers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $imagePath = $this->Customers->editImage($customer, $this->request->data['path']);
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            $customer->path = $imagePath;

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('O cliente foi salvo'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O cliente não pode ser salvo. Tente novamente.'));
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
