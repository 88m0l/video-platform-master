<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Video;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'user_id' => User::where('name', 'hsoub-academy')->first()->id,
            'notification' => Video::where('title', 'دورة علوم الحاسوب - أكاديمية حسوب')->first()->title,
            'video_id' => Video::where('title', 'دورة علوم الحاسوب - أكاديمية حسوب')->first()->id,
            'success' => '1',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'hsoub-academy')->first()->id,
            'notification' => Video::where('title', 'دورة تطوير واجهات المستخدم - أكاديمية حسوب')->first()->title,
            'video_id' => Video::where('title', 'دورة تطوير واجهات المستخدم - أكاديمية حسوب')->first()->id,
            'success' => '0',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'hsoub-academy')->first()->id,
            'notification' => Video::where('title', 'دورة تطوير واجهات المستخدم - أكاديمية حسوب')->first()->title,
            'video_id' => Video::where('title', 'دورة تطوير واجهات المستخدم - أكاديمية حسوب')->first()->id,
            'success' => '1',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'notification' => Video::where('title', 'دورة تطوير الويب باستخدام لغة جافاسكريبت')->first()->title,
            'video_id' => Video::where('title', 'دورة تطوير الويب باستخدام لغة جافاسكريبت')->first()->id,
            'success' => '1',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'notification' => Video::where('title', 'دورة تطوير تطبيقات الهاتف باستخدام Cordova')->first()->title,
            'video_id' => Video::where('title', 'دورة تطوير تطبيقات الهاتف باستخدام Cordova')->first()->id,
            'success' => '1',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'Mostaql')->first()->id,
            'notification' => Video::where('title', 'خمسة نصائح لاختيار أفضل المستقلين للعمل على مشروعك')->first()->title,
            'video_id' => Video::where('title', 'خمسة نصائح لاختيار أفضل المستقلين للعمل على مشروعك')->first()->id,
            'success' => '1',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'Khamsat')->first()->id,
            'notification' => Video::where('title', 'اعرض خدماتك في أكبر سوق عربي لعرض وشراء الخدمات المصغرة')->first()->title,
            'video_id' => Video::where('title', 'اعرض خدماتك في أكبر سوق عربي لعرض وشراء الخدمات المصغرة')->first()->id,
            'success' => '1',
        ]);

        Notification::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'notification' => Video::where('title', 'وظف أفضل المستقلين الموجودين في الوطن العربي عن بعد')->first()->title,
            'video_id' => Video::where('title', 'وظف أفضل المستقلين الموجودين في الوطن العربي عن بعد')->first()->id,
            'success' => '1',
        ]);
    }
}
