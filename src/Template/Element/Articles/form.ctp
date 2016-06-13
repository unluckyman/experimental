<?php
  $this->start('css');
    echo $this->Html->css('dropzone.min.css');
    echo $this->Html->css('dropzone-basic.css');
  $this->end();

  $this->start('script');
    echo $this->Html->script('dropzone.min.js');
    echo $this->Html->script('dropzone-images-config.js');
    echo $this->Html->script('../ckeditor/ckeditor.js');
  $this->end();
?>

<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#dados" aria-controls="dados" role="tab" data-toggle="tab">Dados Gerais</a></li>
  <li role="presentation"><a href="#imagens" aria-controls="imagens" role="tab" data-toggle="tab">Imagens</a></li>
</ul>

<?= $this->Form->create($article, [
  'type' => 'file', 'id' => 'dropzone_form', 'class'=> 'has-file-input',
  'novalidate' => 'novalidate', 'data-folder' => 'articles', 'data-model' => 'article'
]) ?>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="dados">
    <?= $this->Form->input('title',
      ['label' => ['text' => 'Título', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
      'class' => 'required'])
    ?>

    <?= $this->Form->input('headline',
      ['label' => ['text' => 'Chamada', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
      'class' => 'required'])
    ?>

    <?= $this->Form->input('body',
      ['label' => ['text' => 'Conteúdo', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Campo Obrigatório'],
      'class' => 'ckeditor required'])
    ?>
  </div>

  <div role="tabpanel" class="tab-pane" id="imagens">
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <label for="image-input">Imagem de capa</label>
        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-default btn-file">
              Selecione&hellip; <input id="image-input" name="image" type="file">
            </span>
          </span>
          <input id="image-filename" type="text" class="form-control" readonly value="<?= basename($article->image) ?>">
        </div>
        <div class="image-preview-wrap">
          <img id="image-preview" class="image-preview img-thumbnail" src="<?= (!empty($article->image)) ? $article->image : '' ?>">
        </div>
      </div>

      <div class="col-xs-12 col-sm-8">
        <label for="dropzone">Imagens para galeria</label>
        <?php if(count($article->article_images)>0): ?>
        <div class="uwa-images">
          <ul>
            <?php foreach ($article->article_images as $image): ?>
              <li>
                <a class="images-delete" href="#" data-id="<?= $image->id; ?>"><i class="fa fa-minus-circle fa-2x"></i></a>
                <img src="<?= $image->path; ?>" alt="imagem" class="img-responsive">
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        <div id="dropzone" class="dropzone"></div>
      </div>
    </div>
  </div>
</div>

<?= $this->Form->button('Salvar', ['class' => 'btn-success btn-lg']) ?>
<?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default btn-lg btn-margin-left']) ?>

<?= $this->Form->end() ?>