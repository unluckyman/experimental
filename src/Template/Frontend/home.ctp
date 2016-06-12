<main id='main'>
  <div id='inicio'>
    <div id='slider' class='royalSlider heroSlider rsMinW'>
      <?php for($i = 1; $i < 4; $i++): ?>
        <div class='rsContent'>
          <?= $this->Html->image("full-width/banner_".$i.".jpg", ['alt' => 'slider', 'class' => 'rsImg']) ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>

  <div id='sobre' class='bg-parallax'>
    <div class='container'>
      <h1><?= $paginas[0]->title ?></h1>
      <?= $paginas[0]->body ?>
    </div>
  </div>

  <div id='servicos' class='bg-parallax'>
    <div class='container'>
      <h1>Serviços</h1>
      <?= $this->element('ServiceTypes/frontend', ['servicos' => $servicos]) ?>
    </div>
  </div>

  <div id='projetos' class='bg-parallax'>
    <div class='container'>
      <h1>Projetos</h1>
      <?= $this->element('Projects/frontend', ['projetos' => $projetos]) ?>
    </div>
  </div>

  <div id='noticias' class='bg-parallax'>
    <div class='container'>
      <h1>Notícias</h1>
      <?= $this->element('Articles/frontend', ['noticias' => $noticias]) ?>
    </div>
  </div>


  <div id='clientes' class='bg-parallax'>
    <div class='container'>
      <h1>Clientes</h1>
      <?= $this->element('Customers/frontend', ['clientes' => $clientes]) ?>
    </div>
  </div>


  <div id='contato' class='bg-parallax'>
    <div class='container'>
      <div class='col-md-4'>
        <h1>Entre em Contato</h1>
        <p class='text-justify'>
          Aqui, você poderá solicitar informações, elogiar, criticar, sugerir e opinar. Para nós, é um prazer poder ouvir você.
        </p>
        <p><i class='fa fa-phone'></i> (79) 3303-2310 / 4102-0215</p>
        <p><i class='fa fa-phone'></i> (79) 8103-0442 / 8107-5979 / 9831-9767</p>
        <p><i class='fa fa-envelope'></i> <a href='mailto:aracaju@a3ambiental.com.br'>aracaju@a3ambiental.com.br</a></p>
        <p><i class='fa fa-envelope'></i> <a href='mailto:patricia@a3ambiental.com.br'>patricia@a3ambiental.com.br</a></p>
        <p><i class='fa fa-envelope'></i> <a href='mailto:gustavo@a3ambiental.com.br'>gustavo@a3ambiental.com.br</a></p>
        <br>
        <p><a href="https://www.google.com.br/maps/place/R.+Dep.+Francisco+Guedes+Melo,+2+-+Grageru,+Aracaju+-+SE,+49027-270/@-10.9438111,-37.0675092,19z/data=!3m1!4b1!4m2!3m1!1s0x71ab3c49aa6fb31:0xeca30bf71ecf8f06" target="_blank" class="btn btn-success">Google Maps</a></p>
      </div>

      <div class='col-md-8'>
        <h1>&nbsp;</h1>
        <?php
          echo $this->Flash->render();

          echo $this->Form->create($contato);

          echo $this->Form->input('name', ['label' => 'Nome']);
          echo $this->Form->input('email', ['label' => 'E-mail']);
          echo $this->Form->input('body', ['label' => 'Mensagem']);
          echo $this->Form->button('Enviar Mensagem', ['class' => 'btn btn-default']);

          echo $this->Form->end();
        ?>
      </div>
    </div>
  </div>

  <footer id="footer" class="footer">
    <div class="container text-center">
      &copy; 2015 - Todos os direitos reservados. Desenvolvido por <a href="//www.updatesolucoes.com.br" target="_blank">Update Soluções</a>
    </div>
  </footer>


</main>
