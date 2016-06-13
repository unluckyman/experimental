<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity.
 */
class Article extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'image' => true,
        'title' => true,
        'headline' => true,
        'slug' => true,
        'body' => true,
        'user_id' => true,
        'published' => true,
        'user' => true,
        'article_images' => true,
    ];

    protected function _getThumb() {
        return $this->_properties['image'] ? $this->_properties['image'] : '';
    }

    public function isPublished() {
        return ($this->_properties['published'] ? true : false);
    }
}
