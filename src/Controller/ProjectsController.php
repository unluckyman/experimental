<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function index() {
        $this->set('projects', $this->paginate($this->Projects));
        $this->set('_serialize', ['projects']);
    }

    public function view($id = null) {
        $project = $this->Projects->get($id, ['contain' => ['ProjectImages']]);
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }

    public function add() {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity(
                $project,
                $this->request->data,
                ['associated' => ['ProjectImages']]
            );

            $project->image = $this->Projects->uploadCover($this->request->data['image']);

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('O projeto foi salvo.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O projeto não pode ser salvo. Tente novamente.'));
            }
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
    }

    public function edit($id = null) {
        $project = $this->Projects->get($id, ['contain' => ['ProjectImages']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //TODO: melhorar essa lógica
            $imagePath = $this->Projects->editImage($project, $this->request->data['image']);

            $project = $this->Projects->patchEntity($project,
                $this->request->data,
                ['associated' => ['ProjectImages']]
            );

            $project->image = $imagePath;
            $projectImagesDeleted = array();
            if(array_key_exists('images_deleted', $this->request->data)) {
                $projectImagesDeleted = $this->request->data['images_deleted'];
            }

            if ($this->Projects->save($project)) {
                $this->Projects->deleteImages($projectImagesDeleted);
                $this->Flash->success(__('O projeto foi salvo.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O projeto não pode ser salvo. Tente novamente.'));
            }
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('O projeto foi excluído'));
        } else {
            $this->Flash->error(__('O projeto não pode ser excluído. Tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    //upload de imagens via dropzone
    public function upload() {
        $files = $_FILES['file'];

        if(!empty($files)) {
            $paths = $this->Projects->uploadMultiple($files);
            $paths = json_encode($paths);

            $this->response->statusCode(200);
            $this->response->body($paths);
        } else {
            $this->response->statusCode(500);
        }

        return $this->response;
    }

}
