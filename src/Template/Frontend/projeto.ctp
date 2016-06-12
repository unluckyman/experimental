<div class="container margin-bottom-45">
  <div class="row margin-top-45">
    <div class="col-md-2 element-title">Projeto</div>
    <div class="col-md-10 element-text"><strong><?= h($projeto->name) ?></strong></div>
  </div>

  <div class="row margin-top-45">
    <div class="col-md-2 element-title">Resumo</div>
    <div class="col-md-10 element-text"><?= h($projeto->headline) ?></div>
  </div>

  <div class="row margin-top-45">
    <div class="col-md-2 element-title">Conteúdo</div>
    <div class="col-md-10 element-text"><?= $projeto->body ?></div>
  </div>

  <?php if($projeto->project_images): ?>
    <div class="row margin-top-45">
      <div class="col-md-2 element-title">Galeria</div>
      <div class="col-md-10 element-text">
        <?php foreach ($projeto->project_images as $i => $imagem): ?>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card card-inverse">
              <img src="<?= $imagem->path ?>" class="card-img-top" alt="imagem do projeto <?= $projeto->name?>">
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif; ?>

</div>
