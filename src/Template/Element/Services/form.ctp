<?= $this->Form->create($service, ['type' => 'file', 'id' => 'service_form', 'class'=> 'has-file-input', 'novalidate' => 'novalidate']) ?>
  <div class="row">
    <div class="col-xs-12 col-sm-6">
      <?= $this->Form->input('name',
        ['label' => ['text' => 'Nome', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
        'class' => 'required'])
      ?>
    </div>

    <div class="col-xs-12 col-sm-6">
      <?= $this->Form->input('service_type_id',
        ['type' => 'select', 'options' => $types,
        'container' => ['class' => 'required'],
        'label' => ['text' => 'Tipo', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
        'class' => 'required']) ?>
    </div>

    <div class="col-xs-12">
      <?= $this->Form->input('definition',
        ['label' => ['text' => 'Definição', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório', 'class' => 'required'],
        'class' => 'required'])
      ?>
    </div>

    <div class="col-xs-12">
      <?= $this->Form->input('info',
        ['label' => ['text' => 'Outras Informações', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
        'class' => 'required'])
      ?>
    </div>
  </div>

  <?= $this->Form->button('Salvar', ['class' => 'btn-success btn-lg']) ?>
  <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default btn-lg btn-margin-left']) ?>
<?= $this->Form->end() ?>
