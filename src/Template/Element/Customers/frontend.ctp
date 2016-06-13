<div class="row">
  <?php foreach ($clientes as $cliente): ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card card-inverse">
        <img class="card-img-top" src="<?= $cliente->path ?>" alt="<?= $cliente->name ?>">
      </div>
    </div>
  <?php endforeach; ?>
</div>