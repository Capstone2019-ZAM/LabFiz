<?php

use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('labs')->insert([
            'name' => "Software Eng. Lab",
            'location' => "ED-416",
            'user_id' =>    1,
            
        ]);

        
        DB::table('labs')->insert([
            'name' => "Digital Signal Processing Lab",
            'location' => "ED-423.1",
            'user_id' =>    1,
            
        ]);

    }
}
