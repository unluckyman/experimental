<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectImage Entity.
 */
class ProjectImage extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'path' => true,
        'project_id' => true,
        'project' => true,
    ];
}
