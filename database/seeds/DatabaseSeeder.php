<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Status_UserSeeder::class,
            UserSeeder::class,
            TypeMeasureTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            ProductTableSeeder::class,
            AnnouncesTableSeeder::class,
            CommentsTableSeeder::class,
            SellersTableSeeder::class,
            PaymentsTableSeeder::class,
            FavorisTableSeeder::class,
            MessagesTableSeeder::class,
            ReportCategoriesTableSeeder::class,
            ReportsTableSeeder::class,
            User_Status_CorrespondencesTableSeeder::class
        ]);
    }
}
