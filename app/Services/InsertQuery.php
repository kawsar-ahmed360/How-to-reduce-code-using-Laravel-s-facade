<?php
namespace App\Services;


use Illuminate\Support\Facades\Session;
use Image;
Class InsertQuery{


    public function Insert($ModelName,$request){
        $tmpArray = array_keys($request->input());
        $string =  array_shift($tmpArray);
        foreach (@$tmpArray as $key=>$tmp){
            $store = $ModelName;
            $store->$tmp = $request->$tmp;
            $store->save();

            Session::put('StoreId',$store->id);

        }
    }

    public function InsertImage($ModelName,$path,$width,$height,$request){

        $update= $ModelName::where('id',\Illuminate\Support\Facades\Session::get('StoreId'))->first();
          $image_es = $request->image;
          $rand = rand(00000,99999);
          $fullName = $rand.'.'.$image_es->getClientOriginalExtension();
          @unlink('upload/'.$path.'/'.$update->image);
          Image::make($image_es)->resize($width,$height)->save('upload/'.$path.'/'.$fullName);
            $update->image = $fullName;
          $update->save();
        \Illuminate\Support\Facades\Session::forget('StoreId');

    }

}