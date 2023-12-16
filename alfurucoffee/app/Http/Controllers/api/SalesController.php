<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\Employees;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Http\Resources\EmployeesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sales = Sales::with("employee")->get();
            Log::channel('custom')->info('Some user retrieve all Sales data');
            return response()->json($sales, Response::HTTP_OK);

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
    public function store(StoreSalesRequest $request)
    {
        try {
            $validator = $request->validated();

            Sales::create($request->all());
            $response = [
                'Success' => 'New Sales Inserted',
            ];
            Log::channel('custom')->info("Some user add" . PHP_EOL . json_encode($request->all(), JSON_PRETTY_PRINT) . PHP_EOL . json_encode($response, JSON_PRETTY_PRINT));
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            Log::channel('custom')->error("Error adding sales data because" . PHP_EOL . $e->getMessage());
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $sales = Sales::with("employee")->findOrFail($id);
            $response = [
                $sales
            ];
            Log::channel('custom')->info("Some user get" . PHP_EOL . json_encode($response, JSON_PRETTY_PRINT));
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesRequest $request, $id)
    {
        try {
            $sales = Sales::findOrFail($id);
            $validator = $request->validated();

            $sales->update($request->all());
            $response = [
                'Success' => 'Sales Data Updated'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
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
            Sales::findOrFail($id)->delete();
            return response()->json(['success' => 'Sales Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
