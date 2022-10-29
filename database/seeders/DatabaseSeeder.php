<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(CitiesTableSeeder::class);
        $this->call(DistsTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(AboutTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(ProductImagesTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(PropertiesTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
