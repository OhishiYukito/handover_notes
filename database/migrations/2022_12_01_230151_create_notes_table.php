<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('tag');
            $table->integer('creator');
            $table->integer('updater');
            $table->string('event_name', 100);
            $table->integer('event_year');
        });
        /*
        // define function for use default date
        DB::connection('public')->statement("
            create or replace function set_update_time() returns trigger language plpgsql as
            $$
              begin
                new.updated_at = CURRENT_TIMESTAMP;
                return new;
              end;
            $$;
        ");
        // define trigger
        DB::connection('public')->statement("
            create trigger update_trigger before update on notes for each row
              execute procedure set_update_time();
        ");
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
        /*
        // delete functioin,trigger
        DB::connection('public')->statement("
            DROP TRIGGER update_trigger ON notes;
        ");
        DB::connection('public')->statement("
            DROP FUNCTION set_update_time();
        ");
        */
    }
};
