<h1 class="module-title">Serviço <small><?= h($service->name) ?></small></h1>

<div class="row">
  <div class="col-xs-12 col-sm-4 margin-bottom-45">
    <h4>Tipo</h4>
    <?= h($service->service_type->name) ?>
  </div>

  <div class="col-xs-6 col-sm-4 margin-bottom-45">
    <h4>Criado em</h4>
    <?= $service->created->format('d/m/Y à\\s H:i'); ?>
  </div>

  <div class="col-xs-6 col-sm-4 margin-bottom-45">
    <h4>Modificado em</h4>
    <?= $service->modified->format('d/m/Y à\\s H:i'); ?>
  </div>

  <div class="col-xs-12 margin-bottom-45">
    <h4>Definição</h4>
    <?= $service->definition ?>
  </div>

  <div class="col-xs-12 margin-bottom-45">
    <h4>Outras Informações</h4>
    <?= $service->info ?>
  </div>
</div>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>