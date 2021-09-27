<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
  
class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function activation()
    {
       return view('pages.activation');
    }

    public function activate_system(request $request){

        $variable_file = fopen("valuable.txt", "r") or die("Unable to open file!");
        $valuable = fread($variable_file,filesize("valuable.txt"));
        fclose($variable_file);
        
        if(base64_encode($request->input('activation_key')) == $valuable){
            $myfile = fopen("profile.txt", "w") or die("Unable to open file!");
            $txt = $request->input('activation_key').trim(str_replace('SerialNumber','',shell_exec('wmic DISKDRIVE GET SerialNumber 2>&1')));
            fwrite($myfile, base64_encode($txt));
            fclose($myfile);
            return redirect()->action('InventoryController@dashboard');
        }else{
            $myfile = fopen("profile.txt", "w") or die("Unable to open file!");
            fwrite($myfile, "THE PRODUCT IS NOT ACTIVATED, YOU HAVE TO CONTACT THE PROGRAMMER.");
            fclose($myfile);
            return back();
        }


    }


    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
           
        return back();
    }
}