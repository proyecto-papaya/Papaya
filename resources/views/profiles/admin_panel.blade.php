@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('profiles._admin_table')
        {{ $users->links() }}
    </div>
@endsection
