<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name'        => 'Share',
                'description' => 'Share creation, share discovery',
            ],
            [
                'name'        => 'Tutoral',
                'description' => 'Skills, recommended extensions, etc.',
            ],
            [
                'name'        => 'QA',
                'description' => 'be friendly and help each other.',
            ],
            [
                'name'        => 'Announcement',
                'description' => 'Site Announcement',
            ],
        ];

        DB::table('categories')->insert($categories);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
