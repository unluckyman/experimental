<h1 class="module-title">Notícias</h1>

<a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-success btn-margin-bottom">
  <i class="fa fa-plus"></i> Adicionar
</a>

<?php if(count($articles) > 0): ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', '#') ?></th>
          <th><?= $this->Paginator->sort('title', 'Título') ?></th>
          <th><?= $this->Paginator->sort('Users.name', 'Autor') ?></th>
          <th><?= $this->Paginator->sort('published', 'Publicado em') ?></th>
          <th class="visible-lg"><?= $this->Paginator->sort('created', 'Criado em') ?></th>
          <th class="visible-lg"><?= $this->Paginator->sort('modified', 'Modificado em') ?></th>
          <th class="actions" colspan="4"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $article): ?>
          <tr>
            <td><?= $this->Number->format($article->id) ?></td>
            <td><?= h($article->title) ?></td>
            <td><?= $article->has('user') ? h($article->user->name) : '' ?></td>
            <td><?= $article->published ? $article->published->format('d/m/Y à\\s H:i') : 'Não Publicado' ?></td>
            <td class="visible-lg"><?= $article->created->format('d/m/Y à\\s H:i') ?></td>
            <td class="visible-lg"><?= $article->modified->format('d/m/Y à\\s H:i') ?></td>
            <td class="actions">
              <?php if($article->isPublished()): ?>
                <a href="<?= $this->Url->build(['action' => 'unpublish', $article->id]) ?>" class="btn btn-info">
                  <i class="fa fa-square-o"></i> Despublicar
                </a>
              <?php else: ?>
                <a href="<?= $this->Url->build(['action' => 'publish', $article->id]) ?>" class="btn btn-info">
                  <i class="fa fa-check-square-o"></i> Publicar
                </a>
              <?php endif; ?>
            </td>

            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'view', $article->id]) ?>" class="btn btn-primary">
                <i class="fa fa-eye"></i> Visualizar
              </a>
            </td>

            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'edit', $article->id]) ?>" class="btn btn-warning">
                <i class="fa fa-edit"></i> Editar
              </a>
            </td>

            <td class="actions">
              <?php
                if($authUser->hasAdminPrivileges()) {
                  echo $this->Form->postButton(
                    '<i class="fa fa-trash"></i> Excluir',
                    ['action' => 'delete', $article->id],
                    ['class' => 'btn btn-danger post-button']
                  );
                }
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php echo $this->element('Shared/pagination', ['paginator' => $this->Paginator]); ?>
  </div>
<?php endif; ?>