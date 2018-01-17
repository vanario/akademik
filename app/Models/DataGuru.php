<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    protected $table = 'guru';

  	protected $guarded = [];

  	public function user()
  	{
  		return $this->hasOne(User::class,'id', 'user_id');
  	}

  	public function wali()
  	{
  		return $this->hasOne(WaliKelas::class,'guru_id', 'id');
  	}

  	public function pengampu()
  	{
  		return $this->hasOne(Pengampu::class,'guru_id', 'id');
  	}
}

