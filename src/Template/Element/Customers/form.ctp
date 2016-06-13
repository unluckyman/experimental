<?= $this->Form->create($customer, [
  'type' => 'file', 'id' => 'customer_form', 'class'=> 'has-file-input',
  'novalidate' => 'novalidate', 'data-folder' => 'customers', 'data-model' => 'customer'
]) ?>

<div class="col-xs-12 col-md-6">
  <?= $this->Form->input('name',
    ['label' => ['text' => 'Nome', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
    'class' => 'required'])
  ?>

  <div class="form-group required text">
    <label for="image-input" class="control-label" data-toggle="tooltip" data-placement="right" title="Campo Obrigatório">Logo</label>
    <div class="input-group">
      <span class="input-group-btn">
        <span class="btn btn-default btn-file">
          Selecione&hellip;
          <input id="image-input" name="path" type="file">
        </span>
      </span>
      <input id="image-filename" type="text" class="form-control" readonly>
    </div>
  </div>
</div>

<div class="col-xs-12 col-md-6">
  <div class="image-preview-wrap">
    <img id="image-preview" class="image-preview img-thumbnail" src="<?= (!empty($customer->image)) ? $customer->image : '' ?>">
  </div>
</div>

<?= $this->Form->button('Salvar', ['class' => 'btn-success btn-lg']) ?>
<?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default btn-lg btn-margin-left']) ?>

<?= $this->Form->end() ?>