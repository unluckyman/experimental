<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectImages Controller
 *
 * @property \App\Model\Table\ProjectImagesTable $ProjectImages
 */
class ProjectImagesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects']
        ];
        $this->set('projectImages', $this->paginate($this->ProjectImages));
        $this->set('_serialize', ['projectImages']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Image id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectImage = $this->ProjectImages->get($id, [
            'contain' => ['Projects']
        ]);
        $this->set('projectImage', $projectImage);
        $this->set('_serialize', ['projectImage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectImage = $this->ProjectImages->newEntity();
        if ($this->request->is('post')) {
            $projectImage = $this->ProjectImages->patchEntity($projectImage, $this->request->data);
            if ($this->ProjectImages->save($projectImage)) {
                $this->Flash->success(__('The project image has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project image could not be saved. Please, try again.'));
            }
        }
        $projects = $this->ProjectImages->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectImage', 'projects'));
        $this->set('_serialize', ['projectImage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Image id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectImage = $this->ProjectImages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectImage = $this->ProjectImages->patchEntity($projectImage, $this->request->data);
            if ($this->ProjectImages->save($projectImage)) {
                $this->Flash->success(__('The project image has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project image could not be saved. Please, try again.'));
            }
        }
        $projects = $this->ProjectImages->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectImage', 'projects'));
        $this->set('_serialize', ['projectImage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Image id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectImage = $this->ProjectImages->get($id);
        if ($this->ProjectImages->delete($projectImage)) {
            $this->Flash->success(__('The project image has been deleted.'));
        } else {
            $this->Flash->error(__('The project image could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
