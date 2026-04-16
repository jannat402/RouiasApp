<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{

    public function index() { 
		$arrayPeliculas = Movie::all();
        // Pasamos TODO el array a la vista 
        return view('catalog.index', [ 
            'arrayPeliculas' => $arrayPeliculas 
            ]); 
    }

    public function show($id) {
		$pelicula = Movie::findOrFail($id); 
        // Obtenemos la película concreta por su posición en el array 
        return view('catalog.show', [ 
           'pelicula' => $pelicula 
            ]); 
    }

    public function create() { 
        return view('catalog.create'); 
    } 
    
    public function edit($id) { 
		$pelicula = Movie::findOrFail($id); 
        return view('catalog.edit', [ 
            'pelicula' => $pelicula 
            ]); 
    }

	public function postCreate(Request $request){
		$movie = new Movie();
		$movie->title = $request->input('title');
		$movie->year = $request->input('year');
		$movie->director = $request->input('director');
		$movie->poster = $request->input('poster');
		$movie->synopsis = $request->input('synopsis');
		$movie->rented = false;
		$movie->save();

		Session::flash('mensaje', 'La pel·lícula s\'ha creat correctament');

		return redirect('catalog/table');
	}


	public function putEdit(Request $request, $id){
		$movie = Movie::findOrFail($id);
		$movie->title = $request->input('title');
		$movie->year = $request->input('year');
		$movie->director = $request->input('director');
		$movie->poster = $request->input('poster');
		$movie->synopsis = $request->input('synopsis');
		$movie->save();

		Session::flash('mensaje', 'La pel·lícula s\'ha modificat correctament');

		return redirect('catalog/show/'.$id);
	}

	public function putRent($id)
	{
		$pelicula = Movie::findOrFail($id);
		$pelicula->rented = true;
		$pelicula->save();

		Session::flash('mensaje', 'La pel·lícula s\'ha llogat correctament');

		return redirect('/catalog/show/'.$id);
	}
	public function putReturn($id){
		$pelicula = Movie::findOrFail($id);
		$pelicula->rented = false;
		$pelicula->save();

		Session::flash('mensaje', 'La pel·lícula s\'ha retornat correctament');
		return redirect('/catalog/show/'.$id);
	}

	public function deleteMovie($id){
		$pelicula = Movie::findOrFail($id);
		$pelicula->delete();

		Session::flash('mensaje', 'La pel·lícula s\'ha eliminat correctament');
		return redirect('/catalog');
	}


	public function table()
	{
		$pelicules = Movie::simplePaginate(10);
		return view('catalog.table', ['peliculas' => $pelicules]);
	}


}
