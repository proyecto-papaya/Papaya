@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('profiles._admin_table')
        {{ $users->links() }}
    </div>

    <script type="application/javascript">
        $(document).ready(function () {
            $("#adminTable").tablesorter({
                sortList: [[0, 0], [1, 0]],
            });
        });

    </script>
@endsection
