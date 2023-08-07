<h1>Listagem dos suportes</h1>

{{-- Para utilizar mais de um component, abrimos uma tag x- e colocamos o nome do component que será utilizado
exemplo: <x-alert></x-alert> (arquivo de component alert.blade.php),
<x-feedback></x-feedback> (arquivo de component feedback.blade.php) --}}

@if(session('success'))
    <x-feedback>
        {{ session('success') }}
    </x-feedback>
@endif

<a href="{{ route('supports.create') }}">Criar Dúvida</a>

<table>
    <thead>
        <th>Assunto</th>
        <th>Status</th>
        <th>Descrição</th>
        <th></th> {{-- tag de visualizações --}}
    </thead>
    <tbody>
        @foreach ($supports as $support)
        <tr>
            <td>{{ $support['subject'] }}</td>
            <td>{{ $support['status'] }}</td>
            <td>{{ $support['body'] }}</td>
            <td>
                <a href="{{ route('supports.show', $support['id']) }}">ir</a>
                <a href="{{ route('supports.edit', $support['id']) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
