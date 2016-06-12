<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class CreateProjects extends AbstractMigration {
    public function up() {
        $table = $this->table('projects');
        $table->addColumn('image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('headline', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('body', 'text', [
            'default' => null,
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

        //dados iniciais
        $projectsTable = TableRegistry::get('Projects');
        $project = $projectsTable->newEntity();
        $project->name = 'Águas da Amazônia';
        $project->headline = 'Inovar sem esquecer as origens';
        $project->body = 'Inovar sem esquecer as origens';
        $project->created = time();
        $project->modified = time();
        $projectsTable->save($project);
    }

    public function down() {
        $this->dropTable('projects');
    }
}
