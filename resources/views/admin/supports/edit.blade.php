<h1>Dúvida: {{ $support->id }}</h1>

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @csrf
    {{-- Sempre que for fazer uma requisição PUT, PATCH ou DELETE,
    é necessário enviar um token de validação. através do @method('PUT') ou com o nome da requisição --}}
    @method('PUT')
    <input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject }}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ $support->body }}</textarea>
    <button type="submit">Enviar</button>
</form>
