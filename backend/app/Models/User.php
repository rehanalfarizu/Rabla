<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, Notifiable, HasApiTokens;

    protected $connection = "mongodb";
    protected $collection = "users";

    protected $fillable = ["name","email","password","phone","avatar","firebase_uid"];
    protected $hidden = ["password","verification_token"];
    protected $casts = ["is_admin"=>"boolean","is_verified"=>"boolean","verification_expires"=>"datetime","last_login_at"=>"datetime","email_verified_at"=>"datetime"];

    public function addresses(){return $this->hasMany(Address::class,"user_id");}
    public function orders(){return $this->hasMany(Order::class,"user_id");}
    public function reviews(){return $this->hasMany(Review::class,"user_id");}
    public function wishlists(){return $this->hasMany(Wishlist::class,"user_id");}
    public function notifications(){return $this->hasMany(Notification::class,"user_id");}
    public function scopeAdmins($q){return $q->where("is_admin",true);}
    public function scopeVerified($q){return $q->where("is_verified",true);}
    public function isAdmin():bool{return $this->is_admin??false;}
}
