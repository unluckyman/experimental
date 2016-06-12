<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>A3 Ambiental</title>

  <meta charset="UTF-8">
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300' rel='stylesheet' type='text/css'>

  <?= $this->Html->css('bootstrap.min.css'); ?>
  <?= $this->Html->css('font-awesome.min.css'); ?>
  <?= $this->Html->css('royalslider/royalslider.css'); ?>
  <?= $this->Html->css('royalslider/skins/minimal-white/rs-minimal-white.css'); ?>
  <?= $this->Html->css('lightbox.css'); ?>
  <?= $this->Html->css('a3ambiental.css'); ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <?= $this->Html->script('html5shiv.min.js'); ?>
    <?= $this->Html->script('respond.min.js'); ?>
  <![endif]-->
</head>

<body>
  <?= $this->element('Shared/header') ?>

  <div id="wrap">
    <?= $this->fetch('content') ?>
  </div>

  <?= $this->Html->script('jquery.min.js'); ?>
  <?= $this->Html->script('jquery-migrate.min.js'); ?>
  <?= $this->Html->script('bootstrap.min.js'); ?>
  <?= $this->Html->script('jquery.royalslider.min.js'); ?>
  <?= $this->Html->script('lightbox.min.js'); ?>
  <?= $this->Html->script('a3ambiental.js'); ?>

  <script>
    //Google Analytics
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-37955214-4', 'auto');
    ga('send', 'pageview');
  </script>
</body>
</html>
