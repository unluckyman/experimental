<div class="row">
  <?php foreach ($noticias as $noticia): ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card card-inverse">
        <img class="card-img-top" src="<?= $noticia->image ?>" alt="<?= $noticia->title ?>">
        <div class="card-block">
          <h4 class="card-title"><?= $noticia->title ?></h4>
          <p class="card-text"><?= h($noticia->headline) ?></p>
          <p class="card-text"><a href="<?= $this->Url->build(['_name' => 'noticia', 'id'=> $noticia->id]) ?>" class="btn btn-default">Saiba +</a></p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>