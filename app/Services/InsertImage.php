<?php
namespace App\Services;


Class InsertImage{

    public function Insert($ModelName,$request){


        $tmpArray = array_keys($request->input());
        $string =  array_shift($tmpArray);


        foreach (@$tmpArray as $key=>$tmp){
            $store = $ModelName;
            $store->$tmp = $request->$tmp;
            $store->save();

        }



    }

}