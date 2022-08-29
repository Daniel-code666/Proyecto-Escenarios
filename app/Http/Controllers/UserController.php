<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserSecuriryForm;
use App\Models\userSecurityCMD;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\SubMenu;
class UserController extends Controller

{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    public function listUsers(){
        $users = User::get()->where('role_idrole', "!=", "1");
        return view('users.listUsers', compact('users'));
    }

    public function ShowUser($id){
        $user = User::get()->where('role_idrole', $id);

        $menu = Menu::join("user_securiry_forms","user_securiry_forms.menuid", "=", "Menus.menuid")
        ->select("Menus.name","Menus.menuid","Menus.logo","user_securiry_forms.show", "user_securiry_forms.can")
        ->where("user_securiry_forms.userid", "=", $id)
        ->groupBy('Menus.menuid')
        ->get(); 

        $submenu = SubMenu::join("user_securiry_forms","user_securiry_forms.submenuid", "=", "submenus.submenuid")
        ->select("submenus.name","user_securiry_forms.menuid","submenus.logo","submenus.route","user_securiry_forms.show", "user_securiry_forms.can")
        ->where("user_securiry_forms.userid", "=", $id)
        ->distinct('submenus.name')
        ->get();
        return view('users.showUser', compact('user','menu','submenu'));
    }

    public function updateRol(Request $request)
    {
        $datos = request()->except('_token','_method');
        $idUserCur = $datos['userId'];
        User::where('id','=',$idUserCur)->update(['role_idrole'=> $datos['role_idrole']]);

        if($datos['role_idrole'] == '2'){
            $userSecuCmdList = UserSecuriryForm::where("user_securiry_forms.userid", "=", $idUserCur)->get();
            if($userSecuCmdList->count() <= 0)
                $this->fillUserSecuriry($idUserCur);  
        } 

        return redirect('/users')->with('mensaje', 'Rol actualizado con éxito..');
    }

    public function fillUserSecuriry($userId){

        $userSecuCmd = userSecurityCMD::all();
        $userSecuCmdConvert = json_decode($userSecuCmd, true);

        foreach($userSecuCmdConvert as $userSec)
        {
            $newForm = new UserSecuriryForm();
            $newForm = $userSec;
            $newForm['id'] = null;
            $newForm['userid'] = $userId;
            $newForm['created_at'] = date('Y-m-d H:i:s', strtotime(Carbon::now()));
            $newForm['updated_at'] = date('Y-m-d H:i:s', strtotime(Carbon::now()));
            UserSecuriryForm::insert($newForm);
        }
        $aux = true;

    }

    

}
