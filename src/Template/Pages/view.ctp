<h1 class="module-title">Página <small><?= h($page->title) ?></small></h1>

<div class="row">
  <div class="col-xs-12 col-sm-4 margin-bottom-45">
    <h4>Slug</h4>
    <?= h($page->slug) ?>
  </div>

  <div class="col-xs-6 col-sm-4 margin-bottom-45">
    <h4>Criado em</h4>
    <?= $page->created->format('d/m/Y à\\s H:i'); ?>
  </div>

  <div class="col-xs-6 col-sm-4 margin-bottom-45">
    <h4>Modificado em</h4>
    <?= $page->modified->format('d/m/Y à\\s H:i'); ?>
  </div>

  <div class="col-xs-12 margin-bottom-45">
    <h4>Conteúdo</h4>
    <?= $page->body ?>
  </div>
</div>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>