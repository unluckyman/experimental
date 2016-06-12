<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class CreateServiceTypes extends AbstractMigration {
    public function up() {
        $table = $this->table('service_types');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();

        // Cria tipos de serviço iniciais
        $typesTable = TableRegistry::get('ServiceTypes');

        $type = $typesTable->newEntity();
        $type->name = 'Higiene Ocupacional';
        $type->created = time();
        $type->modified = time();
        $typesTable->save($type);

        $type = $typesTable->newEntity();
        $type->name = 'Segurança no Trabalho';
        $type->created = time();
        $type->modified = time();
        $typesTable->save($type);

        $type = $typesTable->newEntity();
        $type->name = 'Meio Ambiental';
        $type->created = time();
        $type->modified = time();
        $typesTable->save($type);
    }

    public function down() {
        $this->dropTable('service_types');
    }
}
