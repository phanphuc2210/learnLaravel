<?php

namespace App\Http\Services;

class UploadService{
    public function store($req){
        if ($req->hasFile('file')) {
            try {
                $name = $req->file('file')->getClientOriginalName();

                $pathFull = 'uploads/' .date("Y/m/d");
                $path = $req->file('file')->storeAs(
                    'public/'. $pathFull, $name
                );    

                return '/storage'.'/'.$pathFull.'/'.$name;
            } catch (\Exception $err) {
                return false;
            }
        }
    }
}