<div class="row">
  <?php foreach ($servicos as $servico): ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 service">
      <a href="<?= $this->Url->build(['_name' => 'servico', 'id'=> $servico->id]) ?>" class="card-block-link">
        <div class="card card-block">
          <h4 class="card-title"><?= $servico->name ?></h4>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>