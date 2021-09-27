<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DTR;
use Illuminate\Support\Facades\Hash;
use App\User_Table;

class FirebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user, $pass)
    {
        $user = DB::table('users')->where('email', $user)->get();
        if (!count($user)) {
            echo 'invalid';
        }else {
            if (password_verify($pass, $user[0]->password)) {
                echo $user;
            } else {
                echo 'invalid';
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchUserAttendance($name)
    {
        $attendance = DB::table('dtr')->where('name', $name)->get();
        if (!count($attendance)) {
            echo 'no attendance';
        }else {
            echo $attendance;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttendance($data)
    {
        $attendance = json_decode($data, true);

        $name = $attendance['name'];
        $date = $attendance['date'];
        $time1 = $attendance['time_in_am'];
        $time2 = $attendance['time_out_am'];
        $time3 = $attendance['time_in_pm'];
        $time4 = $attendance['time_out_pm'];
        $accomplishment = $attendance['accomplishments'];

        $check_entry = DB::table('dtr')
        ->where('name', $name)
        ->where('date', $date)
        ->count();
        $check_entry_get = DB::table('dtr')
        ->select('*')
        ->where('name', $name)
        ->where('date', $date)
        ->get();

        $carbon_now_date = $date;
        // $carbon_now_time = date("H:i:s", strtotime("" . $time . ""));

        if($check_entry >= 1){
            $post = DTR::find($check_entry_get[0]->id);
            if($check_entry_get[0]->time2 == '' && $check_entry_get[0]->time3 == '' && $check_entry_get[0]->time4 == ''){
                $post->time2 = is_null($time2) ? NULL : date("H:i:s", strtotime("" . $time2 . ""));
                $post->save();
                echo $post->id;

            }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 == '' && $check_entry_get[0]->time4 == ''){
                $post->time3 = is_null($time3) ? NULL : date("H:i:s", strtotime("" . $time3 . ""));
                $post->save();
                echo $post->id;

            }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 == ''){
                $post->time4 = is_null($time4) ? NULL : date("H:i:s", strtotime("" . $time4 . ""));
                $post->accomplishment = $accomplishment;
                $post->save();
                echo $post->id;
            }else {
                $post->time1 = (date("H:i:s", strtotime("" . $time1 . "")) > $post->time1 ? $post->time1 : date("H:i:s", strtotime("" . $time1 . "")));
                $post->time2 = (date("H:i:s", strtotime("" . $time2 . "")) > $post->time2 ? $post->time2 : date("H:i:s", strtotime("" . $time2 . "")));
                $post->time3 = (date("H:i:s", strtotime("" . $time3 . "")) > $post->time3 ? $post->time3 : date("H:i:s", strtotime("" . $time3 . "")));
                $post->time4 = (date("H:i:s", strtotime("" . $time4 . "")) > $post->time4 ? $post->time4 : date("H:i:s", strtotime("" . $time4 . "")));
                $post->save();
                echo $post->id;
            }
        }else{
            $post = new DTR;
            $post->name = $name;
            $post->date = $carbon_now_date;
            $post->time1 = date("H:i:s", strtotime("" . $time1 . ""));
            $post->time2 = is_null($time2) ? NULL : date("H:i:s", strtotime("" . $time2 . ""));
            $post->time3 = is_null($time3) ? NULL : date("H:i:s", strtotime("" . $time3 . ""));
            $post->time4 = is_null($time4) ? NULL : date("H:i:s", strtotime("" . $time4 . ""));
            $post->save();
            echo $post->id;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fetchAllAttendance()
    {
        $attendance = DB::table('dtr')->get();
        if (!count($attendance)) {
            echo 'no attendance';
        }else {
            echo $attendance;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword($id, $old_password, $new_password)
    {
        $user = DB::table('users')->where('id', $id)->get();
        // $user_password = User_Table::find($id);
        // $user_password->password = Hash::make($new_password);
        // $user_password->save(); 

        if(Hash::check($old_password, $user[0]->password)){
            $user_password = User_Table::find($id);
            $user_password->password = Hash::make($new_password);
            $user_password->save();
            return "success";
        }else{
            return "auth failed";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifier($id, $old_password)
    {
        $user = DB::table('users')->where('id', $id)->get();
        if(Hash::check($old_password, $user[0]->password)){
            return "success";
        }else{
            return "auth failed";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
