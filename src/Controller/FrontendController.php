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

use App\Controller\AppFrontController;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use App\Form\ContactForm;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class FrontendController extends AppFrontController {

  public function home() {
    $paginas = TableRegistry::get('Pages')->find()->toArray();
    $servicos[0] = TableRegistry::get('Services')->find()->where(['service_type_id' => 1]);
    $servicos[1] = TableRegistry::get('Services')->find()->where(['service_type_id' => 2]);
    $servicos[2] = TableRegistry::get('Services')->find()->where(['service_type_id' => 3]);

    $projetos = TableRegistry::get('Projects')->toFrontend();
    $noticias = TableRegistry::get('Articles')->toFrontend();
    $clientes = TableRegistry::get('Customers')->toFrontend();

    $contato = new ContactForm();
    if ($this->request->is('post')) {
      if ($contato->execute($this->request->data)) {
        $this->Flash->success('Obrigado! Entraremos em contato o mais breve possível.');
      } else {
        $this->Flash->error('Houve um problema e o formulário não foi enviado.');
      }
    }

    $this->set(compact('paginas', 'servicos', 'projetos', 'noticias', 'clientes','contato'));
  }

  public function servico() {
    $id = $this->request->params['id'];
    $servico = TableRegistry::get('Services')->get($id, ['contain' => ['ServiceTypes']]);
    $this->set('servico', $servico);
    $this->set('_serialize', ['servico']);
  }

  public function projeto() {
    $id = $this->request->params['id'];
    $projeto = TableRegistry::get('Projects')->get($id, ['contain' => ['ProjectImages']]);
    $this->set('projeto', $projeto);
    $this->set('_serialize', ['projeto']);
  }

  public function noticia() {
    $id = $this->request->params['id'];
    $noticia = TableRegistry::get('Articles')->get($id, ['contain' => ['ArticleImages']]);
    $this->set('noticia', $noticia);
    $this->set('_serialize', ['noticia']);
  }

}
