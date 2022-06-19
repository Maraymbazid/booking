<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Compnay\UpdateCompany;
class CompanyController extends Controller
{
  public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->save();
        return response()->json(['msg' => 'تم حفظ الداتا بنجاح '], 200);
    }
    public function index()
    {
        $companies=Company::paginate(8);
        return view('admin.company.index',compact('companies'));
    }
    public function delete(Request $request)
    {
        $company=Company::find($request->id);
        if($company)
        {
            $company->cars()->delete();
            $company->taxis()->delete();
            $company->delete();
            return response()->json
            ([
                'msg'  => 'تم حذف الداتا بنجاح ',
                'id'=>$request->id,
            ],200);
        }
       else
        {
            return response()->json
            ([
                //'status' => false,
                 'msg'  => ' تعذر الحذف هناك خطأ ما ',
            ],500);
        }
    }
    public function edit($id)
    {
        try
        {
            $company = Company::find($id);  // search in given table id only
        if (!$company)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $company = Company::select()->find($id);
           return view('admin.company.edit', compact('company'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }
    }
    public function update(UpdateCompany $request)
    {
        $company = Company::find($request ->id);
        if (!$company)
            return response()->json([
                'status' => false,
                'msg' =>'this element does not exist',
            ]);
            $company->update(
            [
                'name' => $request->name,
            ]
        );
        return response()->json([
            'status' => true,
            'msg' =>'تم تعديل بنجاح'
        ]);
    }
}
