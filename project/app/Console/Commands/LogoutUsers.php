<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LogoutUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * يمكنك تحديد argument اختياري لتسجيل خروج مستخدم محدد
     */
    protected $signature = 'logout:users {user_id?}';

    /**
     * The console command description.
     */
    protected $description = 'Logout all users or a single user by clearing sessions and device tokens';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $userId = $this->argument('user_id');

        if ($userId) {
            // تسجيل خروج مستخدم محدد
            DB::table('SESSIONS')->where('USER_ID', $userId)->delete();
            DB::table('user_tb')->where('id', $userId)->update(['current_device_token' => null]);
            $this->info("✅ تم تسجيل خروج المستخدم رقم $userId بنجاح!");
        } else {
            // تسجيل خروج جميع المستخدمين
            DB::table('SESSIONS')->delete();
            DB::table('user_tb')->update(['current_device_token' => null]);
            $this->info("✅ تم تسجيل خروج جميع المستخدمين بنجاح!");
        }

        return 0;
    }
}
