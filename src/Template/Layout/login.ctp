<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <?= $this->Html->charset(); ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= $this->fetch('meta'); ?>

  <title>UWA: <?= $this->fetch('title'); ?></title>

  <?= $this->Html->meta('favicon-update.ico', '/favicon-update.ico', ['type' => 'icon']); ?>
  <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

  <?= $this->Html->css('base.css'); ?>
  <?= $this->fetch('css'); ?>
  <?= $this->Html->css('login.css'); ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <?= $this->Html->script('html5shiv.min.js'); ?>
    <?= $this->Html->script('respond.min.js'); ?>
  <![endif]-->
</head>

<body>
  <div class="login-wrapper">
    <div class="login-form">
      <header class="login-header">
        <h1>UWA</h1>
      </header>

      <?= $this->Flash->render() ?>
      <?= $this->Flash->render('auth') ?>

      <?= $this->fetch('content') ?>
    </div>
  </div>

  <?= $this->Html->script('jquery.min.js'); ?>
  <?= $this->fetch('script'); ?>
  <?= $this->Html->script('login.js'); ?>
</body>
</html>
