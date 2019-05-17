@extends('layout')


@section('content')

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    @if($workshops)
        <div class="column">
            @include('components._participate-form')
        </div>

        <div class="w-100"></div>

        <div class="column">
            @include('components._workshops_schedule')
        </div>
   @else
        Workshops not found
   @endif







@endsection