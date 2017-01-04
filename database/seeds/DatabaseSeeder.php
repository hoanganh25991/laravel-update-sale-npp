<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->v1BasicNeed(true);
    }

    private function v1BasicNeed($rollback = false){
        if(!$rollback){
            factory(App\User::class, 10)->create();
        }

        if($rollback){
            DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
            DB::statement("SET AUTOCOMMIT = 0;");
            DB::transaction(function (){
                $truncateTpl = "TRUNCATE TABLE %s;";
                DB::statement(sprintf($truncateTpl, 'users'));
                DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
            });
            DB::statement("SET AUTOCOMMIT = 1;");
        }
    }
}
