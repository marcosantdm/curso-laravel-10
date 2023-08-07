<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{

    public function __construct(
        protected Support $model,
    ) {}
    public function getAll(string $filter = null): array
    {
        /**
         ** Ao utilizar o WHERE, é necessário utilizar o GET para retornar os dados,
         ** caso não use o WHERE, pode utilizar o ALL
         */
        return $this->model
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
        $support = $this->model->find($id);
        if(!$support) {
            return null;
        }
        return (object) $support->toArray();
    }
    public function delete(string $id): bool
    {
        $this->model->findOrFail($id)->delete();
        return true;
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
        if(!$support = $this->model->find($dto->id)) {
            return null;
        }

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }
}
