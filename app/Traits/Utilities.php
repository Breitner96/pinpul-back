<?php

namespace App\Traits;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use App\User;

trait Utilities {

    public $url;

    public function returnRoles(){
        $data = [];
        $roles = Role::all();
        foreach($roles as $role){
            $data[] = $role->name;
        }
        return $data;
    }

    public function userActive(){
        $userLoggedIn = auth()->user();
        if( isset($userLoggedIn->rol[0]->name) ){
            $rolLoggenIn = $userLoggedIn->rol[0]->name;
            return $rolLoggenIn;
        } else {
            return response()->json([
                'denied' => 'Acceso denegado'
            ]);
        }
    }

    public function userCanDo(){
        $userLoggedIn = auth()->user()->permissions;
        return $userLoggedIn;
    }

    public function cleanUrl($string){
        return $string;
        $lettersReplaces = ['a','e','i','o','u','n','A','E','I','O','U','N'];
        $lettersContains = ['á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ'];

        $slug = strtolower($string);
        $slug = str_replace(' ', '-', $slug);
        $slugSplit = str_split($slug);

        for($i = 0; $i < count($slugSplit); $i++){
            if( str_contains($slug, $slugSplit[$i]) ) {
                $this->slug = str_replace($lettersContains, $lettersReplaces, $slug);
            }
        }
    }

}