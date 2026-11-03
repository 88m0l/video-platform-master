<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\View;
use App\Models\User;
use App\Models\Video;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        View::create([
            'user_id' => User::where('name', 'hsoub-academy')->first()->id,
            'video_id' => Video::where('title', 'دورة علوم الحاسوب - أكاديمية حسوب')->first()->id,
            'views_number' => '70',
        ]);

        View::create([
            'user_id' => User::where('name', 'hsoub-academy')->first()->id,
            'video_id' => Video::where('title', 'دورة تطوير واجهات المستخدم - أكاديمية حسوب')->first()->id,
            'views_number' => '40',
        ]);

        View::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'video_id' => Video::where('title', 'دورة تطوير الويب باستخدام لغة جافاسكريبت')->first()->id,
            'views_number' => '45',
        ]);

        View::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'video_id' => Video::where('title', 'دورة تطوير تطبيقات الهاتف باستخدام Cordova')->first()->id,
            'views_number' => '58',
        ]);

        View::create([
            'user_id' => User::where('name', 'Mostaql')->first()->id,
            'video_id' => Video::where('title', 'خمسة نصائح لاختيار أفضل المستقلين للعمل على مشروعك')->first()->id,
            'views_number' => '20',
        ]);

        View::create([
            'user_id' => User::where('name', 'Khamsat')->first()->id,
            'video_id' => Video::where('title', 'اعرض خدماتك في أكبر سوق عربي لعرض وشراء الخدمات المصغرة')->first()->id,
            'views_number' => '67',
        ]);

        View::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'video_id' => Video::where('title', 'وظف أفضل المستقلين الموجودين في الوطن العربي عن بعد')->first()->id,
            'views_number' => '15',
        ]);
    }
}
