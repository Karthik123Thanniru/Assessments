<h1>{{ $question }}</h1>

<form method="get" action="{{ route('show-question', ['index' => $nextIndex, 'score' => $score]) }}">
    @csrf
    <ul>
        @foreach ($options as $index => $option)
            <li>
                <label>
                    <input type="radio" name="answer" value="{{ $index }}">
                    {{ $option }}
                </label>
            </li>
        @endforeach
    </ul>

    @if ($prevIndex >= 0)
        <a href="{{ route('show-question', ['index' => $prevIndex, 'score' => $score]) }}">Previous</a>
    @endif

    @if ($nextIndex < $totalQuestions)
        <button type="submit" name="action" value="next">Next</button>
    @else
        <button type="submit" name="action" value="submit">Submit</button>
    @endif
</form>

<h1>Score: {{ $score }}</h1>
