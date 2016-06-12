<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function isAuthorized($user) {
        // todos os usuários podem adicionar, visualizar e listar as notícias
        if (in_array($this->request->action, ['add', 'view', 'index'])) {
            return true;
        }

        // somente o autor do artigo pode editá-lo ou deletá-lo (e usuário com permissões admin)
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->paginate = ['contain' => ['Users'], 'sortWhitelist' => ['id', 'title', 'Users.username', 'image', 'created', 'modified']];
        $this->set('articles', $this->paginate($this->Articles->find('all')));
        $this->set('_serialize', ['articles']);
    }

    public function view($id = null) {
        $article = $this->Articles->get($id, ['contain' => ['Users']]);
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    public function add() {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article,
                $this->request->data,
                ['associated' => ['ArticleImages']]
            );

            // o usuário logado é o autor
            $article->user_id = $this->Auth->user('id');
            $article->image = $this->Articles->uploadCover($this->request->data['image']);
            $article->published = NULL;

            if ($this->Articles->save($article)) {
                $this->Flash->success('A notícia foi criada.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('A notícia não pode ser salva. Tente novamente.');
            }
        }
        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
    }

    public function edit($id = null) {
        $article = $this->Articles->get($id, ['contain' => ['Users', 'ArticleImages']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //TODO: melhorar essa lógica
            $imagePath = $this->Articles->editImage($article, $this->request->data['image']);

            $article = $this->Articles->patchEntity($article,
                $this->request->data,
                ['associated' => ['ArticleImages']]
            );

            $article->image = $imagePath;
            $articleImagesDeleted = array();
            if(array_key_exists('images_deleted', $this->request->data)) {
                $articleImagesDeleted = $this->request->data['images_deleted'];
            }

            if ($this->Articles->save($article)) {
                $this->Articles->deleteImages($articleImagesDeleted);
                $this->Flash->success('A notícia foi salva.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('A notícia não pode ser salva. Tente novamente.');
            }
        }
        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);

        if ($this->Articles->delete($article)) {
            $this->Flash->success('A notícia foi excluída.');
        } else {
            $this->Flash->error('A notícia não pode ser excluída. Tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }

    //upload de imagens para a galeria via dropzone
    public function upload() {
        $files = $_FILES['file'];

        if(!empty($files)) {
            $paths = $this->Articles->uploadMultiple($files);
            $paths = json_encode($paths);

            $this->response->statusCode(200);
            $this->response->body($paths);
        } else {
            $this->response->statusCode(500);
        }

        return $this->response;
    }

    //publicar notícia
    public function publish($id = null) {
        $article = $this->Articles->get($id);
        $article->published = new Time();

        $this->Articles->save($article);
        $this->Flash->success('A notícia foi publicada.');

        return $this->redirect(['action' => 'index']);
    }

    //despublicar notícia
    public function unpublish($id = null) {
        $article = $this->Articles->get($id);
        $article->published = NULL;

        $this->Articles->save($article);
        $this->Flash->success('A notícia foi despublicada.');

        return $this->redirect(['action' => 'index']);
    }
}
