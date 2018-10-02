<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Thread extends Entity
{
	const STATUS_OPEN  = 1;
	const STATUS_CLOSE = 0;
	
	/**
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false
	];

}