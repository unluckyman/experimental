<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <?= $this->Html->charset(); ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= $this->fetch('meta'); ?>

  <title>UWA: <?= $this->fetch('title'); ?></title>

  <?= $this->Html->meta('favicon-update.ico', '/favicon-update.ico', ['type' => 'icon']); ?>

  <?= $this->Html->css('bootstrap.min.css'); ?>
  <?= $this->Html->css('font-awesome.min.css'); ?>
  <?= $this->fetch('css'); ?>
  <?= $this->Html->css('admin.css'); ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <?= $this->Html->script('html5shiv.min.js'); ?>
    <?= $this->Html->script('respond.min.js'); ?>
  <![endif]-->
</head>

<body>
  <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= $this->Url->build(['_name' => 'dashboard']) ?>">UWA</a>
      </div>

      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li <?= $this->highlightController('Contracts'); ?>>
            <?= $this->Html->link('Contratos', ['controller' => 'Contracts', 'action' => 'index']) ?>
          </li>

          <li <?= $this->highlightController('Customers'); ?>>
            <?= $this->Html->link('Clientes', ['controller' => 'Customers', 'action' => 'index']) ?>
          </li>

          <li <?= $this->highlightController('Projects'); ?>>
            <?= $this->Html->link('Projetos', ['controller' => 'Projects', 'action' => 'index']) ?>
          </li>

          <li <?= $this->highlightController('Services'); ?>>
            <?= $this->Html->link('Serviços', ['controller' => 'Services', 'action' => 'index']) ?>
          </li>

          <li <?= $this->highlightController('Pages'); ?>>
            <?= $this->Html->link('Páginas', ['controller' => 'Pages', 'action' => 'index']) ?>
          </li>

          <li <?= $this->highlightController('Articles') ?>>
            <?= $this->Html->link('Notícias', ['controller' => 'Articles','action' => 'index']) ?>
          </li>

          <?php if($authUser->hasAdminPrivileges()): ?>
            <li <?= $this->highlightController('Users'); ?>>
              <?= $this->Html->link('Usuários', ['controller' => 'Users', 'action' => 'index']) ?>
            </li>
          <?php endif; ?>

          <li class="logout">
            <?= $this->Html->link('Sair', ['_name' => 'logout']) ?>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <div class="main">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <?= $this->Flash->render() ?>
          <?= $this->Flash->render('auth') ?>

          <?= $this->fetch('content') ?>
        </div>
      </div>
    </div>
  </div>

  <?= $this->Html->script('jquery.min.js'); ?>
  <?= $this->Html->script('jquery-migrate.min.js'); ?>
  <?= $this->Html->script('bootstrap.min.js'); ?>
  <?= $this->fetch('script'); ?>
  <?= $this->Html->script('admin.js'); ?>
</body>
</html>
