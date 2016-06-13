<?php
namespace App\Model\Table;

use App\Model\Entity\Article;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;
use App\Model\Behavior\SluggableBehavior;

/**
 * Articles Model
 */
class ArticlesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('articles');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Sluggable');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ArticleImages', [
            'foreignKey' => 'article_id',
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
            ->allowEmpty('image');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('headline', 'create')
            ->notEmpty('headline');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->add('published', 'valid', ['rule' => 'boolean'])
            ->requirePresence('published', 'create')
            ->notEmpty('published');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function isOwnedBy($articleId, $userId) {
        return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    }

    //uploads image
    public function uploadCover($image) {
        return $this->upload($image, 'articles');
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

    public function upload($image = array(), $subdir = 'article_images', $dir = 'uploads') {
        $dir = $dir . DS . $subdir . DS;
        $path = WWW_ROOT . $dir;

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
            return $entity->get('image');
        } else {
            $this->deleteImage($entity);
            return $this->uploadCover($image);
        }
    }

    public function deleteImage(EntityInterface $entity) {
        if($entity->get('image')){
            $file = WWW_ROOT . $entity->get('image');
            return unlink($file);
        }

        return true;
    }

    public function deleteImages($ids = array()) {
        if(!empty($ids)) {
            $table = TableRegistry::get('ArticleImages');
            $images = $table->find()->where(['id IN' => $ids ])->toArray();

            foreach ($images as $image) {
                $table->delete($image);
            }
        }
    }

    public function delete(EntityInterface $entity, $options = Array()) {
        return $this->deleteImage($entity) && parent::delete($entity, $options);
    }

    public function toFrontend($limit = 10) {
        return $this->find('all')->where(['published IS NOT' => null])->order(['created' => 'desc'])->limit($limit);
    }

}
