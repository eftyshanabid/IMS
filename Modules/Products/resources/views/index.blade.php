@extends('products::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('products.name') !!}</p>
@endsection
