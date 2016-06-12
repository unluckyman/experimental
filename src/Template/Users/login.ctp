<?= $this->Form->create(null, ['controller' => 'Users', 'action' => 'login']) ?>
<?= $this->Form->input('username', ['label' => ['text' => 'Usuário'], 'placeholder' => 'digite seu username']) ?>
<?= $this->Form->input('password', ['label' => ['text' =>'Senha'], 'placeholder' => 'digite sua senha']) ?>
<?= $this->Form->button('Login', ['class' => 'btn-primary btn-block']) ?>
<?= $this->Form->end() ?>