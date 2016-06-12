<div>
  <!-- Nav tabs -->
  <ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active"><a href="#higiene" aria-controls="home" role="tab" data-toggle="tab">Higiene Ocupacional</a></li>
    <li role="presentation"><a href="#seguranca" aria-controls="seguranca" role="tab" data-toggle="tab">Segurança no Trabalho</a></li>
    <li role="presentation"><a href="#meioambiente" aria-controls="meioambiente" role="tab" data-toggle="tab">Meio Ambiente</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="higiene">
      <?= $this->element('Services/frontend', ['servicos' => $servicos[0]]) ?>
    </div>

    <div role="tabpanel" class="tab-pane" id="seguranca">
      <?= $this->element('Services/frontend', ['servicos' => $servicos[1]]) ?>
    </div>

    <div role="tabpanel" class="tab-pane" id="meioambiente">
      <?= $this->element('Services/frontend', ['servicos' => $servicos[2]]) ?>
    </div>
  </div>

</div>