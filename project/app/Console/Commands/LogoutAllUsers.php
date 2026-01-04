<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LogoutAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * يمكنك تعديل الاسم حسب رغبتك
     */
    protected $signature = 'logout:allusers';

    /**
     * The console command description.
     */
    protected $description = 'Logout all users by clearing sessions and device tokens';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // حذف جميع الجلسات
        DB::table('SESSIONS')->delete();

        // مسح كل توكنات الأجهزة
        DB::table('user_tb')->update(['current_device_token' => null]);

        $this->info('✅ تم تسجيل خروج جميع المستخدمين بنجاح!');

        return 0;
    }
}
