<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusCorrespondence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User_Status_Correspondences', function (Blueprint $table) {
            $table->integer('idUser_status_Correspondence',true);
            $table->boolean('default_status');
            $table->integer('Users_idUser')->index('fk_User_S_C_Users_idUser');
            $table->integer('Status_User_idStatus_User')->index('fk_User_S_C_Status_User_idStatus_User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User_Status_Correspondences');
    }
}
