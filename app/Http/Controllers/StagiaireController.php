<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\Groupe;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        $stagiaires=Stagiaire::all();
        return dd($stagiaires[0]);
        for ($i=0;$i<count($stagiaires);$i++){

            $stagiaires[$i]['groupeId'] = $stagiaires[$i]->Groupe->groupeId;
        }
        return $stagiaires;
    }

    public function show($id)
    {

        $stagiaire=Stagiaire::where('stagiaireId',$id)->first();

        if (!$stagiaire) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, stagiaire with id ' . $id . ' cannot be found.'
            ], 400);
        }

        return $stagiaire;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fullName' => 'required',
            'birthDate' => 'required',
            'groupeId' => 'required'
        ]);

        $stagiaire = new Stagiaire();
        $stagiaire->fullName = $request->fullName;
        $stagiaire->birthDate = $request->birthDate;

        $gpId=Groupe::where('groupeId', $request->groupeId)->select('id', 'groupeId')->first();
        $stagiaire->groupeId = $gpId->id;


        if ($stagiaire->save()){
            $stagiaire->groupeId=$gpId->groupeId;
            return response()->json([
                'success' => true,
                'stagiaire' => $stagiaire
            ]);
        }

        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, stagiaire could not be added.'
            ], 500);
        }

    }

    public function update(Request $request, $id)
    {
        $stagiaire=Stagiaire::where('stagiaireId',$id)->first();

        if (!$stagiaire) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, stagiaire with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $stagiaire->fullName=$request->name;
        $stagiaire->birthDate = $request->birthDate;
        $stagiaire->groupId = $request->groupId;
        $updated=$stagiaire->save();


        if ($updated) {
            return response()->json([
                'success' => true,
                'stagiaire'=> $stagiaire
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group could not be updated.'
            ], 500);
        }


    }
}
