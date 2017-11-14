<h3 class=" mb-4 table-header">Summary table</h3>

<table class="my-4 table avoid-breaking-me">
    <thead>
        <tr>
            <th>Measures</th>
            <th>Comment</th>
            <th>Estimated Cost</th>
            <th>Benefits / Savings</th>
            <th>Who can do this work?</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($improvements as $index => $imp)
            @if ($imp['value'] == 'need')
            <tr>
                <td>{{ $index + 1 }}. {{ $imp['title'] }}</td>
                <td>@if (array_key_exists('comment', $imp))
                    {{ $imp['comment'] }}
                @endif </td>
                <td>{{ $imp['estimated_cost'] }}</td>
                <td>{{ $imp['benefits'] }}</td>
                <td>{{ $imp['who_can_do'] }}</td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>
