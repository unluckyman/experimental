  <div class="login-wrapper">
    <div class="login-form">
      <header class="login-header">
        <h1><?= $this->Html->image('header-logo.png', ['class' => 'logo', 'alt' => 'logo da a3ambiental']); ?></h1>
        <h2>Área do Cliente</h2>
      </header>

      <?= $this->Flash->render() ?>
      <?= $this->Flash->render('auth') ?>

      <?= $this->Form->create(null, ['controller' => 'Clients', 'action' => 'login']) ?>
      <?= $this->Form->input('name', ['label' => ['text' => 'Nº Contrato'], 'placeholder' => 'digite o nº do contrato']) ?>
      <?= $this->Form->input('password', ['label' => ['text' =>'Senha'], 'placeholder' => 'digite sua senha']) ?>
      <?= $this->Form->button('Login', ['class' => 'btn-success btn-block']) ?>
      <?= $this->Form->end() ?>

    </div>
  </div>