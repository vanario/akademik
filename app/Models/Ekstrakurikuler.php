<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';

  	protected $guarded = [];

  	public function siswa()
  	{
  		return $this->hasOne(User::class,'id', 'nama_siswa');
  	}

  	public function tahun_ajaran()
  	{
  		return $this->hasOne(Ref_TahunAjar::class,'id', 'tahun_ajaran_id');
  	}

  	public function semesters()
  	{
  		return $this->hasOne(Ref_Semester::class,'id', 'semester_id');
  	}

  	public function kelas()
    {
      return $this->hasOne(Ref_Kelas::class,'id', 'kelas_id');
    }
  	
}
