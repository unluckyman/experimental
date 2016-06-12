<h1 class="module-title">Projeto <small><?= h($project->name) ?></small></h1>

<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="row col-xs-12 margin-bottom-45">
      <h4>Capa</h4>
      <?php if($project->has('image')): ?>
        <div class="wrap-image">
          <img class="img-responsive img-thumbnail" src="<?= $project->image ?>" alt="<?= $project->name ?>">
        </div>
      <?php else: ?>
        <p>Sem capa</p>
      <?php endif; ?>
    </div>

    <div class="row col-xs-12 margin-bottom-45">
      <h4>Chamada</h4>
      <?= h($project->headline); ?>
    </div>

    <div class="row col-xs-12 margin-bottom-45">
      <h4>Slug</h4>
      <?= $project->slug ?>
    </div>

    <div class="row">
      <div class="col-xs-6 margin-bottom-45">
        <h4>Criado em </h4>
        <?= $project->created->format('d/m/Y à\\s H:i') ?>
      </div>

      <div class="col-xs-6 margin-bottom-45">
        <h4>Modificado em</h4>
        <?= $project->modified->format('d/m/Y à\\s H:i') ?>
      </div>
    </div>

    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom hidden-xs">
      <i class="fa fa-arrow-circle-left"></i> Voltar
    </a>
  </div>

  <div class="col-xs-12 col-sm-6">
    <h4>Conteúdo</h4>
    <?= $project->body ?>
  </div>
</div>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom visible-xs">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>