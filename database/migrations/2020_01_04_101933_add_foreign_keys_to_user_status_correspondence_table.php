<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToUserStatusCorrespondenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('User_Status_Correspondences', function (Blueprint $table) {
            $table->foreign('Users_idUser','fk_User_S_C_Users_idUser')->references('idUser')->on('Users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('Status_User_idStatus_User','fk_User_S_C_Status_User_idStatus_User')->references('idStatus_User')->on('Status_User')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('User_Status_Correspondences', function (Blueprint $table) {
            $table->dropForeign('fk_User_S_C_Users_idUser');
            $table->dropForeign('fk_User_S_C_Status_User_idStatus_User');
        });
    }
}
