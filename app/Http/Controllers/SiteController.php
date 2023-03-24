<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

use Illuminate\Support\Facades\Gate;

class SiteController extends Controller
{
    public function index()
    {
        //return "index";

        $produtos = Produto::paginate(3);
        $categorias = Categoria::all();
        return view('site.home', compact('produtos', 'categorias'));
       
    }

    public function details($slug) {

        $produto = Produto::where('slug',$slug)->first();
        $produtos = Produto::paginate(3);
        $categorias = Categoria::all();
        Gate::authorize('ver-produto', $produto);
        return view('site.details', compact('produto', 'produtos','categorias'));
    }

    public function categoria($id) {
        $categoria = Categoria::find($id);
        $produtos = Produto::where('id_categoria',$id)->paginate(3);
        return view('site.categoria', compact('produtos', 'categoria'));

    }
}
