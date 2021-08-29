<?php

namespace App\Http\Controllers;
use App\Http\Resources\Note as ResourcesNote;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Note::create($request->all())){
            return response()->json([
                'success' => 'Note créée avec succès'
            ],200
            );
        }
        else
        {
            return response()->json([
                'error' => 'Erreur lors de la création de la note'
                ] ,500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return new ResourcesNote($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        if($note->update($request->all())){
            return response()->json([
                'success' => 'Note modifiée avec succès'
            ],200
            );
        }
        else
        {
            return response()->json([
                'error' => 'Erreur lors de la modification de la note'
                ] ,500
            );
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {

        if($note->delete()){
            return response()->json([
                'success' => 'Note supprimée avec succès'
            ],200
            );
        }
        else
        {
            return response()->json([
                'error' => 'Erreur lors de la suppression de la note'
                ] ,500
            );
        }
    }
       /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $data = $_GET['title'];
        if($notes = Note::where('title', 'like', "%{$data}%")->get()){
            return response()->json([
                'data' => $notes
            ],200
        ); 
        }
        else{
            return response()->json([
                'error' => 'Erreur lors de la recherche'
            ],500
        ); 
        }
}
}