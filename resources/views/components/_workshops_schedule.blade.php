<table class="table table-hover text-center">
    <thead>
    <tr>
        <th scope="col">Day</th>
        <th scope="col">Time</th>
        <th scope="col">Maximum # of guests</th>
        <th scope="col">Filled</th>
    </tr>
    </thead>
    <tbody>


    @foreach($workshops as $workshop)
        <tr>

            <td>{{ $workshop->day  }}</td>
            <td>{{ $workshop->time }}</td>
            <td>{{ $workshop->max_guests  }}</td>
            <td>{{ $workshop->is_filled }}</td>
        </tr>
    @endforeach
    </tbody>
</table>