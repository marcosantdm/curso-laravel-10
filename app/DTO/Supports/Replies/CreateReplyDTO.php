<?php

namespace App\DTO\Replies;

class CreateReplyDTO
{
    public function __construct(
        public string $content,
        public string $supportId,
    ) {}
}
