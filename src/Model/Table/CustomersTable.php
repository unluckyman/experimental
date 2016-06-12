<?php
namespace App\Model\Table;

use App\Model\Entity\Customer;
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
 * Customers Model
 *
 */
class CustomersTable extends Table {
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('customers');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
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
            ->notEmpty('name');

        $validator
            ->requirePresence('path', 'create')
            ->notEmpty('path');

        return $validator;
    }

    public function upload($image = array(), $subdir = 'customers', $dir = 'uploads') {
        $dir = $dir . DS . $subdir . DS;

        debug($dir);

        $path = WWW_ROOT . DS . $dir;

        debug($path);


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

    public function editImage(EntityInterface $entity, Array $image) {
        if(empty($image['name'])) {
            return $entity->get('path');
        } else {
            $this->deleteImage($entity);
            return $this->upload($image);
        }
    }

    public function deleteImage(EntityInterface $entity) {
        if($entity->get('path')){
            $file = WWW_ROOT . $entity->get('path');
            return unlink($file);
        }
        return true;
    }

    public function delete(EntityInterface $entity, $options = Array()) {
        return $this->deleteImage($entity) && parent::delete($entity, $options);
    }

    public function toFrontend($limit = 10) {
        return $this->find('all', ['order' => ['name' => 'ASC']])->limit($limit);
    }
}
