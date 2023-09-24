<x-mail::message>
# Dúvida Respondida

Assunto da dúvida {{ $reply->support_id }} foi respondida com <b>{{ $reply->content }}</b>.

<x-mail::button :url="route('replies.index', $reply->support_id)">
    Ver Dúvida
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
