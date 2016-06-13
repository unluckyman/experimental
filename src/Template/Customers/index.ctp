<h1 class="module-title">Clientes</h1>

<a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-success btn-margin-bottom">
  <i class="fa fa-plus"></i> Adicionar
</a>

<?php if(count($customers) > 0): ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', '#') ?></th>
          <th><?= $this->Paginator->sort('name', 'Nome') ?></th>
          <th class="visible-lg"><?= $this->Paginator->sort('created', 'Criado em') ?></th>
          <th class="visible-lg"><?= $this->Paginator->sort('modified', 'Modificado em') ?></th>
          <th class="actions" colspan="3"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($customers as $customer): ?>
          <tr>
            <td><?= $this->Number->format($customer->id) ?></td>
            <td><?= h($customer->name) ?></td>
            <td class="visible-lg"><?= $customer->created->format('d/m/Y à\\s H:i') ?></td>
            <td class="visible-lg"><?= $customer->modified->format('d/m/Y à\\s H:i') ?></td>
            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'view', $customer->id]) ?>" class="btn btn-primary">
                <i class="fa fa-eye"></i> Visualizar
              </a>
            </td>

            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'edit', $customer->id]) ?>" class="btn btn-warning">
                <i class="fa fa-edit"></i> Editar
              </a>
            </td>

            <td class="actions">
              <?php
                if($authUser->hasAdminPrivileges()) {
                  echo $this->Form->postButton(
                    '<i class="fa fa-trash"></i> Excluir',
                    ['action' => 'delete', $customer->id],
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