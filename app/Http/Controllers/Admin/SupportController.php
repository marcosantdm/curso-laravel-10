<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();
        return view('admin/supports/index', compact('supports'));
    }

    public function show(string|int $id)
    {
        /**
         ** Support:find($id) busca pela primary key, nesse caso o ID
         ** Support:where('id', $id) busca pelo campo especificado, nesse caso o ID
         ** Support:where('id', $id)->first() busca pelo campo especificado, nesse caso o ID, e retorna apenas o primeiro registro
         ** Support:where('id', $id)->get() busca pelo campo especificado, nesse caso o ID, e retorna todos os registros
         ** Support:where('id', $id)->paginate(10) busca pelo campo especificado, nesse caso o ID, e retorna todos os registros com paginação
         ** Support:where('id', '=', $id) busca pelo campo especificado, nesse caso o ID, e retorna os registros utilizando o operador de comparação
         */

        if(!$support = Support::find($id)) {
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    //O Request é uma classe que contém os dados da requisição HTTP, como os dados do formulário, por exemplo.
    public function store(Request $request, Support $support)
    {
        $data = $request->all();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }
}
