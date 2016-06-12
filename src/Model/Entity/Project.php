<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity.
 */
class Project extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'image' => true,
        'name' => true,
        'headline' => true,
        'body' => true,
        'slug' => true,
        'project_images' => true,
    ];

    protected function _getThumb() {
        return $this->_properties['image'] ? $this->_properties['image'] : '';
    }
}
