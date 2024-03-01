<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\FACATEG;
use Illuminate\Http\Request;

class FA_CATEGController extends Controller
{


    /**
     * Retrieve all users
     * GET: /api/users
     * @return \Illuminate\Http\Response
     */
    public function index(){

        DB::select("exec sp_ref_facateg_upsert 'Load'");

        return response()->json([
            "ok" => true,
            "message" => "Data has been retrieved.",
            "data" => FACATEG::all()
        ]);
    }



    /**
     * Retrieve specific user using ID
     * GET: /api/users/{user}
     * GET: /api/users/1
     * @param User
     * @return \Illuminate\Http\Response
     */
    // public function show(FACATEG $user){
    //     return response()->json([
    //         "ok" => true,
    //         "message" => "Data has been retrieved.",
    //         "data" => $user
    //     ]);
    // }


    


    /**
     * Creates a user data from request
     * POST: /api/users
     * @param Request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request){
    //     $validator = validator($request->all(), [
    //         "FACATEG_CODE" => "required",
    //         "FACATEG_NAME" => "required",
    //         "ASSETACCT_CODE" => "required"  
    //     ]);

    //     if($validator->fails()){

    //         return response()->json([
    //             "ok" => false,
    //             "message" => "Request didn't pass the validation.",
    //             "errors" => $validator->errors()
    //         ], 400);
    //     }

    //       $facateg = DB::insert('insert into users (FACATEG_CODE, FACATEG_NAME, ASSETACCT_CODE) values (?, ?, ?)', ['FAC003', 'Sample', 'Sample']);
    
    //     return response()->json([
    //         'ok' => true,
    //         'message' => "User has been created!",
    //         'data' => $facateg
    //     ], 201);
    // }


    // public function store(Request $request)
    // {
    //     // Validate the input data
    //     $this->validate($request, [
    //         'FACATEG_CODE' => 'required', 
    //         'FACATEG_NAME' => 'required', 
    //         'ASSETACCT_CODE' => 'required'
    //     ]);

    //     // Create a new model instance
    //     $model = new FACATEG();

    //     // Assign the input data to the model attributes
    //     $model->FACATEG_CODE = $request->input('FACATEG_CODE');
    //     $model->FACATEG_NAME = $request->input('FACATEG_NAME');
    //     $model->ASSETACCT_CODE = $request->input('ASSETACCT_CODE');
    //     // Repeat for other fields

    //     // Save the model to the database
    //     $model->save();

    //     // Optional: Flash a success message or redirect to another page
    //     return $model;
    // }


    /**
     * Update a specified user using ID and Request
     * PATCH: /api/users/{user}
     * @param Request
     * @param User
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, FACATEG $user){
    //     $validator = validator($request->all(), [
    //         // "name" => "sometimes|min:4|string|unique:users,name,$user->id|max:16|alpha_dash",
    //         // "email" => "sometimes|email|max:64|unique:users,email,$user->id",
    //         // "password" => "sometimes|min:8|max:32|string|confirmed"

    //         "FACATEG_CODE" => "required",
    //         "FACATEG_NAME" => "required",
    //         "ASSETACCT_CODE" => "required"  
    //     ]);
        
    //     if($validator->fails()){
    //         return response()->json([
    //             "ok" => false,
    //             "message" => "Request didn't pass the validation.",
    //             "errors" => $validator->errors()
    //         ], 400);
    //     }

    //     $user->update($validator->validated());

    //     return response()->json([
    //         'ok' => true,
    //         'message' => "User has been updated!",
    //         'data' => $user
    //     ], 200);

    // }

    public function upsert(Request $request)
{

    // try {

    //     $value = $request->input();
    //     $params = json_encode($value);

    //     DB::insert('exec sp_ref_facateg_upsert ?', ['Upsert', $params]);

    //     return response()->json(['message' => 'Data upserted successfully'], 200);
    // } catch (\Exception $e) {
    //     return response()->json(['error' => $e->getMessage()], 500);
    // }

    DB::beginTransaction();
    try {

        $value = $request->input();
        $params = json_encode($value);



        DB::insert('exec sp_ref_facateg_upsert ?,?', ['Upsert', $params]);
        DB::commit();
        return response()->json(['message' => 'Data upserted successfully'], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    /**
     * Delete specific user using ID
     * DELETE: /api/users/{user}
     * DELETE: /api/users/1
     * @param User
     * @return \Illuminate\Http\Response
     */
    // public function delete($paramsId, $id){

    //     $paramsId = FACATEG::find($id);

    //     DB::delete('exec sp_ref_facateg_upsert ?,?,?' ,[null , null, null, $paramsId]);

    //     return response()->json([
    //               "ok" => true,
    //               "message" => "Data has been deleted."
    //           ]);

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $stmt = DB::connection('sqlsrv')->getPdo()->prepare("exec sp_ref_facateg_upsert ?,?,?");
                $stmt->execute(['Delete', null, $id]);
    
                if ($stmt->rowCount() > 0) {
                    return response()->json([
                        "ok" => true,
                        "message" => "Data has been deleted."
                    ]);
                } else {
                    throw new Exception('Failed to delete data');
                }
            });
        } catch (\Exception $e) {
            return response()->json([
                "ok" => false,
                "message" => "Error: " . $e->getMessage()
            ], 500);
        }
    }


        // $paramsId = FACATEG::find($id);

        // $paramsId -> delete($id);


         

        //  return response()->json([
        //      "ok" => true,
        //      "message" => "Data has been deleted."
        //  ]);
    }


