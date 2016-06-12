<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'username' => true,
        'password' => true,
        'role' => true,
        'active' => true,
    ];

    protected function _setPassword($password) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    public function hasDevPrivileges() {
        return $this->role === 'dev';
    }

    public function hasAdminPrivileges() {
        return $this->role === 'dev' || $this->role === 'admin';
    }
}
