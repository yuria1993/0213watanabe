<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            '家事', '勉強', '運動', '食事', '移動'
        ];
        foreach ($tags as $tag) {
            Tag::factory()->create(['content' => $tag]);
        }
    }
}
