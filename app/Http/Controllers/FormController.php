<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\AuditTrail;
use App\DataTables\AuditTrailDataTable;
use App\FormData;
use App\SocialAuth;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{


    public function index()
    {

        $twitter  = SocialAuth::query()->first();
        return view('index',compact('twitter'));
    }



    public function audit_table(AuditTrailDataTable $audit,Request $request)
    {

        return $request->isMethod('post') ? $this->create($request) : $audit->render('home');
    }


    public function create($request)
    {

        $user  = Auth::user();
        $data = $request->validate(
            [
                'username' =>'required',
                'f_name' =>'required',
                'l_name' =>'required',
            ]
        );

        DB::beginTransaction();
             $form_data = FormData::query()->create($data);
             $user->log("INSERTED DATA {$form_data->username}");
        DB::commit();

        return  redirect()->back()->with('success',"{$form_data->username}  successfully created");
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit(Request $request,AuditTrail $auditTrail)
    {
         $user =  Auth::user();
        if($request->isMethod('post'))
        {
           $data = $request->except('_token');
           $data['date'] = Carbon::parse($data['date']);


           DB::beginTransaction();

                  $user->log("Modified Audit with ID $auditTrail->id");
                  $auditTrail->update($data);

           DB::commit();

           return  redirect()->route('home.index')->with('success','Audit Succesfully Updaed');
        }

        return view('edit',['log'=>$auditTrail]);
    }


    public function schedular_output(Request $request)
    {
          Artisan::call('info:log');
          $log_output = Artisan::output();
          return view('output',['log_output'=>$log_output]);
    }


    public function default(Request $request)
    {
        return view( 'default');
    }



    public function tenant(Request $request)
    {
        return  view('tenant');
    }

    public function tenant_create(Request $request)
    {
        return $request->isMethod('post') ? $this->create_tenant($request) : view('tenant_create');
    }

    public function create_tenant($request)
    {

    }
}
