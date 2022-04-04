<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'user_state_id',
        'area_id'
    ];

    public $sortable = [
        'id',
        'email',
        'phone_number',
        'address',
        'created_at',
        'updated_at',
        'name'
    ];

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



    public function user_state()
    {
        return $this->belongsTo(UserState::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function get_organization()
    {


        $mem = $this->user_organization_memberships;
        if (!$mem || !($mem -> first())) {
            return false;
        }
        return $mem-> first() -> organization;
    }

    public function user_organization_memberships()
    {
        return $this->hasMany(UserOrganizationMembership::class);
    }


    public function user_service_ratings(){
        return $this -> hasMany(UserServiceRating::class);
    }

    public function services(){
        return $this -> belongsToMany(Service::class, 'user_service_likes');
    }

    public function user_role(){
        $mem = $this -> user_organization_memberships;
        if (count($mem) > 0){
            $mem = $mem -> first();
            if ($mem){
                return $mem -> organization_roles -> first();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


}
