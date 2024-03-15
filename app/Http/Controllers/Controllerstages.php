<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Controllerstages extends Controller
{
    // .....................show stage...............
    public function stages()  {

         $stages = Stages::orderBy('id','desc')->paginate(5);
         return view('stages',["stages"=>$stages]);
    }

    // ............................addstages...................add

        public function addstages(Request $request)  {
            
            $request->validate(
               [
                'stage' =>'required|unique:stages'
                ]
                ,[
                    'stage.required'=>'پێویستە خانەکە پڕبکەیتەوە ',
                    'stage.unique'=>'نابێت  داتای دوبارە هەبێت'
                ]
            );
            
          Stages::create([
               'stage' => $request->stage,
                 ]);
            return response()->json(["status"=>"success"]);
            
        }



        // .......................................update..........

    public function updatestage(Request $request) {
    $request->validate(
        [
            'up_stage' => 'required|unique:stages,stage,' . $request->up_id,
        ],
        [
            'up_stage.required' => ' پێویستە خانەکە پڕبکەیتەوە ',
            'up_stage.unique' =>'نابێت  داتای دوبارە هەبێت',
        
        ]
    );

    Stages::where('id', $request->up_id)->update([
        'stage' => $request->up_stage,
    ]);

    return response()->json(
        ["status" => "success"]
    );
}
// ......................delete................................
 

    public function deletestage(Request $request) {
    Stages::where('id', $request->stage_id)->delete();
    return response()->json(["status" => "success"]);
}

   // ..................pagination............

   public function pagination(Request $request)
{
   $stages = Stages::orderBy('id', 'desc')->paginate(5);
        return view('pagination_stage', ["stages" => $stages])->render();
 
}


// ..................search..............

public function searchstages(Request $request)  {
    
    $stages=Stages::where('stage','like','%'. $request->search_stages .'%')->paginate(5);
    if ($stages->count() >= 1) {
      return view('pagination_stage', ["stages" => $stages])->render();
    } else {
           return response()->json(
            ["status" => "not have any data"]
                );
    }
    
}



}
