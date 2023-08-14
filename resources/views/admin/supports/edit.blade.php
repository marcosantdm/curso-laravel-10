@extends('admin.layouts.app')
@section('title', 'Editar Tópico')
@section('header')
<h1 class="text-lg text-black-500">Dúvida: {{ $support->subject }}</h1>
@endsection

@section('content')

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    {{-- Sempre que for fazer uma requisição PUT, PATCH ou DELETE,
    é necessário enviar um token de validação. através do @method('PUT') ou com o nome da requisição --}}
    @method('PUT')
    @include('admin.supports.partials.form', [
        'support' => $support
        ])
</form>
@endsection
