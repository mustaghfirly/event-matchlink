<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'bidang',
        'deskripsi',
        'logo',
        'website',
        'email_perusahaan',
        'telepon',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }
}
