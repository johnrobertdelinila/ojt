<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Maintenance;

class TestController extends Controller
{
    public function under_maintenance(Request $request){
        $check_maintenance = DB::table('maintenance')->select('*')->count();
        return view('pages.under_maintenance')->with('check_maintenance',$check_maintenance);
    }
    public function maintenance_trigger(Request $request){
        if($request->id == 'on'){
            $post = new Maintenance;
            $post->maintenance_date = '';
            $post->save();
            echo "Maintenance Activated";
            exit();
        }else{
            $post = DB::table('maintenance')->where('id','>',0)->delete();
            echo "Maintenance Deactivated";
            exit();
        }
    }
}
