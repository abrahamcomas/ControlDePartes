<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class UserFuncionario extends Authenticatable
{
    protected $table="Funcionario";
    protected $primaryKey="id_Funcionario";
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_Funcionario', 
        'Activo',
        'Rut',
        'Nombres',
        'Apellidos',
        'Email',
        'password',
        'remember_token',
        'updated_at',
        'created_at',
        'CorreoActivo',
        'Token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
