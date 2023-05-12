<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'taller',
        'responsable',
        'ajudant',
        'descripcio',
        'adrecatA',
        'nAlumnes',
        'material',
        'aula',
        'observacions',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'tallers_i_usuaris', 'taller_id', 'user_id');
    }
}
