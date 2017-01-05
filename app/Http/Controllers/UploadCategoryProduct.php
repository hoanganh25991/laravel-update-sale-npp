<?php

namespace App\Http\Controllers;

use App\ApiUtils\Database;
use App\Category;
use App\CategoryProduct;
use App\Product;
use Illuminate\Http\Request;
use App\Libraries\SimpleXLSX;

class UploadCategoryProduct extends Controller{
    use Database;
    protected $log = "";

    protected $map = [];

    public function load(Request $req){
        $file = $req->file('file');
        $fileName = $file->getClientOriginalName();
        $photo_path = $file->storeAs('upload', $fileName);
        \Log::info($photo_path);

        $excel = new SimpleXLSX(storage_path('app/' . $photo_path));
        $sheet1Data = $excel->rows(1);
        $sheet1Ref = $excel->dimension(1);

       $this->truncate('categories');
       $this->truncate('products');
       $this->truncate('category_product');

       $map = [];
       $time = time();

       for($rowPos = 0; $rowPos < $sheet1Ref[1]; $rowPos++){
           $columnPos = 0;
           while(!empty($sheet1Data[$rowPos][$columnPos])){
               $name = $sheet1Data[$rowPos][$columnPos];
               if(empty($map[$name]) && $columnPos == 0){
                   $c = new Category();
                   $c->name = $name;
                   $c->code = 'Category' . ++$time;
                   $c->save();

                   $map[$name] = $c->code;
               }

               if(empty($map[$name]) && $columnPos == 1){
                   $p = new Product();
                   $p->name = $name;
                   $p->code = 'Product' . ++$time;
                   $p->save();

                   /**
                    * Also map in category_product
                    */
                   $catName = $sheet1Data[$rowPos][0];
                   $catCode = $map[$catName];

                   $cp = new CategoryProduct();
                   $cp->category_code = $catCode;
                   $cp->product_code = $p->code;
                   $cp->save();
               }

               $columnPos++;
           }
       }
    }
    
}
