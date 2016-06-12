<h1 class="module-title">Páginas</h1>

<?php if($authUser->hasDevPrivileges()): ?>
  <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-success btn-margin-bottom">
    <i class="fa fa-plus"></i> Adicionar
  </a>
<?php endif; ?>

<?php if(count($pages) > 0): ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', '#') ?></th>
          <th><?= $this->Paginator->sort('title', 'Título') ?></th>
          <th><?= $this->Paginator->sort('created', 'Criado em ') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado em') ?></th>
          <th class="actions" colspan="3"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pages as $page): ?>
          <tr>
            <td><?= $page->id ?></td>
            <td><?= h($page->title) ?></td>
            <td><?= $page->created->format('d/m/Y à\\s H:i') ?></td>
            <td><?= $page->modified->format('d/m/Y à\\s H:i') ?></td>
            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'view', $page->id]) ?>" class="btn btn-primary">
                <i class="fa fa-eye"></i> Visualizar
              </a>
            </td>

            <td>
              <a href="<?= $this->Url->build(['action' => 'edit', $page->id]) ?>" class="btn btn-warning">
                <i class="fa fa-edit"></i> Editar
              </a>
            </td>

            <td>
              <?php
                if($authUser->hasDevPrivileges()) {
                  echo $this->Form->postButton(
                    '<i class="fa fa-trash"></i> Excluir',
                    ['action' => 'delete', $page->id],
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