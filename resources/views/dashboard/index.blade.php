@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="flex-grow flex max-w-container-max w-full mx-auto px-margin-desktop py-stack-lg gap-gutter">
@include('layouts.sidebar')
<!-- Main Content -->
<main class="flex-grow flex flex-col gap-stack-lg">
<!-- Welcome Header -->
<section class="flex flex-col gap-stack-sm">
<h1 class="font-headline-lg text-headline-lg text-on-surface">Welcome back, {{auth()->user()->name}}. Convert all your file.</h1>
</main>
</div>
@endsection
