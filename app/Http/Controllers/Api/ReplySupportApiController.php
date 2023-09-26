<?php

namespace App\Http\Controllers\Api;

use App\DTO\Supports\Replies\CreateReplyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplySupportApiController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replyService,
    ) {
    }

    public function getRepliesFromSupport(string $supportId)
    {
        /**
         ** Support:find($supportId) busca pela primary key, nesse caso o ID
         ** Support:where('id', $supportId) busca pelo campo especificado, nesse caso o ID
         ** Support:where('id', $supportId)->first() busca pelo campo especificado, nesse caso o ID, e retorna apenas o primeiro registro
         ** Support:where('id', $supportId)->get() busca pelo campo especificado, nesse caso o ID, e retorna todos os registros
         ** Support:where('id', $supportId)->paginate(10) busca pelo campo especificado, nesse caso o ID, e retorna todos os registros com paginação
         ** Support:where('id', '=', $supportId) busca pelo campo especificado, nesse caso o ID, e retorna os registros utilizando o operador de comparação
         */

        if (!$this->supportService->findOne($supportId)) {
            return response()->json([
                'message' => 'Não encontrado',
            ], Response::HTTP_NOT_FOUND);
        }

        $replies = $this->replyService->getAllBySupportId($supportId);

        return ReplySupportResource::collection($replies);
    }

    public function createNewReply(StoreReplySupportRequest $request)
    {
        $reply = $this->replyService->createNew(
            CreateReplyDTO::makeFromRequest($request)
        );

        return (new ReplySupportResource($reply))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
    }

}
