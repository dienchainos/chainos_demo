<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Message extends Entity
{
	const STATUS_SEND  = 'send';
	const STATUS_REPLY = 'reply';
	const STATUS_IS_READ     = 1;
	const STATUS_IS_NOT_READ = 0;
	
	/**
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false
	];

}