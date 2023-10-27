@extends('layouts')
@section('main')
    @if (Auth::check())
        {{-- The user is authenticated --}}
        <p>Welcome, {{ Auth::user()->name }}</p>
        <a href="{{ route('logout') }}">Logout</a>
    @else
        {{-- The user is a guest --}}
        <p>You are a guest. Please log in to access more features.</p>
        <a href="{{ route('login') }}">Login</a>
    @endif
@endsection
