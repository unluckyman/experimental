<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Articles');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name', 'Nome é requerido');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'Username é requerido');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Senha é requerida');

        $validator
            ->notEmpty('role', 'Perfil é requerido')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author', 'dev']],
                'message' => 'Escolha um perfil válido'
            ]);

        $validator
            ->add('active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('active', 'create')
            ->notEmpty('active', 'Status é requerido');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['username']));
        return $rules;
    }

    public function filterByRole($user) {
        if($user['role'] == 'dev') {
            return $this->find('all');
        }

        return $this->find()->where(['role !=' => 'dev']);
    }

    public function rolesList($user) {
        if($user['role'] == 'dev') {
            return ['admin' => 'Administrador', 'author' => 'Autor', 'dev' => 'Desenvolvedor'];
        }

        return ['admin' => 'Administrador', 'author' => 'Autor'];
    }
}
