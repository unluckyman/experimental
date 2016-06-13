<h1 class="module-title">Cliente <small><?= h($customer->name) ?></small></h1>

<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="row col-xs-12 margin-bottom-45">
      <h4>Nome</h4>
      <?= h($customer->name); ?>
    </div>

    <div class="row">
      <div class="col-xs-6 margin-bottom-45">
        <h4>Criado em </h4>
        <?= $customer->created->format('d/m/Y à\\s H:i') ?>
      </div>

      <div class="col-xs-6 margin-bottom-45">
        <h4>Modificado em</h4>
        <?= $customer->modified->format('d/m/Y à\\s H:i') ?>
      </div>
    </div>

    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom hidden-xs">
      <i class="fa fa-arrow-circle-left"></i> Voltar
    </a>
  </div>

  <div class="row col-xs-12 col-sm-6">
    <h4>Logo</h4>
    <div class="wrap-image">
      <img class="img-responsive img-thumbnail" src="<?= $customer->path ?>" alt="<?= $customer->name ?>">
    </div>
  </div>
</div>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom visible-xs">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>