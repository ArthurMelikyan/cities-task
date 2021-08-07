@extends('layouts.app')

@section('content')
<div class="col-md-12 mt-5">
    <h1>Your search history</h1>
    <div class="row">
        <div class="col-md-10">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Searched at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <th scope="row">{{$history->id}}</th>
                            <td>{{$history->full_name}}</td>
                            <td>{{$history->updated_at->format('Y-m-d h:i')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($histories))
                {!! $histories->links() !!}
            @endif
        </div>
    </div>
</div>
@endsection
