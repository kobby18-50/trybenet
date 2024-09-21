<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function view (){
        try {
        $employees = Employee::paginate(10);
        return response()->json([
            'status' => 200,
            'message' => "Employees fetched successfully",
            'data' => $employees,
        ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => '500',
                'message' => "An error occured during fetching employees",
                'error' => $e->getMessage(),
            ]);
            }
    }


    public function create (CreateEmployeeRequest $request){
        
        try {

            $validatedData = $request->validated();

            if($request->hasFile('photo')){
                $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;

            }

            if (isset($validatedData['social_media_accounts'])) {
                $validatedData['social_media_accounts'] = json_encode($validatedData['social_media_accounts']);
            }

            $employee = Employee::create($validatedData);
            
            return response()->json([
                'status' => 200,
                'message' => "Employee created successfully",
                'data' => $employee,
            ]);
            } catch (\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => "An error occured during creating employee",
                    'error' => $e->getMessage(),
                ]);
            }
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {

        try {
            $employee = Employee::where('id', $id)->firstOrFail();

        $validatedData = $request->validated();

        // Handle logo upload
        if ($request->hasFile('photo')) {
            // Delete the old logo if it exists
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }

            // Store the new logo
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        } else {
            // Keep the old logo if no new logo is uploaded
            unset($validatedData['photo']);
        }

        // Convert social_links to JSON format
        if (isset($validatedData['social_media_accounts'])) {
            $validatedData['social_media_accounts'] = json_encode($validatedData['social_media_accounts']);
        }

        // Update the company
        $employee->update($validatedData);


        return response()->json([
            'status' => 200,
            'message' => "Employee updated successfully",
            'data' => $employee,
        ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "An error occured during updating employee",
                'error' => $e->getMessage(),
            ]);
        }
    }


    public function destroy($id){
        try{
            $employee = Employee::where('id', $id)->firstOrFail();

            if($employee->photo){
                Storage::disk('public')->delete($employee->photo);
            }

            $employee->delete();
            return response()->json([
                'status' => 200,
                'message' => "Employee deleted successfully",
                'data' => null,
            ]);


        }catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => "An error occured during deleting employee",
                'error' => $e->getMessage(),
            ]);

        }
    }

}


