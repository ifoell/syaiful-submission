<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Http\Requests\StoreEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     * Get All Employees
     */
    public function index()
    {
        try {
            $employees = Employees::all();
            Log::channel('custom')->info('Some user retrieve all Employees');
            return response()->json($employees, Response::HTTP_OK);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeesRequest $request)
    {
        try {
            $validator = $request->validated();

            Employees::create($request->all());
            $response = [
                'Success' => 'New Employee Inserted',
            ];
            Log::channel('custom')->info("Some user add" . PHP_EOL . json_encode($request->all(), JSON_PRETTY_PRINT) . PHP_EOL . json_encode($response, JSON_PRETTY_PRINT));
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            Log::channel('custom')->error("Error adding Employee because" . PHP_EOL . $e->getMessage());
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $employees = Employees::findOrFail($id);
            $response = [
                $employees
            ];
            Log::channel('custom')->info("Some user get" . PHP_EOL . json_encode($response, JSON_PRETTY_PRINT));
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::channel('custom')->error("Employee with id = " . $id . ": not found" . PHP_EOL . $e->getMessage());
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeesRequest $request, $id)
    {
        try {
            $employees = Employees::findOrFail($id);
            $validator = $request->validated();

            // Get existing data before the update
            $existingData = $employees->toArray();

            // Update the record
            $employees->update($request->all());

            $response = [
                'Success' => 'Employee Updated'
            ];

            // Log the existing and updated data
            Log::channel('custom')->info("Some user edit id = " . $id . PHP_EOL .
                "Existing Data:" . PHP_EOL . json_encode($existingData, JSON_PRETTY_PRINT) . PHP_EOL .
                "Updated Data:" . PHP_EOL . json_encode($request->all(), JSON_PRETTY_PRINT) . PHP_EOL .
                json_encode($response, JSON_PRETTY_PRINT));

            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::channel('custom')->error("Error updating employee with id = " . $id . ": " . $e->getMessage());
            return response()->json([
                'error' => 'no result',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $employees = Employees::findOrFail($id);
            $existingData = $employees->toArray();

            // Log the existing data
            Log::channel('custom')->info("Some user delete id = " . $id . PHP_EOL .
                "Existing Data:" . PHP_EOL . json_encode($existingData, JSON_PRETTY_PRINT));

            // Delete the record
            $employees->delete();

            // Respond with success message
            return response()->json(['success' => 'Employee deleted successfully.']);
        } catch (\Exception $e) {
            // Log the error
            Log::channel('custom')->error("Error deleting employee with id = " . $id . ": " . $e->getMessage());

            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

}
