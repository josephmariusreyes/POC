<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Since my tables follow the laravel convention, this will automatically 
    //Determine the role of the user from the pivot table that i have "role_user"
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function events()
    {
        return $this->belongsToMany(Events::class);
    }

    // NOTE: in scenarios that the pivot table did not follow the larvel naming convention
    // we must explicitly tell laravel the table name
    
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'pivot.role_user');
    // }    

    // also below is sample if it did not follow the convention for naming the columns
    // public function roles()
    // {
    // return $this->belongsToMany(
    //     Role::class,
    //     'pivot.role_user',
    //     'customer_user_id',  // FK pointing to users table
    //     'customer_role_id'   // FK pointing to roles table
    // );
    // }
}
