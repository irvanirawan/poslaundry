@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $bulan = Carbon::now()->translatedFormat('F');
@endphp

@extends('layout')

@section('content')



@endsection

@push('scripts')

@endpush