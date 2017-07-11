<p>Rerport of companies registered</p>

<table>
    <tr>
        <td width="10">#</td>
        <td width="100">Event</td>
        <td width="100">Stand</td>
        <td width="100">Price</td>
        <td width="100">Company</td>
        <td width="100">Contact</td>
    </tr>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $value['event'] }}</td>
            <td>{{ $value['stand'] }}</td>
            <td>$ {{ $value['price'] }}</td>
            <td>{{ $value['company'] }}</td>
            <td>{{ $value['contact'] }}</td>
        </tr>
    @endforeach
</table>

