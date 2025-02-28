@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Results of Character Compatibility Analysis</div>

                <div class="card-body">
                    <div class="mb-4">
                        <h4>Matched Percentage: {{ number_format($characterMatch->match_percentage, 2) }}%</h4>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">First Input</div>
                                <div class="card-body">
                                    <code>{{ $characterMatch->first_input }}</code>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Second Input</div>
                                <div class="card-body">
                                    <pre>{{ $characterMatch->second_input }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5>Detailed Analysis</h5>
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $uniqueChars = array_unique(str_split($characterMatch->first_input));
                                    $totalUniqueChars = count($uniqueChars);
                                    $matchCount = 0;
                                @endphp

                                <p>Unique character from the first input:</p>
                                <ul class="list-group list-group-horizontal mb-3">
                                    @foreach($uniqueChars as $char)
                                        @php
                                            $exists = stripos($characterMatch->second_input, $char) !== false;
                                            if ($exists) $matchCount++;
                                        @endphp
                                        <li class="list-group-item {{ $exists ? 'list-group-item-success' : 'list-group-item-danger' }}">
                                            {{ $char }} {{ $exists ? '✓' : '✗' }}
                                        </li>
                                    @endforeach
                                </ul>

                                <p>
                                    {{ $matchCount }} from {{ $totalUniqueChars }} character found.
                                    Percentage: {{ ($matchCount / $totalUniqueChars) * 100 }}%
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('character-match.index') }}" class="btn btn-secondary me-2">Back to Form</a>
                        <form method="POST" action="{{ route('character-match.destroy', $characterMatch->id) }}"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
