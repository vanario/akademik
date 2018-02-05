<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsHasClasses extends Model
{
    protected $table    = 'siswa_has_kelas';
    protected $guarded  = [];
    
    public function student()
    {
        return $this->hasOne(DataSiswa::class,'id', 'siswa_id');
    }

    public function classes()
    {
        return $this->hasOne(Classes::class,'id', 'kelas_id');
    }

    public function tahunAjar()
    {
        return $this->hasOne(Ref_TahunAjar::class,'id', 'tahun_ajaran_id');
    }

    public function semester()
    {
        return $this->hasOne(Ref_Semester::class,'id', 'semester_id');
    }
}
