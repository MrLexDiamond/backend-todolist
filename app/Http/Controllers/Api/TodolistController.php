<?php

namespace App\Http\Controllers\Api;

use App\Models\Todolist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TodolistController extends Controller
{
    //Get method
    public function index()
    {
        //to get all table attributes
        $todolist = Todolist::all();
        if($todolist->count() > 0){
            return response()->json([
                'status' => 200,
                'todolist' => $todolist
            ], 200);
        }else{
            //messages if no available records in Database Table
            return response()->json([
                'status' => 404,
                'todolist' => 'No Records Found'
            ], 404);
        }
    }
    
    //Post method
    public function store(Request $request)
    {
        //To request all data in database
        $validator = Validator::make($request->all(), [
            'tasks' => 'required|string|max:191',
            'status' => 'required|boolean',
        ]);

        // messages if fails to request
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            //create the attributes
            $todolist = Todolist::create([
                'tasks' => $request->tasks,
                'status' => $request->status,
            ]);

            if($todolist){
                //messages if successfully created the attributes
                return response()->json([
                    'status' => 200,
                    'message' => "To do list Created Successfully"
                ],200);
            }else{
                //messages if Something wrong to created the attributes
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!!!"
                ],500);
            }
        }
    }

    //Get By ID method
    public function show($id)
    {
        //to find id
        $todolist = Todolist::find($id);
        if($todolist){
            //messages if finds id
            return response()->json([
                'status' => 200,
                'todolist' => $todolist
            ],200);
        }else{
            //messages if theres no id you enter
            return response()->json([
                'status' => 404,
                'message' => "No Such ToDo list Found!!!"
            ],404);
        }
    }

    //Get By ID method for Update Todolist
    public function edit($id)
    {
        //To get the id in database
        $todolist = Todolist::find($id);
        if($todolist){
            //messages if finds id
            return response()->json([
                'status' => 200,
                'todolist' => $todolist
            ],200);
        }else{
            //messages if theres no id you enter
            return response()->json([
                'status' => 404,
                'message' => "No Such ToDo list Found!!!"
            ],404);
        }
    }

    //Put method, Update by id
    public function update(Request $request, int $id)
    {
        //To request all data in database
        $validator = Validator::make($request->all(), [
            'tasks' => 'required|string|max:191',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()){
            // messages if fails to request
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            //to find id you want to update
            $todolist = Todolist::find($id);
            if($todolist){
                $todolist->update([
                    'tasks' => $request->tasks,
                    'status' => $request->status,
                ]);
                //message if you successfully updated the table by id you want
                return response()->json([
                    'status' => 200,
                    'message' => "To do list Updateted Successfully"
                ],200);
            }else{
                //message if you faild to updated the table by id you want
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Todo list Found!!!"
                ],404);
            }
        }
    }

    //Deleter method, Update by id
    public function destroy($id)
    {
        //to find table by id
        $todolist = Todolist::find($id);
        if($todolist){
            //delete the table id
            $todolist->delete();
            //Messegas if are delete the table id
            return response()->json([
                'status' => 200,
                'message' => "Todo List Deleted Successfully!!!"
            ],200);
        }else{
            //Messegas if no id available found
            return response()->json([
                'status' => 404,
                'message' => "No Such Todo list Found!!!"
            ],404);
        }
    }
}
