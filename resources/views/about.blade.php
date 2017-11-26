@extends('layouts.master')

@section('content')

<div class="container">
    <div id="accordion" role="tablist">
        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                Das Projekt
                </a>
            </h5>
            </div>
            <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                todo
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Die Fahrkartensammlung
                </a>
            </h5>
            </div>

            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <p>Das Deutsche Technikmuseum besitzt die weltweit größte historische Fahrkartensammlung. Die Sammlung umfasst Fahrkarten aus Asien, Europa, Nordamerika, Südamerika, Afrika und Australien von den Anfängen der Eisenbahn Mitte des 19. Jahrhunderts bis in die ersten Jahrzehnte des 20. Jahrhunderts.</p>
                <p>Die Sammlung wurde vom Sammler Fritz Hellmuth zusammengetragen und umfasst ca. 2600 Fahrkarten- A3-Tableaus mit Tickets der verschiedensten Couleur: Von der Kinderkarte bis zur Kriegskarte, Fahrradkarten, aber auch Karten-Fehldrucke und andere Raritäten.</p>
                <p>Der Großteil der Karten hat das standardisierte Format der sogenannten Edmondschen Fahrkarten. Diese Fahrkarten konnte man in ebenfalls standardisierten Fahrkartenschränken verwahren. Die Karten weisen eine hohe Varianz in der farblichen Gestaltung auf und wurden mit ganz unterschiedlichen Lochzangen entwertet.</p>
                <p>Die Sammlung umfasst auch ältere und noch nicht vereinheitlichte Formate, die z.T. handschriftlich ausgestellt wurden. Die Sammlung liegt noch in der ursprünglichen Ordnung und Kategorisierung vor, wie sie vom Sammler angelegt wurde.</p>
                <p><small>(Quelle: codingdavinci.de)</p>
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Über Coding da Vinci
                </a>
            </h5>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                todo
            </div>
            </div>
        </div>
    </div>
</div>

@endsection