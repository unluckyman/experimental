<div class="row">
  <?php foreach ($projetos as $projeto): ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card card-inverse">
        <img class="card-img-top" src="<?= $projeto->image ?>" alt="<?= $projeto->name ?>">
        <div class="card-block">
          <h4 class="card-title"><?= $projeto->name ?></h4>
          <p class="card-text"><?= h($projeto->headline) ?></p>
          <p class="card-text"><a href="<?= $this->Url->build(['_name' => 'projeto', 'id'=> $projeto->id]) ?>" class="btn btn-default">Saiba +</a></p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>