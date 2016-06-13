<?php
namespace App\Model\Table;

use App\Model\Entity\ContractImage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;

/**
 * ContractImages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Contracts
 */
class ContractImagesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('contract_images');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Contracts', [
            'foreignKey' => 'contract_id',
            'joinType' => 'INNER'
        ]);
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
            ->requirePresence('path', 'create')
            ->notEmpty('path');

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
        $rules->add($rules->existsIn(['contract_id'], 'Contracts'));
        return $rules;
    }

    public function deleteImage(EntityInterface $entity) {
        $file = WWW_ROOT . $entity->get('path');
        if(file_exists($file)) {
            return unlink($file);
        }
        return true;
    }

    public function delete(EntityInterface $entity, $options = Array()) {
        return $this->deleteImage($entity) && parent::delete($entity, $options);
    }
}
