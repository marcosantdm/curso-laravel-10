<h1>Dúvida: {{ $support->id }}</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

@endif

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @csrf
    {{-- Sempre que for fazer uma requisição PUT, PATCH ou DELETE,
    é necessário enviar um token de validação. através do @method('PUT') ou com o nome da requisição --}}
    @method('PUT')
    <input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject }}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ $support->body }}</textarea>
    <button type="submit">Enviar</button>
</form>
