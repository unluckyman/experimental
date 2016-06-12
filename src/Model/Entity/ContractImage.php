<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContractImage Entity.
 */
class ContractImage extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'path' => true,
        'contract_id' => true,
        'contract' => true,
    ];

    protected function _getName() {
        return basename($this->_properties['path']);
    }

    protected function _getFullPath() {
        return  WWW_ROOT . $this->_properties['path'];
    }
}
