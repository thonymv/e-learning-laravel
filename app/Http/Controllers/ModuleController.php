<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Module;

class ModuleController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return Module::create($data);
    }

    public function getModule(Request $request,$id)
    {
        $module = Module::find($id);
        $module->lessons;
        return response()->json($module,200);
    }
}
