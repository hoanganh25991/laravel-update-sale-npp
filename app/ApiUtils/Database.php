<?php
namespace App\ApiUtils;
use DB;
trait Database {
    public function truncate($table){
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        DB::statement("SET AUTOCOMMIT = 0;");
        DB::transaction(function () use($table){
            $truncateTpl = "TRUNCATE TABLE %s;";
            DB::statement(sprintf($truncateTpl, $table));
            DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
        });
        DB::statement("SET AUTOCOMMIT = 1;");
    }
}