<?php
namespace App\ApiUtils;

trait ModelCode {
    public function getUniqueCode(){
        $className = get_class($this);
        $className = substr($className, strpos($className, "\\") + 1);
        $code = $className . strval(time());
        return $code;
    }
}