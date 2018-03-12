<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table    = 'jadwal';

    protected $guarded  = [];

    public function guru()
    {
        return $this->hasOne(DataGuru::class,'id', 'guru_id');
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
        return $this->hasOne(Ref_Semester::class,'id','semeseter_id');
    }

    public function tahun_ajaran()
    {
        return $this->hasOne(Ref_TahunAjar::class,'id','tahun_ajaran_id');
    }
}
