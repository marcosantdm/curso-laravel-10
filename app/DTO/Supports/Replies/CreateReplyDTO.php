<?php

namespace App\DTO\Supports\Replies;

use App\Http\Requests\StoreReplySupportRequest;

class CreateReplyDTO
{
    public function __construct(
        public string $content,
        public string $supportId,
    ) {}

    public static function makeFromRequest(StoreReplySupportRequest $request): self
    {
        return new self(
            $request->content,
            $request->support_id,
        );
    }
}
