<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    protected $table = 'siswa';

  	protected $guarded = [];

  	public function user()
  	{
  		return $this->hasOne(User::class,'id', 'user_id');
  	}
}
