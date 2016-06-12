<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Service Entity.
 */
class Service extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'definition' => true,
        'info' => true,
        'service_type_id' => true,
        'service_type' => true,
    ];
}
