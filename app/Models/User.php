<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'district',
        'name',
        'email',
        'password',
    ];

    protected $attributes = [
        'district' => 14,
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->district)) {
                $model->district = 14;
            }
        });
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pages(){
        return $this->hasMany('App\Models\Page');
    }

    public function companies(){
        return $this->hasMany('App\Models\Company');
    }

    public function sliders(){
        return $this->hasMany('App\Models\Slider');
    }

    public function events(){
        return $this->hasMany('App\Models\Event');
    }

    public function galleries(){
        return $this->hasMany('App\Models\Gallery');
    }

    public function images(){
        return $this->hasMany('App\Models\GalleryImage');
    }

    public function about_us(){
        return $this->hasMany('App\Models\About');
    }

    public function team(){
        return $this->hasMany('App\Models\Team');
    }

    public function areas_of_work(){
        return $this->hasMany('App\Models\AreasOfWork');
    }

    public function partners(){
        return $this->hasMany('App\Models\Partner');
    }

    public function settings(){
        return $this->hasMany('App\Models\Setting');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    public function isAdminOrEditor(){
        return $this->hasAnyRole(['admin','editor']);
    }

    public function hasAnyRole($roles){
        return $this->roles()->whereIn('name', $roles)->first() ?? null;
    }

    public function hasRole($role){
        return $this->roles()->where('name', $role)->first() ?? null;
    }

      // Define inverse relationship with ApplicationForDirector
      public function applicationsForDirector()
      {
          return $this->hasMany(ApplicationForDirector::class, 'deputy_director_id', 'id');
      }
}
