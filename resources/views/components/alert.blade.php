<div class="alert alert-danger">
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {{-- para receber dados para o component da view utilizamos a tag <x-alert></x-alert> e recebemos os dados
    a partir da variavel $slot {{$slot}} --}}
</div>
