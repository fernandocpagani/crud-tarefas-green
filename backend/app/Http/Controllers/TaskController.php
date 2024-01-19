<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Task;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Routing\Controller as BaseController;

class TaskController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function showAllTask(){
        return response()->json(Task::with('user')->orderBy("id", "desc")->get());
    }

    public function registerTask(Request $request){

        $this->validate($request, [
            'title' =>'required|max:30',            
            'description' =>'required|max:50',           
            'finishdate' =>'required', 
        ]);

        $task = new Task;
        $task->title = $request->title;      
        $task->description = $request->description;        
        $task->finishdate = $request->finishdate;        
        $task->users_id = $request->users_id;    
               
        $task->save();
        return response()->json($task);
    }

    public function showTask($id){
        return response()->json(Task::find($id));
    }

    public function updateTask($id, Request $request){
        $task = Task::find($id);
        $task->title = $request->title;        
        $task->description = $request->description;        
                                  
        $task->save();

        return response()->json($task);
    }

    public function updateTaskStatus($id, Request $request){
        $task = Task::find($id);             
        $task->status = $request->status;  
                            
        $task->save();

        return response()->json($task);
    }

    public function updateDate($id, Request $request){
        $task = Task::find($id);
        $task->finishdate = $request->finishdate;          
                              
        $task->save();

        return response()->json($task);
    }

    public function deleteTask($id){
        $user = Task::find($id);
        $user->delete();
        return response()->json("deletado com sucesso", 200);
    }
    
}
