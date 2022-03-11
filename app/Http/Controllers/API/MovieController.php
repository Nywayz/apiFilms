<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(3);

        return response()->json($movies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // La validation de données
            $this->validate($request, [
                'name' => 'required|max:128',
                'description' => 'required|max:2048',
                'note' => 'nullable|integer'
            ]);

            // On crée un nouveau film
            $movie = Movie::create([
                'name' => $request->name,
                'description' => $request->description,
                'note' => $request->note
            ]);

            // On retourne les informations du nouvel film en JSON
            return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
          // La validation de données
          $this->validate($request, [
            'name' => 'required|max:128',
            'description' => 'required|max:2048',
            'note' => 'nullable|integer'
        ]);

        // On modifie le film
        $movie->update([
            'name' => $request->name,
            'description' => $request->description,
            'note' => $request->note
        ]);

        // On retourne la réponse JSON
        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json();
    }
}
