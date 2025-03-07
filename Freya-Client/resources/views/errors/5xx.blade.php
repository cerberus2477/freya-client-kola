@extends('error')

@section('code', '5xx')
@section('message', 'Belső szerverhiba történt.')

@section('content')
    @parent
@endsection
