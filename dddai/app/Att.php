<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Att extends Model
{
	protected $table='atts';
   protected $primaryKey='aid';
   public $timestamps=false;
}
