<h1 class="module-title">Serviços</h1>

<a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-success btn-margin-bottom">
  <i class="fa fa-plus"></i> Adicionar
</a>

<?php if(count($services) > 0): ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', '#') ?></th>
          <th><?= $this->Paginator->sort('ServiceTypes.name', 'Tipo') ?></th>
          <th><?= $this->Paginator->sort('name', 'Título') ?></th>
          <th><?= $this->Paginator->sort('created', 'Criado em ') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado em') ?></th>
          <th class="actions" colspan="3"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($services as $service): ?>
          <tr>
            <td><?= $service->id ?></td>
            <td><?= h($service->service_type->name) ?></td>
            <td><?= h($service->name) ?></td>
            <td><?= $service->created->format('d/m/Y à\\s H:i') ?></td>
            <td><?= $service->modified->format('d/m/Y à\\s H:i') ?></td>
            <td class="actions">
              <a href="<?= $this->Url->build(['action' => 'view', $service->id]) ?>" class="btn btn-primary">
                <i class="fa fa-eye"></i> Visualizar
              </a>
            </td>

            <td>
              <a href="<?= $this->Url->build(['action' => 'edit', $service->id]) ?>" class="btn btn-warning">
                <i class="fa fa-edit"></i> Editar
              </a>
            </td>

            <td>
              <?= $this->Form->postButton('<i class="fa fa-trash"></i> Excluir',
                ['action' => 'delete', $service->id],
                ['class' => 'btn btn-danger post-button']);
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php echo $this->element('Shared/pagination', ['paginator' => $this->Paginator]); ?>
  </div>
<?php endif; ?>