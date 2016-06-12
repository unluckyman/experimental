<div class="container margin-bottom-45">
  <div class="row margin-top-45 margin-bottom-45">
    <div class="col-md-2 element-title">Notícia</div>
    <div class="col-md-10 element-text"><strong><?= h($noticia->title) ?></strong></div>
  </div>

  <div class="row margin-top-45 margin-bottom-45">
    <div class="col-md-2 element-title">Chamada</div>
    <div class="col-md-10 element-text"><?= h($noticia->headline) ?></div>
  </div>

  <div class="row">
    <div class="col-md-2 element-title">Conteúdo</div>
    <div class="col-md-10 element-text"><?= $noticia->body ?></div>
  </div>

  <?php if($noticia->article_images): ?>
    <div class="row margin-top-45">
      <div class="col-md-2 element-title">Galeria</div>
      <div class="col-md-10 element-text">
        <?php foreach ($noticia->article_images as $i => $imagem): ?>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card card-inverse">
              <a href="<?= $imagem->path ?>" data-lightbox="gallery" data-title="<?= $noticia->name ?>">
                <img src="<?= $imagem->path ?>" class="card-img-top" alt="imagem do noticia <?= $noticia->name ?>">
              </a>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif; ?>
</div>
