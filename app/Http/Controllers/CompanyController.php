<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    

    public function view (){
        try {
        $companies = Company::paginate(10);
        return response()->json([
            'status' => 200,
            'message' => "Company fetched successfully",
            'data' => $companies,
        ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => '500',
                'message' => "An error occured during fetching companies",
                'error' => $e->getMessage(),
            ]);
            }
    }


    public function create (CreateCompanyRequest $request){
        
        try {

            $validatedData = $request->validated();

            $company = Company::create([
                'name' => $validatedData['name'],
                 'website' => $validatedData['website'],
                 'email' => $validatedData['email']
        
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => "Company created successfully",
                'data' => $company,
            ]);
            } catch (\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => "An error occured during creating company",
                    'error' => $e->getMessage(),
                ]);
            }
    }


    public function update (UpdateCompanyRequest $request, $id){
        
        try {
            $company = Company::where('id', $id)->firstOrFail();

            $validatedData = $request->validated();

            $company->name = $validatedData['name'];
            $company->website = $validatedData['website'];
            $company->email = $validatedData['email'];

            $company->save();
            
            return response()->json([
                'status' => 200,
                'message' => "Company updated successfully",
                'data' => $company,
            ]);
            } catch (\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => "An error occured during updating company",
                    'error' => $e->getMessage(),
                ]);
            }
    }
    public function destroy ($id){
        
        try {
            $company = Company::findOrfail($id);
            $company->delete();
            return response()->json([
                'status' => 200,
                'message' => "Company deleted successfully",
                'data' => null,
            ]);
            } catch (\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => "An error occured during deleting company",
                    'error' => $e->getMessage(),
                ]);
            }
    }
    
}
