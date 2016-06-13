<h1 class="module-title">Usuário <small><?= h($user->username) ?></small></h1>

<div class="row">
  <div class="col-xs-12 margin-bottom-45">
    <h4>Nome</h4>
    <?= h($user->name) ?>
  </div>

  <div class="col-xs-6 col-sm-4 margin-bottom-45">
    <h4>Criado em</h4>
    <?= $user->created->format('d/m/Y à\\s H:i'); ?>
  </div>

  <div class="col-xs-6 col-sm-4 margin-bottom-45">
    <h4>Modificado em</h4>
    <?= $user->modified->format('d/m/Y à\\s H:i'); ?>
  </div>

  <div class="col-xs-12 col-sm-4 margin-bottom-45">
    <h4>Ativo</h4>
    <?= $user->active ? 'Sim' : 'Não'; ?>
  </div>
</div>

<a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-margin-bottom">
  <i class="fa fa-arrow-circle-left"></i> Voltar
</a>
