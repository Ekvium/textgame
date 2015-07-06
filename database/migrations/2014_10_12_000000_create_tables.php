<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password', 60);
                $table->integer('coins')->default(0);
                $table->boolean('premium')->default(false);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('universes')) {
            Schema::create('universes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('owner');
                $table->boolean('democracy')->default(false);
                $table->integer('president');
                $table->timestamp('next_voting');
                $table->text('description');
                $table->string('icon', 100);
            });
        }

        if(!Schema::hasTable('universe_permissions')) {
            Schema::create('universe_permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('player');
                $table->string('permission');
            });
        }

        if(!Schema::hasTable('items')) {
            Schema::create('items', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('type');
                $table->string('alias');
                $table->integer('owner');
                $table->json('options');
                $table->integer('givenWho');
                $table->timestamp('givenWhen');
                $table->string('givenWhere');
            });
        }

        if(!Schema::hasTable('item_types')) {
            Schema::create('item_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('creator');
                $table->integer('universe');
                $table->string('name');
                $table->string('color')->default('white');
                $table->text('source');
            });
        }

        if(!Schema::hasTable('characters')) {
            Schema::create('characters', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('owner');
                $table->integer('universe');
                $table->string('name');
                $table->enum('gender', ['male', 'female', 'other']);
                $table->text('description');
                $table->string('portrait', 100);
                $table->integer('currentRoom');
            });
        }

        if(!Schema::hasTable('factions')) {
            Schema::create('factions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('owner');
                $table->integer('universe');
                $table->string('name');
                $table->boolean('open')->default(true);
            });
        }

        if(!Schema::hasTable('faction_belong')) {
            Schema::create('faction_belong', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character');
                $table->integer('faction');
            });
        }

        if(!Schema::hasTable('skills')) {
            Schema::create('skills', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('color')->default('white');
                $table->text('source');
            });
        }

        if(!Schema::hasTable('skill_belong')) {
            Schema::create('skill_belong', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character');
                $table->integer('skill');
            });
        }

        if(!Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('universe');
                $table->integer('creator');
                $table->integer('parent');
                $table->boolean('gmAccess')->default(true);
                $table->integer('quest')->default(-1);
                $table->text('shortDescription');
                $table->text('description');
                $table->text('source');
                $table->string('language')->default('en');
            });
        }

        if(!Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('location');
                $table->text('description');
                $table->text('source');
            });
        }

        if(!Schema::hasTable('lobbies')) {
            Schema::create('lobbies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('quest');
                $table->integer('character');
                $table->timestamp('since');
            });
        }

        if(!Schema::hasTable('character_data')) {
            Schema::create('character_data', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character');
                $table->string('field');
                $table->integer('valueNumeric');
                $table->string('valueString');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = array('users', 'universes', 'universe_permissions', 'items', 'item_types', 'characters',
            'factions', 'faction_belong', 'skills', 'skill_belong', 'locations', 'rooms', 'lobbies', 'character_data');
        foreach($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
}
