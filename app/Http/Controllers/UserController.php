<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserSecuriryForm;
use App\Models\userSecurityCMD;
use Carbon\Carbon;
use App\Models\menu;
use App\Models\submenu;
use App\Models\user_updt_records;

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

    public function listUsers()
    {
        $users = User::get()->where('role_idrole', "!=", "1");
        return view('users.listUsers', compact('users'));
    }

    public function ShowUser($id)
    {
        $user = User::find($id);

        $menu = menu::join("user_securiry_forms", "user_securiry_forms.menuid", "=", "menus.menuid")
            ->select("menus.name", "menus.menuid", "menus.logo", "user_securiry_forms.show", "user_securiry_forms.can")
            ->where("user_securiry_forms.userid", "=", $id)
            ->groupBy('menus.menuid')
            ->get();

        $submenu = submenu::join("user_securiry_forms", "user_securiry_forms.submenuid", "=", "submenus.submenuid")
            ->select("submenus.name", "user_securiry_forms.menuid", "user_securiry_forms.submenuid", "submenus.logo", "submenus.route", "user_securiry_forms.show", "user_securiry_forms.can")
            ->where("user_securiry_forms.userid", "=", $id)
            ->distinct('submenus.name')
            ->get();

        return view('users.showUser', compact('user', 'menu', 'submenu'));
    }

    public function UpdateUserForm(Request $request, $userId)
    {
        $checkboxes = request()->except('_token', '_method');
        $cont = 0;
        for ($i = 1; $i <= 12; $i++) {
            $found = false;
            foreach ($checkboxes['forms'] as $check) {
                if ($check == (string)$i) {
                    $found = true;
                }
            }

            if ($found) {
                UserSecuriryForm::where('userid', $userId)->where('submenuid', $i)->update(['can' => true]);
            } else {
                $menuid = submenu::select('menuid')
                    ->where('submenuid', $i)
                    ->first();

                $submenus = menu::join('submenus', 'submenus.menuid', 'menus.menuid')
                    ->select('submenuid')
                    ->where('menus.menuid', $menuid->menuid)
                    ->get();

                foreach ($submenus as $id){
                    if ($id->submenuid == $i){
                        $cont++;
                    }
                }

                if ($cont == $submenus->count()){
                    $cont = 0;
                    UserSecuriryForm::where('userid', '=', $userId)
                        ->where('menuid', '=', $menuid->menuid)
                        ->update(['show' => false, 'can' => false]);
                }

                UserSecuriryForm::where('userid', $userId)
                    ->where('submenuid', $i)
                    ->update(['can' => false]);
            }
        }

        return redirect('/user/' . $userId)->with('mensaje', 'Permisos de usuario actualizados con éxito');
    }

    public function updateRol(Request $request)
    {
        $datos = request()->except('_token', '_method');
        $idUserCur = $datos['userId'];
        User::where('id', '=', $idUserCur)->update(['role_idrole' => $datos['role_idrole']]);

        $user = User::findOrFail($idUserCur);

        if ($datos['role_idrole'] == '2') {
            $userSecuCmdList = UserSecuriryForm::where("user_securiry_forms.userid", "=", $idUserCur)->get();
            if ($userSecuCmdList->count() <= 0)
                $this->fillUserSecuriry($idUserCur);
        }

        user_updt_records::insert(
            [
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->role_idrole,
                'deleted_at' => Carbon::now(),
                'userEmail' => session()->get('userEmail')
            ]
        );

        return redirect('/users')->with('mensaje', 'Rol actualizado con éxito..');
    }

    public function fillUserSecuriry($userId)
    {

        $userSecuCmd = userSecurityCMD::all();
        $userSecuCmdConvert = json_decode($userSecuCmd, true);

        foreach ($userSecuCmdConvert as $userSec) {
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
