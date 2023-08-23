<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replyService,
    ) {
    }

    public function index(string $id)
    {
        /**
         ** Support:find($id) busca pela primary key, nesse caso o ID
         ** Support:where('id', $id) busca pelo campo especificado, nesse caso o ID
         ** Support:where('id', $id)->first() busca pelo campo especificado, nesse caso o ID, e retorna apenas o primeiro registro
         ** Support:where('id', $id)->get() busca pelo campo especificado, nesse caso o ID, e retorna todos os registros
         ** Support:where('id', $id)->paginate(10) busca pelo campo especificado, nesse caso o ID, e retorna todos os registros com paginação
         ** Support:where('id', '=', $id) busca pelo campo especificado, nesse caso o ID, e retorna os registros utilizando o operador de comparação
         */
dd($id);
        if (!$support = $this->supportService->findOne($id)) {
            return back();
        }

        $replies = $this->replyService->getAllBySupportId($id);

        return view('admin.supports.replies.replies', compact('support'));
    }
}
