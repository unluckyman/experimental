<div class="client-home">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navegação alternativa</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?= $this->Html->image('header-logo.png', ['class' => 'navbar-brand', 'alt' => 'logo da a3ambiental']); ?></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= $this->Url->build(['_name' => 'client_logout']) ?>" class="logout-link">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="jumbotron">
      <h3>Nº Contrato <?= $client->name ?></h3>
      <h4>Arquivos para download</h4>
      <?php if(count($client->contract_images)>0): ?>
        <div class="list-group">
          <?php foreach ($client->contract_images as $image): ?>
            <a href="<?= $this->Url->build(['_name' => 'client_download', 'id' => $image->id]) ?>" class="list-group-item">
              <?= $image->name ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Você não possui arquivos</p>
      <?php endif; ?>
    </div>

    <footer class="footer text-right">
      Desenvolvido por <a href="//updatesolucoes.com.br" target="_blank">Update Soluções</a> &copy; 2015
    </footer>
  </div>
</div>