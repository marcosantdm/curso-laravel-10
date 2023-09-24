<?php

namespace App\Repositories;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatus;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{

    public function __construct(
        protected Support $model,
    ) {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        /**
         ** Ao utilizar o WHERE, é necessário utilizar o GET para retornar os dados,
         ** caso não use o WHERE, pode utilizar o ALL
         */
        $result =  $this->model
            ->with(['replies' => function ($query) {
                $query->limit(4);
                $query->latest();
            }])
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    /**
                     * O SQL ABAIXO É EQUIVALENTE A:
                     * SELECT * FROM supports WHERE subject = $filter OR body LIKE %$filter%
                     */
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            /**
             * O método paginate funciona da seguinte forma:
             * paginate(número de registros por página, ["colunas que serão retornadas,
             * podendo utilizar * para retornar todas"], nome do parâmetro, página atual)
             */
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        /**
         ** Ao utilizar o WHERE, é necessário utilizar o GET para retornar os dados,
         ** caso não use o WHERE, pode utilizar o ALL
         */
        return $this->model
            ->with('user')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    /**
                     * O SQL ABAIXO É EQUIVALENTE A:
                     * SELECT * FROM supports WHERE subject = $filter OR body LIKE %$filter%
                     */
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->get()
            ->toArray();
    }
    public function findOne(string $id): stdClass|null
    {
        $support = $this->model->with('user')->find($id);
        if (!$support) {
            return null;
        }
        return (object) $support->toArray();
    }
    public function delete(string $id): void
    {
        $support = $this->model->findOrFail($id);

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Unauthorized');
        }
        $support->delete();
    }

    public function new(CreateSupportDTO $dto): stdClass
    {

        $support =  $this->model->create(
            (array) $dto
        );

        return (object) $support->toArray();
    }
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        if (!$support = $this->model->find($dto->id)) {
            return null;
        }

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Unauthorized');
        }

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }

    public function updateStatus(string $id, SupportStatus $status): void
    {
        $this->model
            ->where('id', $id)
            ->update([
            'status' => $status->name,
        ]);

    }
}
