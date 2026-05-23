@if (isset($data['num_adults']))
    <div>
        <h1>Beste klant</h1>
        <p>Uw reservering is verwijdert.</p>
        <ul>
            <p>hier is de infomaatie over de verwijderde reservaatie</p>
            <li>Volwassenen: {{ $data['num_adults'] }}</li>
            <li>Kinderen: {{ $data['num_kids'] }}</li>
            <li>de reservaatie is op: {{ $data['time_start'] }}</li>
            <li>de reservaatie duurt: {{ $data['time'] }} uur</li>
            <li>Extra Opties: {{ $data['option_name'] }}</li>
        </ul>
    </div>
@endif
