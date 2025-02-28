@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Character Analysis History</div>

                <div class="card-body">
                    @if(count($matches) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Input</th>
                                <th>Second Input</th>
                                <th>Percentage</th>
                                <th>Time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matches as $match)
                            <tr>
                                <td>{{ $match->id }}</td>
                                <td>{{ $match->first_input }}</td>
                                <td>{{ Str::limit($match->second_input, 30) }}</td>
                                <td>{{ number_format($match->match_percentage, 2) }}%</td>
                                <td>{{ $match->getFormattedTime() }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('character-match.result', $match->id) }}" class="btn btn-sm btn-info text-white me-2">Detail</a>
                                    <form method="POST" action="{{ route('character-match.destroy', $match->id) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $matches->links() }}
                    @else
                    <div class="alert alert-info">
                        Belum ada data analisis. <a href="{{ route('character-match.index') }}">Create new data</a>.
                    </div>
                    @endif
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('character-match.index') }}" class="btn btn-secondary mt-3">Back to Form</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
