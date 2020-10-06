<?php

namespace App\Http\Controllers;

use App\AuditTrail;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create(Request $request)
    {
       $data = $request->validate(
            [
                'username' => 'required|unique:user_infos,username',
                'f_name' => 'required',
                'l_name' => 'required',
                'email_address' => 'required',
                'mobile_number' => 'required',
            ]
        );


        DB::beginTransaction();
         $save =   UserInfo::query()->create($data);
        DB::commit();


        return redirect()->back()->with('success',"User {$data['username']} successfully created !!!");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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


    public function edit($id)
    {
        return  view('edit',['userinfo'=>UserInfo::query()->find($id)]);
    }


    public function update(Request $request, $id)
    {
        $info = UserInfo::query()->find($id);

        $data = $request->validate(
            [
                'username' => 'required|unique:user_infos,username,'.$id,
                'f_name' => 'required',
                'l_name' => 'required',
                'email_address' => 'required',
                'mobile_number' => 'required',
            ]
        );


        DB::beginTransaction();
          $info->update($data);
        DB::commit();


        return redirect()->route('home.index')->with('success',"User {$info->username} successfully updated !!!");
    }

    public function destroy($id)
    {
        try {
            UserInfo::query()->find($id)->delete();
        } catch (\Exception $e) {
            return  redirect()->back()->withErrors('Deletion failed');
        }

        return redirect()->route('home.index')->with('success',"User info successfully deleted !!!");

    }





    public  function ajax_create(Request $request)
    {

        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'f_name'=> 'required',
            'l_name'=> 'required',
            'email_address'=> 'required',
            'mobile_number'=> 'required',
        ]);

        $form_params  = $request->all();
        $user->log("SUBMITTED THE FOLLOWING DATA:" .json_encode($form_params));

        if($validator->fails())
            return  response()->json(['code'=>401,'msg'=> $validator->errors()->all()]);



        return response()->json(['code'=>200,'msg'=>$request->all()]);
    }




}
