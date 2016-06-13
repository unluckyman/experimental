<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class CreateServices extends AbstractMigration {
    public function up() {
        $table = $this->table('services');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('definition', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('info', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('service_type_id', 'integer', [
            'default' => null,
            'limit' => 11,
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
        $table->addForeignKey('service_type_id', 'service_types', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);
        $table->create();

        // dados iniciais
        $higienes = [
            ['LTCAT e PPRA', 'definição', '(Emissão e acompanhamento das recomendações/cronogramas de ação)'],
            ['PPP', 'definição', 'info'],
            ['Inventário de produtos químicos por setor', 'definição', 'info'],
            ['Controle de EPI’s', 'definição', 'info'],
            ['Controle dos equipamentos de controle – EPC’s', 'definição', 'info'],
            ['Auditorias de conformidade', 'definição', 'info'],
            ['Treinamentos', 'definição', 'info'],
            ['Equipamentos de monitoração', 'definição', 'Histórico de manutenções, Controle de calibrações'],
            ['Saúde Ocupacional', 'definição', 'PCMSO (Emissão e acompanhamento das recomendações/cronogramas de ação)'],
        ];

        $segurancas = [
            ['Laudo de Periculosidade (Emissão e acompanhamento das recomendações)', 'definição', 'Trabalhadores autorizados'],
            ['Acidentes do trabalho', 'definição', 'Investigação de acidentes, CAT (emissão e controle), Inspeções de segurança (Levantamento de não conformidades, Controle das não conformidades tratadas x não conformidades encontradas)'],
            ['Sinalização de segurança', 'definição', 'Manutenção e controle'],
            ['Prevenção e combate a incêndio', 'definição', 'Inspeções de equipamentos para combate fixos/móveis, Simulados (Cronograma e avaliações), Localização e validade'],
            ['Treinamentos', 'definição', 'Cronograma e participações, Controle de evidências'],
            ['Diálogos de Segurança', 'definição', 'Cronograma e participações, Controle de evidências'],
            ['Auditórias de SST', 'definição', 'Cronograma, Controle de tratativas, Controle de evidências'],
            ['Instruções de Segurança', 'definição', 'Controle documental (alterações e revisões), Treinamentos com link para cada função a qual se aplica a instrução., Controle de participação nos treinamentos'],
            ['APR – Analise Preliminar de Riscos por Tarefas', 'definição', 'Controle documental (alterações e revisões), Treinamentos com link para cada função a qual se aplica a instrução., Controle de participação nos treinamentos'],
            ['Ordens de Serviço', 'definição', 'Controle documental (alterações e revisões), Treinamentos com link para cada função a qual se aplica a instrução., Controle de participação nos treinamentos'],
            ['Espaços Confinados', 'definição', 'Cadastro e prontuário, Treinamentos dos trabalhadores autorizados, Controle de manutenções e entradas, Histórico das avalições ambientais'],
            ['Prevenção a incêndios', 'definição', 'Inspeções de equipamentos para combate fixos/móveis, Simulados (Cronograma e avaliações), Controle de manutenções e entradas, Histórico das avalições ambientais'],
        ];

        $meios = [
            ['PGRS  (Emissão e acompanhamento das recomendações/cronogramas de ação)', 'definição', 'info'],
            ['Gestão de efluentes', 'definição', 'Controle da qualidade dos efluentes lançados (Padrão CONAMA), Controle da quantidade dos efluentes lançados'],
            ['Licença ambiental', 'definição', 'Documentos gerados (controle documental dos projetos e memoriais), Controle das condicionantes - acompanhamento das recomendações e cronograma de ação, Validade e alterações'],
            ['PEA – Plano de Emergências Ambientais (Emissão e acompanhamento)', 'definição', 'Simulados (Cronograma e avaliações)'],
            ['Controle das emissões sonoras', 'definição', 'Laudo de ruído – NBR 10.151/10.152'],
            ['Auditorias ambientais', 'definição', 'info'],
            ['Programa de controle ambiental', 'definição', 'Monitoração VOC em poços piezométricos, Avalição e monitoração de contaminação em solo, Avaliação e controle dos corpos receptores'],
            ['Programa da qualidade da saúde humana', 'definição', 'Monitoração e controle da água potável – ANVISA, Monitoração e controle da qualidade do ar em ambientes climatizados - ANVISA'],
        ];

        $dados = [$higienes, $segurancas, $meios];
        $servicesTable = TableRegistry::get('Services');

        foreach ($dados as $id => $tipos) {
            foreach ($tipos as $servico) {
                $service = $servicesTable->newEntity();
                $service->name = $servico[0];
                $service->definition = $servico[1];
                $service->info = $servico[2];
                $service->service_type_id = $id + 1;
                $service->created = time();
                $service->modified = time();
                $servicesTable->save($service);
            }
        }
    }

    public function down() {
        $this->dropTable('services');
    }
}
