@if (isset($data['num_adults']))
    <div>
        <h1>Beste klant</h1>
        <p>Uw reservering is gemaakte.</p>
        <ul>
            <p>hier is de infomaatie over de gemaakte reservaatie</p>
            <li>de reservaatie was op: {{ $data['time_start'] }}</li>
            <li>Volwassenen: {{ $data['num_adults'] }}</li>
            <li>Kinderen: {{ $data['num_kids'] }}</li>
            <li>Extra Opties: {{ $data['option_name'] }}</li>
        </ul>
    </div>
@endif
