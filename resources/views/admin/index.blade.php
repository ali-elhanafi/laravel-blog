<x-admin-master>
@section('content')
@if(auth()->user()->userHasRole('Admin'))
        <h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>
            <canvas id="myChart"></canvas>
            <hr>

            @include('includes.mychart')

        @endif
    @endsection

</x-admin-master>

