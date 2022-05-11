<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin
        User::create([
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'country' => 'Italy',
            'state' => 'Vercelli',
            'city' => 'Agnone',
            'gender' => 'male',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role' => 'super'
        ]);

        Category::create([
            'title' => 'news',
            'slug' => 'news',
            'description' => 'Basic News Category',
            'thumbnail' => '/default.jpg'
        ]);

        // Network admin and Network
        $network_admin = User::create([
            'firstname' => 'Network',
            'lastname' => 'Admin',
            'country' => 'Italy',
            'state' => 'Vercelli',
            'city' => 'Agnone',
            'gender' => 'male',
            'email' => 'network@network.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role' => 'network_admin'
        ]);
        $network_admin->network()->create([
            'title' => 'Island TV'
        ]);

        // Channel, channel operator and assign
        $channel = Channel::create([
            'user_id' => $network_admin->id,
            'category_id' => 1,
            'title' => 'TPV NEWS TV',
            'logo' => 'media/default.png',
            'background' => 'media/default.png',
            'description' => 'Basic description',
            'phone' => '9211330',
            'email' => 'tpv@tpv.com',
        ]);
        $channel_operator = User::create([
            'firstname' => 'Channel',
            'lastname' => 'Operator',
            'country' => 'Italy',
            'state' => 'Vercelli',
            'city' => 'Agnone',
            'gender' => 'male',
            'email' => 'channel@channel.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role' => 'channel_operator'
        ]);
        $channel->operators()->sync([$channel_operator->id]);

	    Genre::create([
            'channel_id' => $channel->id,
	    	'name' => 'Comedy',
		    'description' => 'basic comedu',
		    'slug' => 'comedy',
		    'thumbnail' => '/default.jpg'
	    ]);

        Language::create([
            'channel_id' => $channel->id,
            'title' => 'English',
		    'description' => 'basic english',
		    'thumbnail' => '/default.jpg'
	    ]);

        $advertiser_admin = User::create([
            'firstname' => 'Advertiser',
            'lastname' => 'Admin',
            'country' => 'Italy',
            'state' => 'Vercelli',
            'city' => 'Agnone',
            'gender' => 'male',
            'email' => 'advertiser_admin@advertisement.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role' => 'advertiser_admin'
        ]);

        $advertiser = User::create([
            'firstname' => 'Simple',
            'lastname' => 'Advertiser',
            'country' => 'Italy',
            'state' => 'Vercelli',
            'city' => 'Agnone',
            'gender' => 'male',
            'email' => 'advertiser@advertisement.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role' => 'advertiser'
        ]);

        $user = User::create([
            'firstname' => 'Simple',
            'lastname' => 'User',
            'country' => 'Italy',
            'state' => 'Vercelli',
            'city' => 'Agnone',
            'gender' => 'male',
            'email' => 'user@user.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);
        $user->createAsStripeCustomer();
//
//        Plan::create([
//            'title' => 'Free',
//            'price' => 0,
//            'price_discount' => 0,
//            'price_annual' => 0,
//            'price_annual_discount' => 0,
//            'features' => [
//                'quality' => 'SD',
//                'ad_free_entertainment' => true,
//            ]
//        ]);
//
//        Plan::create([
//            'title' => 'Premium',
//            'price' => 75.99,
//            'price_discount' => 125.00,
//            'price_annual' => 945.99,
//            'price_annual_discount' => 1045.99,
//            'features' => [
//                'quality' => 'HD',
//                'ad_free_entertainment' => true,
//            ]
//        ]);
//
//        Subscription::create([
//            'user_id' => 2,
//            'plan_id' => 1,
//            'period' => 'monthly',
//            'expired_at' => NULL,
//            'status' => 1
//        ]);
        // \App\Models\User::factory(10)->create();


        File::deleteDirectory(public_path('storage'));
        File::deleteDirectory(storage_path('app/private'));

        File::makeDirectory(storage_path('app/private'), 0777, true);
        File::makeDirectory(storage_path('app/private/media'), 0777, true);
        Artisan::call('storage:link');

        File::makeDirectory(storage_path('app/public/default'), 0777, true);
        File::copy(public_path('images/avatar.jpg'), storage_path('app/public/default/avatar.jpg'));
    }
}
