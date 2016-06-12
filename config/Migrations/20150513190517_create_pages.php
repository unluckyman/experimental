<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class CreatePages extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('pages');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('slug', 'string', [
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
        $table->addIndex('slug');
        $table->create();

        // Cria páginas iniciais
        $pagesTable = TableRegistry::get('Pages');

        $page = $pagesTable->newEntity();
        $page->title = 'Sobre';
        $page->body = '<p>Com larga experiência na prestação de consultoria e serviços de <strong>Engenharia de Segurança, Higiene Ocupacional
            e Meio Ambiente</strong>, a A3 Ambiental conta com uma equipe multidisciplinar de colaboradores e parceiros com competência
            profissional para diagnosticar e formular soluções e projetos criativos, que proporcionam aos nossos clientes um diferencial
            no mercado.</p><p>A A3 Ambiental veio ao mercado com a proposta de buscar soluções eficazes, econômicas e tecnicamente viáveis
            para sua empresa, que assegurem a continuidade da geração de riqueza com responsabilidade socioambiental, garantindo assim, a
            imagem da organização perante clientes, órgãos ambientais e a comunidade.</p>';
        $page->slug = 'sobre';

        $pagesTable->save($page);
    }
}
