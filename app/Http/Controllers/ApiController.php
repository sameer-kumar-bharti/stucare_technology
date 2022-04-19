<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Company;
use DB;
class ApiController extends Controller
{

    //#################  add company ##################
    public function add_new_company(Request $request)
    {
       $company = new Company;
       $validator= Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'website' => 'required',
            'contact' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>false,
                'msg'=>$validator->messages(),
            ]);
        }
        else
        {
            $file = $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('upload',$filename);
            //dd($extention);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $company->logo = $filename;
            $company->contact = $request->contact;
            $company->address = $request->address;
            $company->save();
            if($company->save())
            {
                return response()->json([
                    'status'=>true,
                    'msg'=>'record successfully added',
                ]);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'msg'=>'something wrong',
                ]);
            }
        }
    }


    ######################### update company ##########################
    public function update_company(Request $request)
    {
        $id = $request->id;
        $file = $request->file('logo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('upload',$filename);
        $update = Company::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $filename,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);
        if($update)
        {
            return response()->json([
                'status'=>true,
                'msg'=>'record updated successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'msg'=>'something wrong',
            ]);
        }
    }

###################   dlete company   #################
    public function delete_company($id)
    {
        $delete = Company::where('id',$id)->delete();
        if($delete)
        {
            return response()->json([
                'status'=>true,
                'msg'=>'record deleted successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'msg'=>'something wrong',
            ]);
        }
    }


    public function getdata()
    {
        $data = DB::tabel('users')->get();
        return json_encode($data);
    }
}
