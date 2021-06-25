@extends('layouts.template')

@section('title')
    <div>
        <h2>Developer</h2>
    </div>
@endsection

@section('content')
    <h1>Developer gass...</h1>
    <h2>Nama: {{$user->nama_lengkap}}</h2>
    <h2>Level: {{$user->level}}</h2>
@endsection
