<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArticleImage Entity.
 */
class ArticleImage extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'path' => true,
        'article_id' => true,
        'article' => true,
    ];
}
