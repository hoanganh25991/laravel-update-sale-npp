<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiUtils\ModelCode;

class Store extends Model
{
    use ModelCode;

    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        $this->attributes['code'] = $this->getUniqueCode();
    }
}
