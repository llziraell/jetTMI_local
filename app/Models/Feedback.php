<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
  protected $table = 'feedback';

  public $timestamps = false;

  protected $primaryKey = 'id';

  protected $fillable = [
      'name',
      'email',
      'phone_number',
      'message',
      'ip',
      'website',
      'created_at',
  ];
}
