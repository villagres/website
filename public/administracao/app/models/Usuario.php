<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends BaseModel implements UserInterface
{
	use UserTrait, RemindableTrait;
	
	protected $table = 'user';
	protected $primaryKey = 'id';
}