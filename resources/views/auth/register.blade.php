@extends('layouts.app')

@section('title', 'Register')

@section('content')
<h1>Register</h1>

<form action="{{ route('register') }}" method="POST">
    @csrf

    <div>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirm Password:</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <br>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
@endsection
