@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h1>Login</h1>

<form action="{{ route('login') }}" method="POST">
    @csrf

    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label>
            <input type="checkbox" name="remember" value="1"> Remember me
        </label>
    </div>

    <br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
@endsection
