<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
   // protected $connection = 'second_db';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'password',
        'insert_user_id',
        'status',
        'hospital_id'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function booted()
    {
        static::updating(function($user) {
            $data['user_id'] = Auth()->id();
            $data['ip'] = request()->ip();
            $data['id_no'] = $user->id;
            $data['table_name'] = 'users';
            $data['old_record'] = $user;
            $data['type_action'] = 'U';
            if ($user->status != $user->getOriginal('status')) {
                $data['column_name'] = 'status';
                $data['old_value'] =$user->getOriginal('status');
                $data['new_value'] = $user->status;
                Log::create($data);
            }
            if ($user->name != $user->getOriginal('name')) {
                $data['column_name'] = 'name';
                $data['old_value'] =$user->getOriginal('name');
                $data['new_value'] = $user->name;
                Log::create($data);
            }
            if ($user->hospital_id != $user->getOriginal('hospital_id')) {
                $data['column_name'] = 'hospital_id';
                $data['old_value'] =$user->getOriginal('hospital_id');
                $data['new_value'] = $user->hospital_id;
                Log::create($data);
            }
            if ($user->user_name != $user->getOriginal('user_name')) {
                $data['column_name'] = 'user_name';
                $data['old_value'] =$user->getOriginal('user_name');
                $data['new_value'] = $user->user_name;
                Log::create($data);
            }

        });
    }
    public function role_pages()
    {
        return $this->hasMany(RolePageUser::class,'user_id');
    }
    public function hospital()
    {
        return $this->belongsTo(C_DETAILS_REFERRAL_TB::class,'DREF_CODE');
    }
}
