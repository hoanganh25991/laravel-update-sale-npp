<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiUtils\ModelCode;

class Category extends Model{
    use ModelCode;

    protected $table = 'categories';
    protected $fillable = ['name'];
    protected $guarded = ['code'];

    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        $this->attributes['code'] = $this->getUniqueCode();
    }
}
