<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\AdType;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class
        ]);

        $types = ['free', 'paid'];
        foreach ($types as $type){
            AdType::create(['title'=>$type]);
        }

        Category::create(['title'=>'category1']);
        Category::create(['title'=>'category2']);

        Tag::create(['title'=>'tag1']);
        Tag::create(['title'=>'tag2']);

        $tags = Tag::all();

        $ad1 = Ad::create([
            'title' => 'Ad1',
            'description' => 'Test description',
            'type_id' => 1,
            'category_id' => 1,
            'advertiser_id' => 2,
            'created_by_user_id' => 1,
            'start_date' => '2022/2/4',
        ]);

        $ad1->tags()->sync($tags);

        Ad::create([
            'title' => 'Ad2',
            'description' => 'Test description2',
            'type_id' => 2,
            'category_id' => 2,
            'advertiser_id' => 2,
            'created_by_user_id' => 1,
            'start_date' => '2022/2/5',
        ]);






    }
}
