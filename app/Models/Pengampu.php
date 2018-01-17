<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    protected $table = 'pengampu';

  	protected $guarded = [];

  	public function guru()
  	{
  		return $this->hasOne(User::class,'id', 'guru_id');
  	}

  	public function mapel()
  	{
  		return $this->hasOne(Ref_Mapel::class,'id', 'mapel_id');
  	}

  	public function kelas()
  	{
  		return $this->hasOne(Ref_Kelas::class,'id','kelas_id');
  	}

  	public function semester()
  	{
  		return $this->hasOne(Ref_Semester::class,'id','semester_id');
  	}

  	public function tahun_ajaran()
  	{
  		return $this->hasOne(Ref_TahunAjar::class,'id','tahun_ajaran_id');
  	}
}
