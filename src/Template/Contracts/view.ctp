<h1 class="module-title">Contrato <small><?= h($contract->name) ?></small></h1>


<div class="col-xs-12 col-md-4 margin-bottom-45">
  <h4>Nº do Contrato</h4>
  <?= h($contract->name); ?>
</div>

<div class="col-xs-6 col-md-4 margin-bottom-45">
  <h4>Criado em </h4>
  <?= $contract->created->format('d/m/Y à\\s H:i') ?>
</div>

<div class="col-xs-6 col-md-4 margin-bottom-45">
  <h4>Modificado em</h4>
  <?= $contract->modified->format('d/m/Y à\\s H:i') ?>
</div>

<?php if(count($contract->contract_images)>0): ?>
  <div class="col-xs-12 margin-bottom-45">
    <h4>Arquivos Relacionados</h4>
    <ul class="margin-bottom-45">
      <?php foreach ($contract->contract_images as $image): ?>
        <li><a href="<?= $this->Url->build(['action' => 'download', $image->id]) ?>"><?= $image->name ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom hidden-xs">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom visible-xs">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>