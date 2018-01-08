<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

  	protected $guarded = [];

  	public function siswa()
  	{
  		return $this->hasOne(DataSiswa::class,'id', 'siswa_id');
  	}

  	public function kelas()
  	{
  		return $this->hasOne(Ref_Kelas::class,'id','kelas_id');
  	}

  	public function semester()
  	{
  		return $this->hasOne(Ref_Semester::class,'id','semeseter_id');
  	}

  	public function tahun_ajaran()
  	{
  		return $this->hasOne(Ref_TahunAjar::class,'id','tahun_ajaran_id');
  	}
}
