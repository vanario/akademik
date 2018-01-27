<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AhlakDanKepribadian extends Model
{
    protected $table = 'ahlak_dan_kepribadian';

  	protected $guarded = [];

  	public function siswa()
  	{
  		return $this->hasOne(User::class,'id', 'nama_siswa');
  	}

  	public function tahun_ajaran()
  	{
  		return $this->hasOne(Ref_TahunAjar::class,'id', 'tahun_ajaran_id');
  	}

  	public function kelas()
  	{
  		return $this->hasOne(Ref_Kelas::class,'id', 'kelas_id');
  	}
}
