<table class="my-4 table table-striped table-bordered avoid-breaking-me">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Assessor's Comment</th>
            <th>Estimated Cost</th>
            <th>Benefits / Savings</th>
            <th>Who can do this work?</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($improvements as $index => $imp)
            <tr>
                <td>{{ $index + 1 }}. {{ $imp['title'] }}</td>
                <td>@if (array_key_exists('comment', $imp))
                    {{ $imp['comment'] }}
                @endif </td>
                <td>{{ $imp['estimated_cost'] }}</td>
                <td>{{ $imp['benefits'] }}</td>
                <td>{{ $imp['who_can_do'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
