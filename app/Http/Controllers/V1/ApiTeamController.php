<?php

namespace App\Http\Controllers\V1;
//Dependencies

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamValidationRequets;

// Models
use App\Team;
class ApiTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $teams = Team::all();
            return response()->json($teams,200);
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamValidationRequets $request)
    {
        try{
            $fields = $request->all();
            $teams = Team::create($fields);

            return response()->json($teams, 201);
        }catch(\Exception $e){
            return response()->json($e, 403);
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
        $teams = Team::findOrFail($id);
        return response()->json($teams, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamValidationRequets $request, $id)
    {
        try{

            $teams = Team::findOrFail($id);
            $rules = [
                'name' => 'required'
            ];
            $this->validate($request, $rules);

            if($request->has('name'))
            {
                $teams->name = $request->name;
            }

            if(!$teams->isDirty()) {
                return response()->json(['error' => 'You Need to Assign different value before update', 'code' => 422 ], 422);
            }

            $teams->save();

            return response()->json($teams, 200);
        }catch(\Exception $e){
            return response()->json($e, 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teams = Team::findOrFail($id);
        $teams->delete();

        return response()->json(['data' => 200]);
    }
}
