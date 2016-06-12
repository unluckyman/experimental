<h1 class="module-title">Usuários</h1>

<a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-success btn-margin-bottom">
  <i class="fa fa-plus"></i> Adicionar
</a>

<?php if(count($users) > 0): ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', '#') ?></th>
          <th><?= $this->Paginator->sort('name', 'Nome') ?></th>
          <th><?= $this->Paginator->sort('username', 'Usuário') ?></th>
          <th><?= $this->Paginator->sort('role', 'Perfil') ?></th>
          <th><?= $this->Paginator->sort('created', 'Criado em') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado em') ?></th>
          <th class="actions" colspan="3"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user->id ?></td>
            <td><?= h($user->name) ?></td>
            <td><?= h($user->username) ?></td>
            <td><?= h($user->role) ?></td>
            <td><?= $user->created->format('d/m/Y à\\s H:i') ?></td>
            <td><?= $user->modified->format('d/m/Y à\\s H:i') ?></td>
            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'view', $user->id]) ?>" class="btn btn-primary">
                <i class="fa fa-eye"></i> Visualizar
              </a>
            </td>

            <td>
              <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="btn btn-warning">
                <i class="fa fa-edit"></i> Editar
              </a>
            </td>

            <td>
              <?php
                echo $this->Form->postButton(
                  '<i class="fa fa-trash"></i> Excluir',
                  ['action' => 'delete', $user->id],
                  ['class' => 'btn btn-danger post-button']
                );
              ?>
            </td>
          </tr>

        <?php endforeach; ?>
      </tbody>
    </table>

    <?php echo $this->element('Shared/pagination', ['paginator' => $this->Paginator]); ?>
  </div>
<?php endif; ?>