@extends('admin.layouts.app')

@section('title', 'Fórum')

@section('header')
@include('admin.supports.partials.header', compact('supports'))
@endsection

@section('content')

{{-- Para utilizar mais de um component, abrimos uma tag x- e colocamos o nome do component que será utilizado
exemplo: <x-alert></x-alert> (arquivo de component alert.blade.php),
<x-feedback></x-feedback> (arquivo de component feedback.blade.php) --}}

@if(session('success'))
    <x-feedback>
        {{ session('success') }}
    </x-feedback>
@endif
@include('admin.supports.partials.content')
<x-pagination
    :paginator="$supports"
    :appends="$filters" />

@endsection
