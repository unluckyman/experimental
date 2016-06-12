<header id="header">
  <nav id="navigation" class="navbar navbar-default">
    <div class="header-top hidden-xs">
      <div class="container">
        <div class="col-sm-10">
          +55 79 3303-2310 | +55 79 4102-0215 |
          <a href="mailto:aracaju@a3ambiental.com.br">aracaju@a3ambiental.com.br</a>
        </div>
        <div class="col-xs-2 text-right">
          <a href="//www.facebook.com/pages/A3-Ambiental-Protegendo-as-empresa-preservando-a-vida/1059434887419701?sk=timeline" target="_blank">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle-thin fa-stack-2x"></i>
              <i class="fa fa-facebook fa-stack-1x"></i>
            </span>
          </a>
        </div>
      </div>
    </div>

    <div class="header-logo">
      <div class="container">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">alternar navegação</span>
          <i class="fa fa-align-justify fa-lg"></i>
        </button>
        <a href="<?= $this->Url->build(['_name' => 'home']) ?>">
          <?= $this->Html->image('header-logo.png', ['class' => 'logo', 'alt' => 'logo da a3ambiental']); ?>
        </a>
      </div>
    </div>

    <?php if($this->request->params['action'] === 'home'): ?>
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#inicio">Início</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#servicos">Serviços</a></li>
            <li><a href="#projetos">Projetos</a></li>
            <li><a href="#noticias">Notícias</a></li>
            <li><a href="#clientes">Clientes</a></li>
            <li><a href="#contato">Contato</a></li>
          </ul>
        </div>
      </div>
    <?php else: ?>
      <div class="container">
        <div class="col-xs-12">
          <?= $this->Html->link('<< Voltar', ['_name' => 'home'], ['class' => 'breadcrumb_link']) ?>
        </div>
      </div>
    <?php endif; ?>
  </nav>
</header>
