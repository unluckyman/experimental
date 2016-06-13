<h1 class="module-title">Notícia <small><?= h($article->title) ?></small></h1>

<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="row col-xs-12 margin-bottom-45">
      <h4>Capa</h4>
      <?php if($article->has('image')): ?>
        <div class="wrap-image">
          <img class="img-responsive img-thumbnail" src="<?= $article->image ?>" alt="<?= $article->title ?>">
        </div>
      <?php else: ?>
        <p>Sem capa</p>
      <?php endif; ?>
    </div>

    <div class="row col-xs-12 margin-bottom-45">
      <h4>Chamada</h4>
      <?= h($article->headline); ?>
    </div>

    <div class="row col-xs-12 margin-bottom-45">
      <h4>Slug</h4>
      <?= $article->slug ?>
    </div>

    <div class="row col-xs-12 margin-bottom-45">
      <h4>Autor</h4>
      <?= $article->has('user') ? $article->user->name : '' ?>
    </div>

    <div class="row col-xs-12 margin-bottom-45">
      <h4>Publicado</h4>
      <?= $article->published ? 'Sim' : 'Não'; ?>
    </div>

    <div class="row">
      <div class="col-xs-6 margin-bottom-45">
        <h4>Criado em </h4>
        <?= $article->created->format('d/m/Y à\\s H:i') ?>
      </div>

      <div class="col-xs-6 margin-bottom-45">
        <h4>Modificado em</h4>
        <?= $article->modified->format('d/m/Y à\\s H:i') ?>
      </div>
    </div>

    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom hidden-xs">
      <i class="fa fa-arrow-circle-left"></i> Voltar
    </a>
  </div>

  <div class="col-xs-12 col-sm-6">
    <h4>Conteúdo</h4>
    <?= $article->body ?>
  </div>
</div>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom visible-xs">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>