<?= $this->Form->create($user); ?>

<?= $this->Form->input('name',
  ['label' => ['text' => 'Nome', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
  'class' => 'required']);
?>

<?= $this->Form->input('username',
  ['label' => ['text' => 'Usuário', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
  'class' => 'required']);
?>

<?= $this->Form->input('password',
  ['label' => ['text' => 'Senha', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
  'class' => 'required']);
?>

<?= $this->Form->input('role',
  ['label' => ['text' => 'Perfil', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
  'class' => 'required', 'options' => $roles]);
?>

<?= $this->Form->button('Salvar', ['class' => 'btn-success btn-lg']) ?>
<?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default btn-lg btn-margin-left']) ?>

<?= $this->Form->end(); ?>