<h1>Dúvida: {{ $support->id }}</h1>

{{-- tag para enviar e receber dados do component <x-alert></x-alert> --}}

<x-alert/>

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    {{-- Sempre que for fazer uma requisição PUT, PATCH ou DELETE,
    é necessário enviar um token de validação. através do @method('PUT') ou com o nome da requisição --}}
    @method('PUT')
    @include('admin.supports.partials.form', [
        'support' => $support
        ])
</form>
