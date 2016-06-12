<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Contract extends Entity {
    protected $_accessible = [
        'name' => true,
        'password' => true,
        'contract_images' => true,
    ];

    protected function _setPassword($password) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}
