<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity.
 */
class Customer extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'path' => true,
    ];

    protected function _getThumb() {
        return $this->_properties['image'] ? $this->_properties['image'] : '';
    }
}
