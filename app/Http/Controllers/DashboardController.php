<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Produto;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {

        $usuarios = User::all()->count();

        // Gráfico 1 - usuários
        $usersData = DB::table('users')
            ->select(DB::raw('YEAR(created_at) as ano, count(*) as total'))
            ->groupBy('ano')
            ->orderBy('ano', 'asc')
            ->get();

        //Preparar array
         foreach($usersData as $user) {
            $ano[] = $user->ano;
            $total[] = $user->total;
        }

        //Formatar para chartjs
        $userLabel = "'Comparativo de cadastros de usuários'";
        $userAno = implode(',', $ano);
        $userTotal = implode(',', $total);

        //Gráfico 2 - categorias
        $catData = Categoria::with('produtos')->get();

        //Preparar array
        foreach($catData as $cat) {
            $catNome[] = "'" .$cat->nome."'";
            $catTotal[] = $cat->produtos->count();
        }

        //Formatar para chartjs
        $catLabel = implode(',', $catNome);
        $catTotal = implode(',', $catTotal);

        return view('admin.dashboard', compact('usuarios', 'userLabel', 'userAno', 'userTotal', 'catLabel', 'catTotal'));
    }
}
