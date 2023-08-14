@if ($errors->any())
<div class="abg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 my-4" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
    @endif
    {{-- para receber dados para o component da view utilizamos a tag <x-alert></x-alert> e recebemos os dados
    a partir da variavel $slot {{$slot}} --}}
