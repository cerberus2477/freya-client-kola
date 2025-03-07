@extends('error')

@section('code', '4xx')
@section('message', 'Valami hiba történt a kérés feldolgozásakor.')

@section('content')
    @parent
@endsection
