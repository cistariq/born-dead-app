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
    protected $table = 'USER_TB';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // تحديد اسم عمود كلمة المرور
    public function getAuthPassword()
    {
        return $this->user_password;
    }
    protected function casts(): array
    {
       // dd(1);
        return [
            'email_verified_at' => 'datetime',
            'user_password' => 'hashed',
        ];
    }
    protected static function booted()
    {
        static::updating(function($user) {
            $data['user_id'] = Auth()->id();
            $data['ip'] = request()->ip();
            $data['id_no'] = $user->id;
            $data['table_name'] = 'user_tb';
          //  $data['old_record'] = $user;
            $data['type_action'] = 'U';
            if ($user->status != $user->getOriginal('status')) {
                $data['column_name'] = 'status';
                $data['old_value'] =$user->getOriginal('status');
                $data['new_value'] = $user->status;
                Log::create($data);
            }
            if ($user->name != $user->getOriginal('name')) {
                $data['column_name'] = 'user_full_name';
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
            if ($user->user_name != $user->getOriginal('user_username')) {
                $data['column_name'] = 'user_full_name';
                $data['old_value'] =$user->getOriginal('user_username');
                $data['new_value'] = $user->user_username;
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
        return $this->belongsTo(Constant::class,'hospital_id');
    }

}
