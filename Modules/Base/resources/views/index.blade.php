@extends('base::layouts.master')

@section('content')
    <div style="display: flex; justify-content: center; align-items: center;height: 100vh">
        <p>Module: {!! config('base.name') !!}</p>
    </div>
@endsection
