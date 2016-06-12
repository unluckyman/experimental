<?php
namespace App\Model\Table;

use App\Model\Entity\Contract;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;

/**
 * Contracts Model
 *
 * @property \Cake\ORM\Association\HasMany $ContractImages
 */
class ContractsTable extends Table {
    protected $imagesFolder = 'contracts';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('contracts');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('ContractImages', [
            'foreignKey' => 'contract_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }

    public function uploadMultiple($images = array()) {
        $imagePaths = '';
        $n = count($images['name']);

        if($n > 0) {
            for ($i=0; $i < $n; $i++) {
                $image['name'] = $images['name'][$i];
                $image['type'] = $images['type'][$i];
                $image['tmp_name'] = $images['tmp_name'][$i];
                $image['error'] = $images['error'][$i];
                $image['size'] = $images['size'][$i];
                $imagePaths[] = $this->upload($image);
            }
        }

        return $imagePaths;
    }

    public function upload($image = array(), $subdir = '', $dir = 'uploads') {
        if($subdir) {
            $dir = $dir . DS . $subdir . DS;
        } else {
            $dir = $dir . DS . $this->imagesFolder . DS;
        }

        $path = WWW_ROOT . DS . $dir;

        //no image was sent
        if(($image['error']!=0) and ($image['size']==0)) {
            return '';
        }

        if($this->checkDir($path)){
            $image = $this->checkName($image, $path);
            $this->moveFile($image, $path);
            return DS . $dir . $image['name'];
        }

        return '';
    }

    public function checkDir($dir) {
        $folder = new Folder();
        if (!is_dir($dir)) {
            return $folder->create($dir);
        }
        return true;
    }

    public function slugify($string) {
        $string = strtolower(Inflector::slug($string, '-'));
        return $string;
    }

    public function checkName($image, $dir) {
        $imageInfo = pathinfo($dir.$image['name']);
        $imageName = $this->slugify($imageInfo['filename']).'.'.$imageInfo['extension'];

        $count = 2;
        while (file_exists($dir.$imageName)) {
            $imageName  = $this->slugify($imageInfo['filename']).'-'.$count;
            $imageName .= '.'.$imageInfo['extension'];
            $count++;
        }
        $image['name'] = $imageName;
        return $image;
    }

    public function moveFile($image, $dir) {
        $file = new File($image['tmp_name']);
        $file->copy($dir.$image['name']);
        $file->close();
    }

    public function deleteImages($ids = array()) {
        if(!empty($ids)) {
            $table = TableRegistry::get('ContractImages');
            $images = $table->find()->where(['id IN' => $ids ])->toArray();

            foreach ($images as $image) {
                $table->delete($image);
            }
        }
    }

    public function getContractImageById($id) {
        $table = TableRegistry::get('ContractImages');
        return $table->get($id);
    }
}
