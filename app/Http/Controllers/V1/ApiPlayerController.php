<?php

namespace App\Http\Controllers\V1;

// Dependencies
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerValidationRequest;
use Illuminate\Http\Request;

// Models
use App\Player;

class ApiPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $players = Player::all();
            return response()->json($players, 200);
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
    public function store(PlayerValidationRequest $request)
    {
        try{
            $fields = $request->all();
            $players = Player::create($fields);

            return response()->json(['data' => $players], 201);
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
        $players = Player::findOrFail($id);
        return response()->json(['data' => $players ], 200);
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
        try{

            $players = Player::findOrFail($id);
            $rules = [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'team_id' => 'required|integer',
            ];
            $this->validate($request, $rules);

            if($request->has('first_name') || $request->has('last_name') | $request->has('team_id'))
            {
                $players->first_name = $request->first_name;
                $players->last_name = $request->last_name;
                $players->team_id = $request->team_id;
            }

            if(!$players->isDirty()) {
                return response()->json(['error' => 'You Need to Assign different value before update', 'code' => 422 ], 422);
            }

            $players->save();

            return response()->json(['data' => $players], 200);
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
        $players = Player::findOrFail($id);
        $players->delete();

        return response()->json(['data' => 200]);
    }
}
