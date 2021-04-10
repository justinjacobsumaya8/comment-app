<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->delete();

        \DB::table('posts')->insert(array (
            0 => 
            array (
                'title' => 'Laravel Livewire vs. Vue',
                'description' => 'What do you think about <span style="color: #fb70a9;">Laravel Livewire</span> and <span style="color: #47b784;">VueJS</span>?',
                'image' => 'livewire-vs-vue.png',
            )
        ));
    }
}
