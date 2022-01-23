<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterUserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public $file_name;

    public function __construct()
    {
        $this->file_name = public_path('/csv/user.csv');
    }
    /**
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
     * @param array $record
     * @return void
     */
    public function storeRecordIntoCsv(array $record) : void
    {
        if (!file_exists($this->file_name)) {
            mkdir(public_path('/csv'));
        }
        $file = fopen($this->file_name, 'a+');
        fputcsv($file, $record);
        fclose($file);
        return;
    }
}