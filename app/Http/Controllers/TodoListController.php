<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ToDo;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatorRules = [
            'name'=>'required|max:255',
            'description'=>'required',
            'due_date'=>'required|date|date_format:Y-m-d',
        ];
        $validator = Validator::make($request->all(), $validatorRules);
        if ($validator->fails()) { 
            dd($validator->errors());
        }
        else { 
            $Insert = ToDo::create([
                'name' => $request->name,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'is_complete' => $request->is_complete
            ]);
              if(isset($Insert->id)){
                  $message= "Inserted successfully";

              }
              else{
                  $message="Something went wrong";
              }

              return response()->json(["status_msg" => $message]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo_list = ToDo::find($id,['name', 'description','due_date','is_complete']);
        $todo_list = json_decode(json_encode($todo_list), True);
        return $todo_list;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatorRules = [
            'name'=>'required|max:255',
            'description'=>'required',
            'due_date'=>'required|date|date_format:Y-m-d',
        ];
        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }

        $update = ToDo::where("id", $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_complete' => $request->is_complete
        ]);

        if($update==1) $message ="Updated Successfully"; else $message = " Something went wrong";
        return response()->json(["status_msg" => $message]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=ToDo::where('id',$id)->delete();
        if($delete==1) $message ="Deleted Successfully"; else $message = " Something went wrong";
        return response()->json(["status_msg" => $message]);
        

    }
    
    public function list(){
        $list = ToDo::select('name','description','due_date','is_complete')->get();
        return response()->json($list);


    }
}
