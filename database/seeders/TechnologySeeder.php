<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $techList = ['Html','Css','JavaScript','Php','MySql','Bootstrap','Laravel','Java'];

        foreach($techList as $tech){
            $newTech = new Technology();

            $newTech->name=$tech;
            $newTech->slug = Str::slug($newTech->name, '-');
            $newTech->description=$faker->text();
            $newTech->save();
        }
    }
}
