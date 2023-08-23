<?php

namespace App\Services;

use App\DTO\Replies\CreateReplyDTO;
use stdClass;

class ReplySupportService
{
    public function getAllBySupportId(string $supportId): array
    {
        return [];
    }

    public function createNewe(CreateReplyDTO $createReplyDTO): stdClass
    {
        throw new \Exception('Not implemented');
    }
}
