<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Maintenance;
use App\User_Table;
use App\DTR;
use App\Announcement;
use App\Classwork;
use App\FileUpload;
use App\ClassworkAttachment;
use App\Revisions;
use App\holidays;
use App\Overtime_Request;
use App\Evaluation;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

//asdasd
class OjtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //validator
        $messages = [
            'inv_unit_value.numeric' => 'The unit value must be a number.',
            'inv_total_value.numeric' => 'The total value must be a number.',
            'inv_netbook_value.numeric' => 'The netbook value must be a number.',
        ];
        $request->validate([
            'inv_unit_value' => 'numeric|between:0,10000000000.99',
            'inv_total_value' => 'numeric|between:0,10000000000.99',
            'inv_netbook_value' => 'numeric|between:0,10000000000.99',
        ],$messages);
        $ctr = 0;
        // $date_yr = date('Y',strtotime($request->input('inv_date_acq')));
        // $ctr = Inventory::where('inv_yr',$date_yr)->max('inv_ctr')+1;
        // $ctr_inv_id = Inventory::all()->max('id')+1;

        if($request->input('buyer_name') != "" && $request->input('item_amount') != ""){
            foreach($request->input('buyer_name') as $key=>$value){
                if($request->input('buyer_name')[$key] != "" && $request->input('item_amount')[$key] != ""){
                    $ctr = $ctr+1;
                    if($request->input('buyer_name')[$key] != ''){
                        $post = new Inventory;
                        $post->qrcode = rand();
                        $post->seller_id = $request->input('seller_id');
                        $post->buyer_name = $request->input('buyer_name')[$key];
                        $post->item_amount = $request->input('item_amount')[$key];
                        $post->item_remarks = '-';
                        $post->item_status = 'Pending';
                        $post->item_bookmark = 'no';
                        $post->date_actioned = '-';
                        $post->date_created = Carbon::now('Asia/Manila');
                        $post->created_at = Carbon::now('Asia/Manila');
                        $post->updated_at = Carbon::now('Asia/Manila');
                        $post->save();
                    }
                }
            }
            $seller_query = DB::table('sellers')->select('seller_name')->where('id',$request->input('seller_id'))->get();
            foreach($seller_query as $sellers_query){
                $seller_query_name = $sellers_query->seller_name;
            }
        }
        return back()->with('suc_ctr',$ctr)->with('suc_name',$seller_query_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //validator
        $messages = [
            'inv_unit_value.numeric' => 'The unit value must be a number.',
            'inv_total_value.numeric' => 'The total value must be a number.',
            'inv_netbook_value.numeric' => 'The netbook value must be a number.',
        ];
        $request->validate([
            'inv_unit_value' => 'numeric|between:0,10000000000.99',
            'inv_total_value' => 'numeric|between:0,10000000000.99',
            'inv_netbook_value' => 'numeric|between:0,10000000000.99',
        ],$messages);
        //count start
        $acc_count = DB::table('accessories')->where('inv_tracer',$id)->count()+1;
        //count start
        ///////////////// lifespan exploded
        $lifespan_explode = (explode("|",$request->input('inv_life_span')));
        /////////////////

        $post = Inventory::find($id);
        $post -> inv_name = $request->input('inv_name');
        //PROPERTY NO. TEMPORARY START
            // $post -> inv_prop_no = 'DENR-EMB1-'.$request->input('inv_prop_no').'-'.$post -> inv_ctr.'-'.substr($post -> inv_yr,2); //temporary comment
            $post -> inv_prop_no = $request->input('property_number_temporary');
        //PROPERTY NO. TEMPORARY END
        if($request->input('inv_desc') == ""){
            $post->inv_desc = "";
        }else{
            $post->inv_desc = $request->input('inv_desc');
        }
        $post -> inv_date_acq = $request->input('inv_date_acq');
        $post -> inv_serial = $request->input('inv_serial');
        $post -> inv_mr = strtoupper($request->input('inv_mr'));
        $post -> inv_extra1 = $lifespan_explode[1];
        $post -> inv_extra2 = $request->input('inv_prop_no');
        $post -> inv_extra3 = $lifespan_explode[0];
        $post -> inv_extra4 = $request->input('inv_qty_unit');
        $post -> inv_locator = strtoupper($request->input('inv_locator'));
        $post -> inv_unit_value = $request->input('inv_unit_value');
        $post -> inv_total_value = $request->input('inv_total_value');
        $post -> inv_netbook_value = $request->input('inv_netbook_value');
        $post -> inv_remarks = $request->input('inv_remarks');
        if($request->input('par_name')){
            foreach($request->input('par_name') as $key=>$value){
                if($request->input('par_name')[$key] != ''){
                    $post_par = new PAR;
                    $post_par->par_name = strtoupper($request->input('par_name')[$key]);
                    $post_par->par_level = 'Employee';
                    $post_par->inv_tracer = $id;
                    $post_par->save();
                }
            }
        }
        if($request->input('acc_name')){
            foreach($request->input('acc_name') as $key=>$value){
                if($request->input('acc_name')[$key] != ''){
                    $post_acc = new Accessories;
                    $post_acc->acc_name = $request->input('acc_name')[$key];
                    if($request->input('acc_serial')[$key] != ''){ $post_acc->acc_serial = $request->input('acc_serial')[$key]; }
                    $post_acc->inv_tracer = $id;
                    //prop no accessories
                    switch($acc_count++){
                        case 1: $suffix = 'A'; break;
                        case 2: $suffix = 'B'; break;
                        case 3: $suffix = 'C'; break;
                        case 4: $suffix = 'D'; break;
                        case 5: $suffix = 'E'; break;
                        case 6: $suffix = 'F'; break;
                        case 7: $suffix = 'G'; break;
                        case 8: $suffix = 'H'; break;
                        case 9: $suffix = 'I'; break;
                        case 10: $suffix = 'J'; break;
                        case 11: $suffix = 'K'; break;
                        case 12: $suffix = 'L'; break;
                        case 13: $suffix = 'M'; break;
                        case 14: $suffix = 'N'; break;
                        case 15: $suffix = 'O'; break;
                        case 16: $suffix = 'P'; break;
                        case 17: $suffix = 'Q'; break;
                        case 18: $suffix = 'R'; break;
                        case 19: $suffix = 'S'; break;
                        case 20: $suffix = 'T'; break;
                        case 21: $suffix = 'U'; break;
                        case 22: $suffix = 'V'; break;
                        case 23: $suffix = 'W'; break;
                        case 24: $suffix = 'X'; break;
                        case 25: $suffix = 'Y'; break;
                        case 26: $suffix = 'Z'; break;
                        default: $suffix = 'XXX';
                    }
                    //PROPERTY NO. TEMPORARY START
                        $post_acc->acc_prop_no = 'DENR-EMB1-'.$request->input('inv_prop_no').'-'.$post -> inv_ctr.'-'.substr($post -> inv_yr,-2).$suffix;
                        //PROPERTY NO. TEMPORARY END
                    $post_acc->acc_suffix = $suffix;
                    //prop no accessories
                    $post_acc->save();
                }
            }
        }
        $post -> save();
        //PROPERTY NO. TEMPORARY START
            // return back()->with('suc','DENR-EMB1-'.$request->input('inv_prop_no').'-'.$post -> inv_ctr.'-'.substr($post -> inv_yr,2)); //temporary comment
            return back()->with('suc',$request->input('property_number_temporary'));
        //PROPERTY NO. TEMPORARY START
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

    ///////////////////////////////////////////     ADDITIONAL     ///////////////////////////////////////////
    public function dashboard(){
        if(Auth::user()->status == "Deactivated"){
            auth()->logout();
            return back()->with('deactivated','Your account was deactivated by the administrator.');
        }else{
            $post_all = DB::table('travelorder')->count();
            $post_pending = DB::table('travelorder')->where('travel_status','PENDING')->count();
            $post_recommended_for_approval = DB::table('travelorder')->where('travel_status','RECOMMENDED FOR APPROVAL')->count();
            $post_approved = DB::table('travelorder')->where('travel_status','APPROVED')->count();
            $post_disapproved = DB::table('travelorder')->where('travel_status','DISAPPROVED')->count();
            $post_users = DB::table('users')->count();
            return view('pages.dashboard', [
                'post_all'=>$post_all,
                'post_pending'=>$post_pending,
                'post_recommended_for_approval'=>$post_recommended_for_approval,
                'post_approved'=>$post_approved,
                'post_disapproved'=>$post_disapproved,
                'post_users'=>$post_users,
            ]);
        }
    }
    
    public function deactivate_seller(request $request){
        $deactivate_sellers = DB::table('sellers')->where('id',$request->id)->update(['seller_status'=>'no']);
        return back();
    }
    public function activate_seller(request $request){
        $deactivate_sellers = DB::table('sellers')->where('id',$request->id)->update(['seller_status'=>'yes']);
        return back();
    }
    public function edit_seller(request $request){
        $post = DB::table('sellers')->select('*')->where('id',$request->id)->get();
        foreach($post as $posts){
            return back()
            ->with('seller_id',$posts->id)
            ->with('seller_name',$posts->seller_name)
            ->with('seller_contact',str_replace('+63','',$posts->seller_contact))
            ->with('seller_remarks',$posts->seller_remarks);
        }
    }
    public function buyers_lists(){
        $post_buyers = DB::table('inventory')->select('buyer_name')->groupby('buyer_name')->orderby('buyer_name','asc')->paginate(100);
        return view('pages.buyers_lists',['post_buyers'=>$post_buyers,]);    
    }
    public function maintenance_schedule(){
        if(Auth::user()->utype != "0"){
            return back();
        }else{
            $post = DB::table('maintenance')->select('*')->orderby('id','desc')->limit(1)->get();
            return view('pages.maintenance_schedule')->with('post',$post);
        }
    }
    public function maintenance_add(request $request){
        $insert = new Maintenance();
        $insert->maintenance_date = $request->input('maintenance_date');
        $insert->save();
        return back();       
    }

    //identifier start
    public function identifier_add(request $request){
        $post_identifier = new Identifier;
        $post_identifier->identifier_name = strtoupper($request->input('identifier_name'));
        $post_identifier->save();
        return back()->with('suc','Successfully added a new identifier.'); 
    }
    public function identifier_delete(request $request){
        $post_identifier = DB::table('identifier')->where('id',$request->id)->delete();
        return back(); 
    }
    public function identifier_lists(){
        $post_identifier = DB::table('identifier')->select('*')->get();
        return view('pages.identifier_lists',['post_identifier'=>$post_identifier,]);    
    }
    //identifier end

    //users start
    public function users_lists(){
        if(Auth::user()->utype != "admin"){
            return back();
        }else{
            $post_users = DB::table('users')->select('*')->orderby('name','asc')->paginate(50);
            return view('pages.users_lists',['post_users'=>$post_users,]);
        }
    }
    public function users_registration(){
        if(Auth::user()->utype != "admin"){
            return back();
        }else{
            $post_assignatories = DB::table('assignatories')->select('*')->get();
            return view('pages.users_registration')->with('post_assignatories',$post_assignatories);
        }
    }
    public function users_edit(request $request){
        if(Auth::user()->utype != "admin"){
            return back();
        }else{
            $post_users = DB::table('users')->select('*')->get();
            $post_users_particular = DB::table('users')->where('id',$request->id)->select('*')->get();
            return view('pages.users_edit',['post_users'=>$post_users,'post_users_particular'=>$post_users_particular,]);    
        }

    }
    public function users_edit_password(request $request){
        $post_users_particular = DB::table('users')->where('id',$request->id)->select('*')->get();
        return view('pages.users_edit_password')->with('post_users_particular', $post_users_particular);
    }
    public function users_resetpassword(request $request){
        if(Auth::user()->utype != "admin"){
            return back();
        }else{
            $qry = DB::table('users')->where('id',$request->id)->update(['password'=>Hash::make('1234567')]);
            return back()->with('suc','Successfully reset the password into 1234567');
        }
    }
    public function users_deactivated(request $request){
        if(Auth::user()->utype != "admin"){
            return back();
        }else{
            $deactivate_users = DB::table('users')->where('id',$request->id)->update(['status'=>'Deactivated']);
            return back();
        }
    }
    public function users_activate(request $request){
        if(Auth::user()->utype != "admin"){
            return back();
        }else{
            $deactivate_users = DB::table('users')->where('id',$request->id)->update(['status'=>'Active']);
            return back();
        }
    }
    public function change_password(request $request){
        if(Hash::check($request->input('old_password'), Auth::user()->password)){
            $user_password = User_Table::find($request->id);
            $user_password->password = Hash::make($request->input('new_password'));
            $user_password->save();
            return back()->with('suc2','Successfully changed your password!');
        }else{
            return back()->with('err2','Wrong Old Password!');
        }
    }
    public function change_information(request $request){
        $user_information = User_Table::find($request->id);
        $user_information->name = $request->input('name');
        $user_information->position = $request->input('position');
        $user_information->agency = $request->input('agency');
        $user_information->save();
        return back()->with('suc2','Successfully changed your information!');
    }
    //users end
    
    public function logbook(){
        if(Auth::user()->status == "Deactivated"){
            auth()->logout();
            return back()->with('deactivated','Your account was deactivated by the administrator.');
        }else{
            $holidays_count = DB::table('holidays')
            ->where('holiday_date',Carbon::now('Asia/Manila')->toDateString())
            ->count();
            $check_entry = DB::table('dtr')
            ->where('name',Auth::user()->name)
            ->where('date',Carbon::now('Asia/Manila')->toDateString())
            ->count();
            $check_entry_get = DB::table('dtr')
            ->select('*')
            ->where('name',Auth::user()->name)
            ->where('date',Carbon::now('Asia/Manila')->toDateString())
            ->get();
    
            if($check_entry >= 1){
                $post = DTR::find($check_entry_get[0]->id);
                if($check_entry_get[0]->time2 == '' && $check_entry_get[0]->time3 == '' && $check_entry_get[0]->time4 == ''){
                    return view('pages.logbook')->with('holidays_count', $holidays_count)->with('btn_check','time2');
                }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 == '' && $check_entry_get[0]->time4 == ''){
                    return view('pages.logbook')->with('holidays_count', $holidays_count)->with('btn_check','time3');
                }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 == ''){
                    $file_list = DB::table('uploads')
                    ->select('*')
                    ->where('dtr_id',$check_entry_get[0]->id)
                    ->orderBy('id','asc')
                    ->get();
                    return view('pages.logbook')
                    ->with('holidays_count', $holidays_count)
                    ->with('btn_check','time4')
                    ->with('dtr_id',$check_entry_get[0]->id)
                    ->with('file_list',$file_list)
                    ->with('accomplishment',$check_entry_get[0]->accomplishment);
                }else{
                    if( (date("Y-m-d") >= date("Y-m-d", strtotime(Auth::user()->ot_start))) && (date("Y-m-d") <= date("Y-m-d", strtotime(Auth::user()->ot_end))) ){
                        if($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 != '' && $check_entry_get[0]->time5 == ''){
                            return view('pages.logbook')->with('holidays_count', $holidays_count)->with('btn_check','time5');
                        }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 != '' && $check_entry_get[0]->time5 != '' && $check_entry_get[0]->time6 == ''){
                            $file_list = DB::table('uploads')
                            ->select('*')
                            ->where('dtr_id',$check_entry_get[0]->id)
                            ->orderBy('id','asc')
                            ->get();
                            return view('pages.logbook')->with('holidays_count', $holidays_count)
                            ->with('btn_check','time6')
                            ->with('dtr_id',$check_entry_get[0]->id)
                            ->with('file_list',$file_list)
                            ->with('accomplishment',$check_entry_get[0]->accomplishment);
                        }else{
                            return view('pages.logbook')->with('holidays_count', $holidays_count)->with('btn_check','time7');
                        }
                    }else{
                        return view('pages.logbook')->with('holidays_count', $holidays_count)->with('btn_check','time5');
                    }
                }
                $post->save();
            }else{
                return view('pages.logbook')->with('holidays_count', $holidays_count)->with('btn_check','time1');
            }
        }
    }

    public function classwork_detail(request $request){

        $classwork = Classwork::with('classwork_attachment.user')->where('id', $request->id)->get()->first();
        return view('pages.classwork_detail')->with('classwork', $classwork)->with('user_id', Auth::user()->id);
    }

    public function classwork(request $request){
        return view('pages.classwork')->with('classworks', Classwork::with('user')->orderby('id', 'DESC')->get());
    }

    public function classwork_reg(Request $request) {
        $post = new Classwork();
        $post->description = $request->description;
        $post->created_at = Carbon::now('Asia/Manila');
        $post->updated_at = Carbon::now('Asia/Manila');
        $post->user_id = Auth::user()->id;
        $post->save();

        return back()->with('suc','New announcement has been posted!');
    }
    
    public function announcement(request $request){
        return view('pages.announcement')->with('announcements', Announcement::with('user')->orderby('id', 'DESC')->get());
    }

    public function announcement_reg(Request $request) {
        $post = new Announcement();
        $post->announcement = $request->announcement;
        $post->created_at = Carbon::now('Asia/Manila');
        $post->updated_at = Carbon::now('Asia/Manila');
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->save();

        return back()->with('suc','New announcement has been posted!');
    }

    public function evaluation(Request $request) {
        return view('pages.evaluation')->with('classworks', Classwork::with('user')->orderby('id', 'DESC')->get());
    }

    public function submit_evaluation(Request $request) {
        $post = new Evaluation();
        $post->id=$request->id;
        $post->name=$request->name;
        $post->company=$request->company;
        $post->department=$request->department;
        $post->address=$request->address;
        $post->jobskill=$request->jobskill;
        $post->quality=$request->quality;
        $post->service=$request->service;
        $post->judgment=$request->judgment;
        $post->adaptability=$request->adaptability;
        $post->communication=$request->communication;
        $post->attendance=$request->attendance;
        $post->safety=$request->safety;
        $post->gala=$request->gala;
        $post->placed=$request->placed;
        $post->qualification=$request->qualification;
        $post->weakness=$request->weakness;
        $post->supervisor=$request->supervisor;
        $post->date=$request->date;
        $post->save();

        return back()->with('suc','New announcement has been posted!');
    }

    public function dtr_process(request $request){
        $check_entry = DB::table('dtr')
        ->where('name',Auth::user()->name)
        ->where('date',Carbon::now('Asia/Manila')->toDateString())
        ->count();
        $check_entry_get = DB::table('dtr')
        ->select('*')
        ->where('name',Auth::user()->name)
        ->where('date',Carbon::now('Asia/Manila')->toDateString())
        ->get();

        $carbon_now_date = Carbon::now('Asia/Manila')->toDateString();
        $carbon_now_time = Carbon::now('Asia/Manila')->toTimeString();

        if($check_entry >= 1){
            $post = DTR::find($check_entry_get[0]->id);
            if($check_entry_get[0]->time2 == ''){
                $post->time2 = $carbon_now_time;
                $post->updated_at = Carbon::now('Asia/Manila');
                $post->save();
                $this->singleAttendance(Auth::user()->id, $post);
                return back()
                ->with('suc','You have successfully Timed Out (NN)')
                ->with('time',$carbon_now_time);

            }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 == ''){
                $post->time3 = $carbon_now_time;
                $post->updated_at = Carbon::now('Asia/Manila');
                $post->save();
                $this->singleAttendance(Auth::user()->id, $post);
                return back()
                ->with('suc','You have successfully Timed In (NN)')
                ->with('time',$carbon_now_time);

            }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 == ''){
                if($request->input('btn_save')){
                    $post->accomplishment = $request->input('accomplishment');
                    $post->save();
                    $this->singleAttendance(Auth::user()->id, $post);
                    return back();
                }else{
                    if($request->input('accomplishment') != ""){
                        $post->time4 = $carbon_now_time;
                        $post->updated_at = Carbon::now('Asia/Manila');
                        $post->accomplishment = $request->input('accomplishment');
                        $post->save();
                        $this->singleAttendance(Auth::user()->id, $post);
                        return back()
                        ->with('suc','You have successfully Timed Out (PM)')
                        ->with('time',$carbon_now_time);
                    }else{
                        return back()->with('err','Journal field is required.');
                    }
                }
            }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 != '' && $check_entry_get[0]->time5 == ''){
                $post->time5 = $carbon_now_time;
                $post->updated_at = Carbon::now('Asia/Manila');
                $post->save();
                $this->singleAttendance(Auth::user()->id, $post);
                return back()
                ->with('suc','You have successfully Overtimed In')
                ->with('time',$carbon_now_time);

            }elseif($check_entry_get[0]->time2 != '' && $check_entry_get[0]->time3 != '' && $check_entry_get[0]->time4 != '' && $check_entry_get[0]->time5 != '' && $check_entry_get[0]->time6 == ''){
                if($request->input('btn_save')){
                    $post->accomplishment = $request->input('accomplishment');
                    $post->save();
                    $this->singleAttendance(Auth::user()->id, $post);
                    return back();
                }else{
                    if($request->input('accomplishment') != ""){
                        $post->time6 = $carbon_now_time;
                        $post->updated_at = Carbon::now('Asia/Manila');
                        $post->accomplishment = $request->input('accomplishment');
                        $post->save();
                        $this->singleAttendance(Auth::user()->id, $post);
                        return back()
                        ->with('suc','You have successfully Overtimed Out')
                        ->with('time',$carbon_now_time);
                    }else{
                        return back()->with('err','Journal field is required.');
                    }
                }
            }else{ return back(); }
        }else{
            $post = new DTR;
            $post->name = Auth::user()->name;
            $post->date = $carbon_now_date;
            $post->time1 = $carbon_now_time;
            $post->created_at = Carbon::now('Asia/Manila');
            $post->updated_at = Carbon::now('Asia/Manila');
            // $post->sync = 0;
            $post->save();
            $this->singleAttendance(Auth::user()->id, $post);
            return back()
            ->with('suc','You have successfully Timed In (AM)')
            ->with('time',$carbon_now_time);
        }

    }
    
    public function dtr_lists(request $request){
        if($request->input('employee_name') || $request->input('date') || $request->input('per_page')){
            if($request->input('filter')){
                $post_users = DB::table('users')->select('*')->get();
                $post_dtr = DB::table('dtr')
                ->select('*')->orderBy('id', 'desc')
                ->where('name','like','%'.$request['employee_name'].'%')
                ->whereBetween('date', [$request['start_date'], $request['end_date']])
                ->paginate($request->input('per_page'));
                $post_file = DB::table('uploads')->select('*')->get();
                $post_revisions = DB::table('revisions')->select('*')->get();
        
                return view('pages.dtr_lists')
                ->with('post_users',$post_users)
                ->with('post_dtr',$post_dtr)
                ->with('post_file',$post_file)
                ->with('post_revisions',$post_revisions)
                ->with('employee_name',$request->input('employee_name'))
                ->with('start_date',$request->input('start_date'))
                ->with('end_date',$request->input('end_date'))
                ->with('per_page',$request->input('per_page'));
            }else{
                if($request->all('print')['print'] == 'Accomplishments'){
                    $post_dtr = DB::table('dtr')
                            ->select('date','accomplishment')
                            ->where('name','like','%'.$request['employee_name'].'%')
                            ->whereBetween('date', [$request['start_date'], $request['end_date']])
                            ->get();
                        
                    $days = cal_days_in_month( 0, date('m',strtotime($post_dtr[0]->date)), date('Y',strtotime($post_dtr[0]->date)));
                    for($i = 1 ; $i<=$days;$i++){
                        $predate = date('Y-m-').$i;
                    }
                     $section_head = DB::table('users')
                    ->leftjoin('assignatories','assignatories.id','=','users.Assig_unit')
                    ->select('assignatories.unit_head','assignatories.unit_title')
                    ->where('name','like','%'.$request['employee_name'].'%')
                    ->get();
                    if(is_array($section_head) || count($section_head) >= 0 ){
                        $head = $section_head[0]->unit_head;
                        $title = $section_head[0]->unit_title;
                    }else{
                        $head = '';
                        $title = '';
                    }
                    return view('pages.dtr_print_accomplishments')
                            ->with('post_dtr',$post_dtr)
                            ->with('employee_name',$request->input('employee_name'))
                            ->with('agency',$title)
                            ->with('section_head',$head)
                            ->with('start_date',$request->input('start_date'))
                            ->with('end_date',$request->input('end_date'));
                }else{
                    $post_dtr = DB::table('dtr')
                    ->select('*')->orderBy('id', 'asc')
                    ->where('name','like','%'.$request['employee_name'].'%')
                    ->whereBetween('date', [$request['start_date'], $request['end_date']])
                    ->get();
                    
                    $section_head = DB::table('users')
                                ->leftjoin('assignatories','assignatories.id','=','users.Assig_unit')
                                ->select('assignatories.unit_head','assignatories.unit_title')
                                ->where('name','like','%'.$request['employee_name'].'%')
                                ->get();
                    if(is_array($section_head) || count($section_head) >= 0 ){
                        $head = $section_head[0]->unit_head;
                        $title = $section_head[0]->unit_title;
                    }else{
                        $head = '';
                        $title = '';
                    }
                    return view('pages.dtr_print_all')
                    ->with('post_dtr',$post_dtr)
                    ->with('employee_name',$request->input('employee_name'))
                    ->with('agency',$title)
                    ->with('section_head',$head)
                    ->with('start_date',$request->input('start_date'))
                    ->with('end_date',$request->input('end_date'))
                    ->with('per_page',$request->input('per_page'));
                }
            }
        }else{
            $post_users = DB::table('users')->select('*')->get();
            $post_dtr = DB::table('dtr')->select('*')->orderBy('id', 'desc')->paginate(10);
            $post_file = DB::table('uploads')->select('*')->get();
            $post_revisions = DB::table('revisions')->select('*')->get();
    
            return view('pages.dtr_lists')
            ->with('post_users',$post_users)
            ->with('post_dtr',$post_dtr)
            ->with('post_file',$post_file)
            ->with('post_revisions',$post_revisions);
        }
    }

    public function dtr_print(request $request){
        $post_records = DB::table('dtr')->select('*')->where('id',$request->id)->get();
        return view('pages.dtr_print')->with('post_records',$post_records);
    }

    public function fileStoreClasswork(Request $request){
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('classworks/' . $request->input('classwork_id') . '/' . Auth::user()->id), $imageName);
        
        $imageUpload = new ClassworkAttachment();
        $imageUpload->classwork_id = $request->input('classwork_id');
        $imageUpload->filename = $imageName;
        $imageUpload->user_id = Auth::user()->id;
        $imageUpload->save();

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroyClasswork(Request $request){
        $filename =  $request->get('filename');
        $classwork_id = $request->get('classwork_id');
        ClassworkAttachment::where('classwork_id',$classwork_id)->where('filename', $filename)->delete();

        $path=public_path().'/classworks/'. $classwork_id . '/'. Auth::user()->id .'/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename . " deleted " . $classwork_id;  
    }
    
    public function revisionsStoreClasswork(Request $request){
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        
        $imageUpload = new Revisions();
        $imageUpload->uploads_id = $request->input('uploads_id');
        $imageUpload->file_name = $imageName;
        $imageUpload->save();

        return response()->json(['success'=>$imageName]);
    }

    public function revisionsDestroyClasswork(Request $request){
        $filename =  $request->get('filename');
        Revisions::where('file_name',$filename)->delete();

        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }

    public function delete_single_file_classwork(Request $request){
        $filename =  $request->filename;
        $classwork_id =  $request->classwork_id;
        ClassworkAttachment::where('classwork_id', $classwork_id)->where('filename', $filename)->delete();
    
        $path=public_path().'/classworks/'. $classwork_id . '/'. Auth::user()->id .'/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return back();  
    }

    public function fileStore(Request $request){
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        
        $imageUpload = new FileUpload();
        $imageUpload->dtr_id = $request->input('dtr_id');
        $imageUpload->file_name = $imageName;
        $imageUpload->save();

        // $this->firebase_fetch_attachments($imageUpload->dtr_id);

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy(Request $request){
        $filename =  $request->get('filename');
        FileUpload::where('file_name',$filename)->delete();

        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
    
    public function revisionsStore(Request $request){
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        
        $imageUpload = new Revisions();
        $imageUpload->uploads_id = $request->input('uploads_id');
        $imageUpload->file_name = $imageName;
        $imageUpload->save();

        return response()->json(['success'=>$imageName]);
    }

    public function revisionsDestroy(Request $request){
        $filename =  $request->get('filename');
        Revisions::where('file_name',$filename)->delete();

        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }

    public function delete_single_file(Request $request){
        $filename =  $request->filename;
        FileUpload::where('file_name',$filename)->delete();

        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return back();  
    }
    
    public function under_maintenance(Request $request){
        return view('pages.under_maintenance');
    }

    public function add_remarks(Request $request){
        $post = DTR::find($request->input('id'));
        $post->remarks = $request->input('remarks');
        $post->save();

        $user = DB::table('users')->where('name', $post->name)->select('*')->get();
        $this->firebase($user[0]->id, $post->name);

        return back();
    }

    public function user_reg(request $request){
        $validatedData = $request->validate([
            'email' => 'unique:users',
        ]);

        $post = new User_Table;
        $post->student_id = $request->input('student_id');
        $post->name = $request->input('name');
        $post->position = $request->input('position');
        $post->agency = $request->input('agency');
        $post->signature = $request->input('signature');
        $post->email = $request->input('email');
        $post->password = Hash::make($request->input('password'));
        $post->utype = $request->input('utype');
        $post->status = 'Active';
        $post->created_at = Carbon::now('Asia/Manila');
        $post->updated_at = Carbon::now('Asia/Manila');
        $post->Assig_unit = $request->input('assignatories');
        $post->save();

        return back()->with('suc','Successfully Registered A New User!');
    }

    public function firebase($id, $name) {
        // Firebase
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceAccountKey.json');
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->withDatabaseUri('https://hackathon-9e577.firebaseio.com/')
        //     ->create();

        // $database = $firebase->getDatabase();
        // $mysqlRef = $database->getReference('mysql/' . $id);
        // $data = array(
        //     'function' => 'fetch_attendance',
        //     'name' => $name
        // );
        // $mysqlRef->set($data);
        // return NULL;
    }

    public function singleAttendance($attendanceId, $attendance) {
        // Firebase
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceAccountKey.json');
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->withDatabaseUri('https://hackathon-9e577.firebaseio.com/')
        //     ->create();

        // $database = $firebase->getDatabase();
        // $mysqlRef = $database->getReference('mysql/' . $attendanceId);
        // $data = array(
        //     'function' => 'single_attendance',
        //     'attendance' => $attendance
        // );
        // $mysqlRef->set($data);
        return NULL;
    }

    private function firebase_profile_picture($id) {
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceAccountKey.json');
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->withDatabaseUri('https://hackathon-9e577.firebaseio.com/')
        //     ->create();

        // $database = $firebase->getDatabase();
        // $mysqlRef = $database->getReference('mysql/' . $id);
        // $data = array(
        //     'function' => 'fetch_profile',
        //     'id' => $id
        // );
        // $mysqlRef->set($data);
        return NULL;  
    }

    public function setOvertime($id, $start_date, $end_date) {
        // Firebase
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceAccountKey.json');
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->withDatabaseUri('https://hackathon-9e577.firebaseio.com/')
        //     ->create();

        // $database = $firebase->getDatabase();
        // $mysqlRef = $database->getReference('mysql/' . $id);
        // $data = array(
        //     'function' => 'set_overtime',
        //     'start_date' => $start_date,
        //     'end_date' => $end_date
        // );
        // $mysqlRef->set($data);
        return NULL;
    }

    private function firebase_fetch_attachments($id) {
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceAccountKey.json');
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->withDatabaseUri('https://hackathon-9e577.firebaseio.com/')
        //     ->create();

        // $database = $firebase->getDatabase();
        // $mysqlRef = $database->getReference('mysql/' . $id);
        // $data = array(
        //     'function' => 'fetch_attachments',
        //     'id' => $id
        // );
        // $mysqlRef->set($data);
        return NULL;
    }

    public function profile_picture_form(Request $request){
        $image = $request->file('image_photo');
        $imageName = rand().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        
        $user_information = User_Table::find($request->input('id'));
        $user_information->image_photo = $imageName;
        $user_information->save();

        $this->firebase_profile_picture(Auth::user()->id);

        return response()->json([]);
    }

    public function change(request $request){
        $time1 = '07:'.sprintf("%02d",rand(31,59)).':00';
        $time2 = '12:'.sprintf("%02d",rand(1,30)).':00';
        $time3 = '12:'.sprintf("%02d",rand(31,59)).':00';
        $time4 = '17:'.sprintf("%02d",rand(1,30)).':00';

        $post = DB::table('users')->select('*')->where('id',$request->id)->get();

        DB::table('dtr')
        ->where('name',$post[0]->name)
        ->where('date',$request->date)
        ->update(
            [
                'time1' => $time1,
                'time2' => $time2,
                'time3' => $time3,
                'time4' => $time4,
                'accomplishment' => $request->accomplishment
            ]
        );
    }

    public function set_overtime(request $request){
        $post = User_Table::find($request->input('id'));
        $post->ot_start = $request->input('ot_start');
        $post->ot_end = $request->input('ot_end');
        $post->save();
        return back()->with('suc2','Successfully Set Overtime!');
    }

    public function holidays(request $request){
        $post = DB::table('holidays')->select('*')->orderby('holiday_date','desc')->paginate(10);
        return view('pages.holidays')->with('post',$post);
    }
    public function holidays_process(request $request){
        //return view('pages.holidays');
        $post_check = DB::table('holidays')->where('holiday_date',$request->input('holiday_date'))->count();
        if($post_check >= 1){
            return back()->with('suc','Holiday Already Exists!');
        }else{
            $post = new holidays;
            $post->holiday_date = $request->input('holiday_date');
            $post->holiday_event = $request->input('holiday_event');
            $post -> save();
            return back()->with('suc','Successfully Added Holiday!');
        }
    }
    public function holidays_delete(request $request){
        $post = DB::table('holidays')->where('id', $request->id)->delete();
        return back()->with('suc','Successfully Deleted!');
    }
    
    public function overtime_request(request $request){
        $post = DB::table('overtime_request')->select('*')->where('overtime_requestor',Auth::user()->id)->orderby('id','desc')->paginate(10);
        $post_all = DB::table('overtime_request as a')
        ->leftjoin('users as b','b.id','=','a.overtime_requestor')
        ->select('a.*','b.name')
        ->orderby('id','desc')->paginate(50);
        return view('pages.overtime_request')->with('post',$post)->with('post_all',$post_all);
    }
    public function overtime_request_process(request $request){
        //return view('pages.holidays');
        $post = new Overtime_Request;
        $post->overtime_requestor = Auth::user()->id;
        $post->overtime_start_date = $request->input('overtime_start_date');
        $post->overtime_end_date = $request->input('overtime_end_date');
        $post->overtime_purpose = $request->input('overtime_purpose');
        $post->overtime_status = 'Pending';
        $post->save();
        return back()->with('suc','Successfully Send Your Request!');
    }
    public function overtime_request_delete(request $request){
        $post = DB::table('overtime_request')->where('id', $request->id)->delete();
        return back()->with('suc','Successfully Cancelled!');
    }
    public function overtime_request_approve(request $request){
        $post = DB::table('overtime_request')->where('id', $request->id);
        $post->update(['overtime_status'=>'Approved']);
        $post2 = DB::table('users')->where('id', $request->id2)->update(['ot_start'=>$request->ot_start,'ot_end'=>$request->ot_end]);
        $this->setOvertime($request->id2, $request->ot_start, $request->ot_end);

        $overtime_request = $post->get()[0];
        $this->status_overtime($request->id, $overtime_request->overtime_requestor, $overtime_request->overtime_start_date, $overtime_request->overtime_end_date, $overtime_request->overtime_purpose, 'Approved');

        return back()->with('suc','Successfully Approved!');
    }
    public function overtime_request_decline(request $request){
        $post = DB::table('overtime_request')->where('id', $request->id);
        $post->update(['overtime_status'=>'Declined']);
        $overtime_request = $post->get()[0];
        $this->status_overtime($request->id, $overtime_request->overtime_requestor, $overtime_request->overtime_start_date, $overtime_request->overtime_end_date, $overtime_request->overtime_purpose, 'Declined');
        return back()->with('suc','Successfully Declined!');
    }
    public function overtime_request_pending(request $request){
        $post = DB::table('overtime_request')->where('id', $request->id);
        $post->update(['overtime_status'=>'Pending']);
        $post2 = DB::table('users')->where('id', $request->id2)->update(['ot_start'=>null,'ot_end'=>null]);
        $overtime_request = $post->get()[0];
        $this->status_overtime($request->id, $overtime_request->overtime_requestor, $overtime_request->overtime_start_date, $overtime_request->overtime_end_date, $overtime_request->overtime_purpose, 'Pending');
        return back()->with('suc','Successfully Back to Pending!');
    }

    public function status_overtime($id, $uid, $start, $end, $purpose, $status) {
        // Firebase
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceAccountKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://hackathon-9e577.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();
        $mysqlRef = $database->getReference('mysql/' . $id);
        $data = array(
            'function' => 'set_overtime_status',
            'uid' => $uid,
            'start_date' => $start,
            'end_date' => $end,
            'purpose' => $purpose,
            'status' => $status
        );
        $mysqlRef->set($data);
        return NULL;
    }

    public function change_mis(request $request){
        $post = DB::table('users')->select('*')->get();
        return view('pages.change_mis')->with('post',$post);
    }

    public function change_mis_password(request $request){
        if($request->input('mis_password') == 'petwussy'){
            return back()->with('granted','granted');
        }else{
            return back();
        }
    }

    public function change_mis_process(request $request){
        $post = DB::table('users')->select('*')->get();
        $post_ctr = DB::table('dtr')->select('*')->where('date',$request->input('date'))->where('name',$request->input('name'))->get();
        if($post_ctr->count() >= 1){
            $post_update = DB::table('dtr')
            ->where('date',$request->input('date'))
            ->where('name',$request->input('name'))
            ->update([
                'time1'=>$request->input('time1') ? $request->input('time1') : $post_ctr[0]->time1,
                'time2'=>$request->input('time2') ? $request->input('time2') : $post_ctr[0]->time2,
                'time3'=>$request->input('time3') ? $request->input('time3') : $post_ctr[0]->time3,
                'time4'=>$request->input('time4') ? $request->input('time4') : $post_ctr[0]->time4,
                'accomplishment'=>$request->input('accomplishment') ? $request->input('accomplishment') : $post_ctr[0]->accomplishment,
            ]);
            return back()->with('post',$post)->with('suc','Successfully Changed!');
        }else{
            $post_insert = new DTR;
            $post_insert->name = $request->input('name');
            $post_insert->date= $request->input('date');
            $post_insert->time1 = $request->input('time1') ? $request->input('time1') : null;
            $post_insert->time2 = $request->input('time2') ? $request->input('time2') : null;
            $post_insert->time3 = $request->input('time3') ? $request->input('time3') : null;
            $post_insert->time4 = $request->input('time4') ? $request->input('time4') : null;
            $post_insert->accomplishment = $request->input('accomplishment') ? $request->input('accomplishment') : null;
            // $post_insert->sync = 0;
            $post_insert->save();
            return back()->with('post',$post)->with('suc','Successfully Added!');
        }
    }
    public function datatable_sample(request $request){
        return view('pages.datatable_sample');
    }
}