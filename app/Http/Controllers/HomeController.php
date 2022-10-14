<?php

namespace App\Http\Controllers;

use App\Models\Disciplines;
use App\Models\cmd_disciplines;
use App\Models\MiscListStates;
use App\Models\cmd_mislist_states;
use App\Models\menu;
use App\Models\SubMenu;
use App\Models\userSecuriryForm;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'idrole']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = session()->get('id');

        $menu['menu'] = menu::join("user_securiry_forms", "user_securiry_forms.menuid", "=", "menus.menuid")
            ->select("menus.name", "menus.menuid", "menus.logo", "user_securiry_forms.show", "user_securiry_forms.can")
            ->where("user_securiry_forms.userid", "=", $userId)
            ->groupBy('menus.menuid')
            ->get();


        $submenu['submenu'] = SubMenu::join("user_securiry_forms", "user_securiry_forms.submenuid", "=", "submenus.submenuid")
            ->select("submenus.name", "user_securiry_forms.menuid", "submenus.logo", "submenus.route", "user_securiry_forms.show", "user_securiry_forms.can")
            ->where("user_securiry_forms.userid", "=", $userId)
            ->distinct('submenus.name')
            ->get();

        session(['menu' => $menu['menu']]);

        session(['submenu' => $submenu['submenu']]);

        return view('dashboard', $menu, $submenu);
    }

    public function save_misclist()
    {
        echo $aux = false;
        $disciplines = Disciplines::all();

        if ($disciplines->count() <= 0) {

            $cmdDiscplines = cmd_disciplines::all();
            $disciplineList = json_decode($cmdDiscplines, true);

            foreach ($disciplineList as $discipline) {
                $new_discipline = new Disciplines();
                $new_discipline = $discipline;
                $new_discipline['created_at'] = date('Y-m-d H:i:s', strtotime($discipline['created_at']));
                $new_discipline['updated_at'] = date('Y-m-d H:i:s', strtotime($discipline['created_at']));
                Disciplines::insert($new_discipline);
            }
            $aux = true;
        }

        $states = MiscListStates::all();

        if ($states->count() <= 0) {
            $cmdStates = cmd_mislist_states::all();
            $statesList = json_decode($cmdStates, true);

            foreach ($statesList as $state) {
                $new_state = new MiscListStates();
                $new_state = $state;
                $new_state['created_at'] = date('Y-m-d H:i:s', strtotime($state['created_at']));
                $new_state['updated_at'] = date('Y-m-d H:i:s', strtotime($state['created_at']));
                MiscListStates::insert($new_state);
            }
            $aux = true;
        }


        if ($aux)
            return redirect('/index')->with('mensaje', 'Parametrizaciones creada con éxito.');
        else
            return redirect('/index')->with('mensaje', 'Ya cuenta con parametrizaciones creadas actualmente.');
    }
}
