<?php

use Illuminate\Database\Seeder;

class ReactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reactions = ['Like', 'Dislike'];

        foreach ($reactions as $key => $reaction) {
            \App\Reaction::updateOrCreate([
                'id' => $key + 1,
                'name' => $reaction,
            ]);
        }
    }
}
