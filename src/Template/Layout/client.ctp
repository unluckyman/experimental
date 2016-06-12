<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <?= $this->Html->charset(); ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= $this->fetch('meta'); ?>

  <title>A3Ambiental: Área do Cliente</title>

  <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
  <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

  <?= $this->Html->css('bootstrap.min.css'); ?>
  <?= $this->Html->css('client.css'); ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <?= $this->Html->script('html5shiv.min.js'); ?>
    <?= $this->Html->script('respond.min.js'); ?>
  <![endif]-->
</head>

<body>
  <?= $this->fetch('content') ?>

  <?= $this->Html->script('jquery.min.js'); ?>
  <?= $this->Html->script('bootstrap.min.js'); ?>
  <?= $this->Html->script('client.js'); ?>
</body>
</html>
