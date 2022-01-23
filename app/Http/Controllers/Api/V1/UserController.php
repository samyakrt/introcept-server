<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterUserRequest;

class UserController extends Controller
{
    public $file_name;

    public function __construct()
    {
        $this->file_name = public_path('/csv/user.csv');
    }
    /**
     * store record into csv file
     * @param \App\Http\Requests\Api\V1\RegisterUserRequest $request
     * @return  Illuminate\Http\JsonResponse JsonResponse
     */
    public function registerUser(RegisterUserRequest $request) : JsonResponse
    {
        $input = $request->validated();
        $csv_values = array_values($input);
        $this->storeRecordIntoCsv($csv_values);
        return response()->json(['message' => 'Record Saved Successfully.']);
    }

    /**
     * @return  Illuminate\Http\JsonResponse JsonResponse
     */
    public function fetchRecords() {
        $file = @fopen($this->file_name, 'r');
        $records = [];
        return response()->json(compact('records'));
    }

    /**
     * @param array $record
     * @return void
     */
    private function storeRecordIntoCsv(array $record) : void
    {
        if (!file_exists($this->file_name)) {
            mkdir(public_path('/csv'));
        }
        $id = Str::uuid();
        $file = fopen($this->file_name, 'a+');
        
        fputcsv($file, [$id,...$record]);
        fclose($file);
        return;
    }
}
