<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up() {
        $table = $this->table('users');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('username', 'string', [
            'default' => null,
            'limit' => 40,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('role', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => 20,
        ]);
        $table->addColumn('active', 'boolean', [
            'default' => true,
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
        $table->addIndex('username', ['unique' => true]);
        $table->create();

        // Cria usuário inicial
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->newEntity();

        $user->name = 'Update Soluções';
        $user->username = 'update';
        $user->password = 'admin@01';
        $user->role = 'dev';
        $user->created = time();
        $user->modified = time();
        $user->active = true;

        $usersTable->save($user);
    }

    public function down() {
        $this->dropTable('users');
    }
}
