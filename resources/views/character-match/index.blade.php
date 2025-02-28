@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Character Match Analyzer</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('character-match.process') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="first_input">First Input</label>
                            <input type="text" class="form-control" id="first_input" name="first_input"
                                   placeholder="Enter the character to be searched" required>
                            <small class="form-text text-muted">Ex: ABBCD</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="second_input">Second Input</label>
                            <textarea class="form-control" id="second_input" name="second_input"
                                      rows="3" placeholder="Enter the text that will be analyzed" required></textarea>
                            <small class="form-text text-muted">Ex: Gallant Duck</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Analyze</button>
                        </div>
                    </form>

                    @if(count($recentMatches) > 0)
                    <div class="mt-4">
                        <h5>Latest Data Analysis</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>First Input</th>
                                    <th>Second Input</th>
                                    <th>Percentage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentMatches as $match)
                                <tr>
                                    <td>{{ $match->first_input }}</td>
                                    <td>{{ Str::limit($match->second_input, 30) }}</td>
                                    <td>{{ number_format($match->match_percentage, 2) }}%</td>
                                    <td>
                                        <a href="{{ route('character-match.result', $match->id) }}" class="btn btn-sm btn-info text-white">Show</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('character-match.list') }}" class="btn btn-outline-secondary">Show All</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
