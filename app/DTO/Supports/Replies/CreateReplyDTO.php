<?php

namespace App\DTO\Supports\Replies;

class CreateReplyDTO
{
    public function __construct(
        public string $content,
        public string $supportId,
    ) {}

    public static function makeFromRequest(object $request): self
    {
        return new self(
            $request->content,
            $request->support_id,
        );
    }
}
