<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
   /**
   * @var string
   */
   protected $table = 'routers';

   /**
   * @var
   */
   public $timestamps = false;

   /**
   * @var array
   */
  protected $fillable = [
    'sap_id', 'type', 'host_name', 'loopback', 'mac_address'
  ];

}
