<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service
    )
    {}

    public function index(Request $request)
    {
        $supports = $this->service->getAll($request->filter);
        return view('admin/supports/index', compact('supports'));
    }

    public function show(string $id)
    {
        /**
         ** Support:find($id) busca pela primary key, nesse caso o ID
         ** Support:where('id', $id) busca pelo campo especificado, nesse caso o ID
         ** Support:where('id', $id)->first() busca pelo campo especificado, nesse caso o ID, e retorna apenas o primeiro registro
         ** Support:where('id', $id)->get() busca pelo campo especificado, nesse caso o ID, e retorna todos os registros
         ** Support:where('id', $id)->paginate(10) busca pelo campo especificado, nesse caso o ID, e retorna todos os registros com paginação
         ** Support:where('id', '=', $id) busca pelo campo especificado, nesse caso o ID, e retorna os registros utilizando o operador de comparação
         */

        if(!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    //O Request é uma classe que contém os dados da requisição HTTP, como os dados do formulário, por exemplo.
    public function store(StoreUpdateSupportRequest $request, Support $support)
    {
        $data = $request->validated(); // pega apenas os dados validados
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }

    public function edit(string $id)
    {
        // if(!$support = $support->where('id', $id)->first()) {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

/**
 * Sempre ao criar ou editar um dado no banco de dados, é necessário utilizar a classe Request para validar os dados.
 * do contrário irá ocorrer um erro de MassAssignmentException.
 */

    public function update(StoreUpdateSupportRequest $request, Support $support, string|int $id)
    {
        if(!$support = $support->where('id', $id)->first()) {
            return back();
        }

        // $support->update($request->only([  // Outro metodo de buscar e atualizar os dados corretos do formulário e usando o validated
        //     'subject',
        //     'body',
        // ]));

        $support->update($request->validated());

        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
