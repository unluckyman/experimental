<?php
namespace App\Controller;

use App\Controller\AppController;

class ContractsController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function isAuthorized($user) {
        if ($user && $this->request->action === 'edit') {
            $userId = intval($this->request->params['pass'][0]);

            if($userId  === $user['id']) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->set('contracts', $this->paginate($this->Contracts));
        $this->set('_serialize', ['contracts']);
    }

    public function view($id = null) {
        $contract = $this->Contracts->get($id, ['contain' => ['ContractImages']]);
        $this->set('contract', $contract);
        $this->set('_serialize', ['contract']);
    }

    public function add() {
        $contract = $this->Contracts->newEntity();
        if ($this->request->is('post')) {
            $contract = $this->Contracts->patchEntity(
                $contract,
                $this->request->data,
                ['associated' => ['ContractImages']]
            );
            if ($this->Contracts->save($contract)) {
                $this->Flash->success(__('O contrato foi salvo.'));
                return $this->redirect(['action' => 'index']);
            } else {
                debug($contract);
                die();
                $this->Flash->error(__('O contrato não pode ser salvo. Tente novamente.'));
            }
        }
        $this->set(compact('contract'));
        $this->set('_serialize', ['contract']);
    }

    public function edit($id = null) {
        $contract = $this->Contracts->get($id, ['contain' => ['ContractImages']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contract = $this->Contracts->patchEntity(
                $contract,
                $this->request->data,
                ['associated' => ['ContractImages']]
            );

            $contractImagesDeleted = array();
            if(array_key_exists('images_deleted', $this->request->data)) {
                $contractImagesDeleted = $this->request->data['images_deleted'];
            }

            if ($this->Contracts->save($contract)) {
                $this->Contracts->deleteImages($contractImagesDeleted);
                $this->Flash->success(__('O contrato foi salvo.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O contrato não pode ser salvo. Tente novamente.'));
            }
        }
        $this->set(compact('contract'));
        $this->set('_serialize', ['contract']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contract = $this->Contracts->get($id);
        if ($this->Contracts->delete($contract)) {
            $this->Flash->success(__('O contrato foi excluído'));
        } else {
            $this->Flash->error(__('O contrato não pode ser excluído. Tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    //upload via dropzone
    public function upload() {
        $files = $_FILES['file'];

        if(!empty($files)) {
            $paths = $this->Contracts->uploadMultiple($files);
            $paths = json_encode($paths);

            $this->response->statusCode(200);
            $this->response->body($paths);
        } else {
            $this->response->statusCode(500);
        }

        return $this->response;
    }

    public function download($image_id) {
        $contract_image = $this->Contracts->getContractImageById($image_id);

        $this->response->file($contract_image->fullPath, array(
            'download' => true,
            'name' => $contract_image->name,
        ));

        return $this->response;
    }

}
