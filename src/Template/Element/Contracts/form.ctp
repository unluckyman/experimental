<?php
  $this->start('css');
    echo $this->Html->css('dropzone.min.css');
    echo $this->Html->css('dropzone-basic.css');
  $this->end();

  $this->start('script');
    echo $this->Html->script('dropzone.min.js');
    echo $this->Html->script('dropzone-files-config.js');
  $this->end();
?>

<?= $this->Form->create($contract, [
  'type' => 'file', 'id' => 'dropzone_form', 'class'=> 'has-file-input',
  'novalidate' => 'novalidate', 'data-folder' => 'contracts', 'data-model' => 'contract'
]) ?>

<div class="row">
  <div class="col-md-6">
    <?= $this->Form->input('name',
      ['label' => ['text' => 'Nº do Contrato', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
      'class' => 'required']);
    ?>
  </div>

  <div class="col-md-6">
    <?= $this->Form->input('password',
      ['label' => ['text' => 'Senha', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
      'class' => 'required']);
    ?>
  </div>
</div>

<label for="dropzone">Arquivos</label>
<?php if(count($contract->contract_images)>0): ?>
<div class="uwa-images">
  <ul>
    <?php foreach ($contract->contract_images as $image): ?>
      <li class="text-center">
        <a class="images-delete" href="#" title="<?= $image->name ?>" data-id="<?= $image->id; ?>">
          <i class="fa fa-minus-circle fa-2x"></i>
        </a>
        <a href="<?= $this->Url->build(['action' => 'download', $image->id]) ?>" title="<?= $image->name ?>">
          <?= $image->name ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<div id="dropzone" class="dropzone"></div>

<?= $this->Form->button('Salvar', ['class' => 'btn-success btn-lg']) ?>
<?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default btn-lg btn-margin-left']) ?>

<?= $this->Form->end(); ?>