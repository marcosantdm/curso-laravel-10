<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{

    public function __construct(
        protected SupportRepositoryInterface $repository,
    ) {}
    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);

    /**
     * A função flash() é comumente usada para exibir mensagens de sucesso,
     * erro ou outras mensagens breves para o usuário após uma ação ou redirecionamento.
     *
     * Quando você usa session()->flash('success', ...), o Laravel armazenará temporariamente a mensagem 'success'
     * na sessão até a próxima solicitação. Isso permite que você redirecione para outra página (por exemplo,
     * a página de listagem de suportes) e exiba a mensagem de sucesso lá. Geralmente,
     * você fará isso usando a diretiva Blade @if(session('success')) na view
     */

        session()->flash('success', "Suporte de id: $id excluído com sucesso!");
    }
}
