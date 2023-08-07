<h1>Nova Dúvida</h1>

{{-- tag para enviar e receber dados do component <x-alert></x-alert> --}}

<x-alert/>

<form action="{{ route('supports.store') }}" method="POST">
    {{-- <input type="text" value="{{ csrf_token() }}" name="_token"> --}}
    @include('admin.supports.partials.form')
</form>
