<?php
namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Inflector;

class SluggableBehavior extends Behavior
{
    protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];

    public function slug(Entity $entity) {
        $config = $this->config();
        $slugName = strtolower(Inflector::slug($entity->get($config['field']), $config['replacement']));
        $entity->set($config['slug'], $slugName);
    }

    public function beforeSave(Event $event, Entity $entity) {
        $this->slug($entity);
    }

    public function findSlug(Query $query, array $options) {
        $config = $this->config();
        return $query->where([$config['slug'] => $options['slug']]);
    }

}