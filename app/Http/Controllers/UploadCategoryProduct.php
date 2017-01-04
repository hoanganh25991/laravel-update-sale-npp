<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\SimpleXLSX;

class UploadCategoryProduct extends Controller{
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

//        for($rowPos = 0; $rowPos < $sheet1Ref[1]; $rowPos++){
//            $columnPos = 0;
//            while(!empty($sheet1Data[$rowPos][$columnPos])){
//
//            }
//        }

    }
    
}
