<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
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
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('totalPerPage', 6),
            filter: $request->filter
        );
        /**
         ** Após declarar o método getAll() (retornando os registros do banco de dados) na variável $supports nós devemos
         ** chamar essa mesma variável e passar como parâmetro o model Support com o método paginate() para que
         ** os registros sejam limitados por página, afim de não sobrecarregar a aplicação.
         */

         $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
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
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()
                ->route('supports.index')
                ->with('message', 'Tópico cadastrado com sucesso!');
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

    public function update(
        StoreUpdateSupportRequest $request, Support $support, string|int $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );
        if(!$support) {
            return back();
        }

        return redirect()
                ->route('supports.index')
                ->with('message', 'Tópico atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()
                ->route('supports.index')
                ->with('feedback', 'Tópico excluído com sucesso!');
    }
}
