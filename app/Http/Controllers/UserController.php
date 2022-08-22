<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserSecuriryForm;
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

    public function updateRol(Request $request)
    {
        $datos = request()->except('_token','_method');
        User::where('id','=','2')->update(['role_idrole'=> $datos['role_idrole']]);

        if($datos['role_idrole'] == "2"){
            $this->fillUserSecuriry(2);  
        }

        return redirect('/users')->with('mensaje', 'Rol actualizado con éxito..');
    }

    public function fillUserSecuriry($userId){

        $userSecurirty1 = new UserSecuriryForm();
        $userSecurirty1->userid = $userId;
        $userSecurirty1->menuid = 1;
        $userSecurirty1->submenuid = 0;
        $userSecurirty1->show = true;
        $userSecurirty1->can = true;

        $userSecurirty2 = new UserSecuriryForm();
        $userSecurirty2->userid = $userId;
        $userSecurirty2->menuid = 1;
        $userSecurirty2->submenuid = 1;
        $userSecurirty2->show = true;
        $userSecurirty2->can = true;

        $userSecurirty3 = new UserSecuriryForm();
        $userSecurirty3->userid = $userId;
        $userSecurirty3->menuid = 2;
        $userSecurirty3->submenuid = 0;
        $userSecurirty3->show = true;
        $userSecurirty3->can = true;

        $userSecurirty4 = new UserSecuriryForm();
        $userSecurirty4->userid = $userId;
        $userSecurirty4->menuid = 2;
        $userSecurirty4->submenuid = 2;
        $userSecurirty4->show = true;
        $userSecurirty4->can = true;

        $userSecurirty5 = new UserSecuriryForm();
        $userSecurirty5->userid = $userId;
        $userSecurirty5->menuid = 2;
        $userSecurirty5->submenuid = 3;
        $userSecurirty5->show = true;
        $userSecurirty5->can = true;

        $userSecurirty6 = new UserSecuriryForm();
        $userSecurirty6->userid = $userId;
        $userSecurirty6->menuid = 3;
        $userSecurirty6->submenuid = 0;
        $userSecurirty6->show = true;
        $userSecurirty6->can = true;

        $userSecurirty7 = new UserSecuriryForm();
        $userSecurirty7->userid = $userId;
        $userSecurirty7->menuid = 3;
        $userSecurirty7->submenuid = 4;
        $userSecurirty7->show = true;
        $userSecurirty7->can = true;

        $userSecurirty8 = new UserSecuriryForm();
        $userSecurirty8->userid = $userId;
        $userSecurirty8->menuid = 3;
        $userSecurirty8->submenuid = 5;
        $userSecurirty8->show = true;
        $userSecurirty8->can = true;

        $userSecurirty9 = new UserSecuriryForm();
        $userSecurirty9->userid = $userId;
        $userSecurirty9->menuid = 4;
        $userSecurirty9->submenuid = 0;
        $userSecurirty9->show = true;
        $userSecurirty9->can = true;

        $userSecurirty10 = new UserSecuriryForm();
        $userSecurirty10->userid = $userId;
        $userSecurirty10->menuid = 4;
        $userSecurirty10->submenuid = 6;
        $userSecurirty10->show = true;
        $userSecurirty10->can = true;

        $userSecurirty11 = new UserSecuriryForm();
        $userSecurirty11->userid = $userId;
        $userSecurirty11->menuid = 4;
        $userSecurirty11->submenuid = 7;
        $userSecurirty11->show = true;
        $userSecurirty11->can = true;

        $userSecurirty12 = new UserSecuriryForm();
        $userSecurirty12->userid = $userId;
        $userSecurirty12->menuid = 4;
        $userSecurirty12->submenuid = 8;
        $userSecurirty12->show = true;
        $userSecurirty12->can = true;

        $userSecurirty13 = new UserSecuriryForm();
        $userSecurirty13->userid = $userId;
        $userSecurirty13->menuid = 5;
        $userSecurirty13->submenuid = 0;
        $userSecurirty13->show = true;
        $userSecurirty13->can = true;

        $userSecurirty14 = new UserSecuriryForm();
        $userSecurirty14->userid = $userId;
        $userSecurirty14->menuid = 5;
        $userSecurirty14->submenuid = 9;
        $userSecurirty14->show = true;
        $userSecurirty14->can = true;

        $userSecurirty15 = new UserSecuriryForm();
        $userSecurirty15->userid = $userId;
        $userSecurirty15->menuid = 6;
        $userSecurirty15->submenuid = 0;
        $userSecurirty15->show = true;
        $userSecurirty15->can = true;

        $userSecurirty16 = new UserSecuriryForm();
        $userSecurirty16->userid = $userId;
        $userSecurirty16->menuid = 6;
        $userSecurirty16->submenuid = 10;
        $userSecurirty16->show = true;
        $userSecurirty16->can = true;

        $userSecurirty17 = new UserSecuriryForm();
        $userSecurirty17->userid = $userId;
        $userSecurirty17->menuid = 6;
        $userSecurirty17->submenuid = 11;
        $userSecurirty17->show = true;
        $userSecurirty17->can = true;

        $userSecurirty18 = new UserSecuriryForm();
        $userSecurirty18->userid = $userId;
        $userSecurirty18->menuid = 6;
        $userSecurirty18->submenuid = 12;
        $userSecurirty18->show = true;
        $userSecurirty18->can = true;

        UserSecuriryForm::insert($userSecurirty1);
        UserSecuriryForm::insert((array)$userSecurirty2);
        UserSecuriryForm::insert((array)$userSecurirty3);
        UserSecuriryForm::insert((array)$userSecurirty4);
        UserSecuriryForm::insert((array)$userSecurirty5);
        UserSecuriryForm::insert((array)$userSecurirty6);
        UserSecuriryForm::insert((array)$userSecurirty7);
        UserSecuriryForm::insert((array)$userSecurirty8);
        UserSecuriryForm::insert((array)$userSecurirty9);
        UserSecuriryForm::insert((array)$userSecurirty10);
        UserSecuriryForm::insert((array)$userSecurirty11);
        UserSecuriryForm::insert((array)$userSecurirty12);
        UserSecuriryForm::insert((array)$userSecurirty13);
        UserSecuriryForm::insert((array)$userSecurirty14);
        UserSecuriryForm::insert((array)$userSecurirty15);
        UserSecuriryForm::insert((array)$userSecurirty16);
        UserSecuriryForm::insert((array)$userSecurirty17);
        UserSecuriryForm::insert((array)$userSecurirty18);

    }

    

}
