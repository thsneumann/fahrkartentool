@php
    $ticketNames = [
        'Fahrradkarte Schneppenthal', 
        'Bettkarte Hamburg - Kopenhagen', 
        'Arbeiter-Wochen-Fahrkarte Hamburg - Harburg',
        'Militärfahrkarte Finsterwalde - Annahütte',
        'Fahrkarte Dinslaken - Oberhausen',
        'Fahrradkarte Kleinbahn Prettin - Annaburg',
        'Fahrkarte Flinders St. - Caulfield',
        'Viehbegleiterkarte Hvidding'
    ]
@endphp

<div class="row image-grid">
    @foreach ($ticketNames as $ticketName)
        <div class="col-4 col-sm-3">
            <img src="{{ asset('img/ticket_0' . $loop->iteration . '.jpg') }}" alt="{{ $ticketName }}">
        </div>
    @endforeach
</div>