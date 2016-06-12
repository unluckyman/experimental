<?= $this->Html->script('../ckeditor/ckeditor.js'); ?>

<?= $this->Form->create($page); ?>

<?= $this->Form->input('title',
  ['label' => ['text' => 'Título', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
  'class' => 'required']);
?>

<?= $this->Form->input('body', ['label' => ['text' => 'Texto'], 'class' => 'ckeditor']); ?>

<?= $this->Form->button('Salvar', ['class' => 'btn-success btn-lg']) ?>
<?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default btn-lg btn-margin-left']) ?>

<?= $this->Form->end() ?>
