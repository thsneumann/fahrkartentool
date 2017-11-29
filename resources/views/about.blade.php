@extends('layouts.master')

@section('content')

<div class="container">
    <div id="accordion" role="tablist">
        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
            <h4 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                Das Projekt
                </a>
            </h4>
            </div>
            <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <p>Das Projekt “FRITZ reist um die Welt” entstand im Rahmen des Kultur-Hackathon Coding da Vinci 2017. Es hat sich zum Ziel gesetzt, die bislang noch ausstehende Verschlagwortung der umfangreichen historischen Fahrkartensammlung des Deutschen Technikmuseums mithilfe eines Crowdsourcing-Tools voranzutreiben.</p>
                <p>Die Web-App bietet zwei Nutzungsmöglichkeiten: einen Spiele- und einen Erkundungsmodus. Ein künstlerisch gestaltetes Einführungsvideo erklärt die Sammlung und das Projekt. Im Spielemodus werden dem Benutzer anschließend noch nicht bearbeitete Fahrkarten vorgelegt, die er mit Metadaten wie Abfahrts- und Zielort, Kategorie und Beschreibungstext anreichert; abwechselnd werden ihm auch die Eingaben anderer Benutzer zur Kontrolle vorgelegt. Für die Verschlagwortung wird er mit Punkten belohnt. Wer ein Profil erstellt, kann seinen Punktestand speichern. Eine Rangliste zeigt die User mit den meisten Punkten an. Nach der Eingabe wird die Fahrkarte und die gefahrene Verbindung auf einer Weltkarte markiert. Diese dient als Ausgangspunkt zum Explorieren der Sammlung.</p>
                <p>Im Erkundungsmodus ermöglichen darüber hinaus tabellarische Ansichten der Tickets, der aufgenommenen Orte und Kategorien eine bequeme Verwaltung der digitalisierten Fahrkartensammlung. Der Benutzer kann zwischen Spiel- und Erkundungsmodus jederzeit hin- und herschalten. Eine REST-API bietet Exportfunktionen der gesammelten Daten im JSON- und CSV-Format.</p>
                <p>Das Projekt richtet sich sowohl an die eher spielerisch veranlagte “Crowd”, als auch an Archivare und Wissenschaftler, die mehr über die globalen Verflechtungen im Reiseverkehr des ausgehenden 19. Jahrhunderts erfahren möchten. Durch die integrierte API richtet sich das Projekt nicht zuletzt auch an Entwickler, welche die Daten in eigene Projekte integrieren können.</p>
                <p>FRITZ wurde in Laravel und VueJS geschrieben, ist auf <a href="https://github.com/thsneumann/fritz" target="_blank">Github</a> frei verfügbar und unter der <a href="https://www.gnu.org/licenses/gpl-3.0.en.html" target="_blank">GPL3</a> lizensiert.</p>
                <p>Die selbst erstellten Grafiken und die Intro-Animation stehen unter der <a href="https://creativecommons.org/licenses/by-sa/3.0/de/" target="_blank">CC-BY-SA3.0 DE Lizenz</a> zur Verfügung.</p>
                <p class="mb-3">
                    <a href="https://github.com/thsneumann/fritz" target="_blank">
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                        Github-Repository
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
            <h4 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Das Team
                </a>
            </h4>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <h5>Programmierung</h5>
                    <p>Thomas Neumann (<a href="https://github.com/thsneumann" target="_blank">github</a>)</p>
                    <h5>Design und Intro-Animation</h5>
                    <ul>
                        <li>Yvonne Götzl</li>
                        <li>Nastasja Keller</li>
                        <li>Tobias Motter (Sprecher)</li>
                    </ul>
                    <p class="mt-2">Wir danken dem Deutschen Technikmuseum für die freundliche Unterstützung während des Projekts.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
            <h4 class="mb-0">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Die Fahrkartensammlung
                </a>
            </h4>
            </div>

            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <p>Das Deutsche Technikmuseum besitzt die weltweit größte historische Fahrkartensammlung. Die Sammlung umfasst Fahrkarten aus Asien, Europa, Nordamerika, Südamerika, Afrika und Australien von den Anfängen der Eisenbahn Mitte des 19. Jahrhunderts bis in die ersten Jahrzehnte des 20. Jahrhunderts.</p>
                <p>Die Sammlung wurde vom Sammler Fritz Hellmuth zusammengetragen und umfasst ca. 2600 Fahrkarten- A3-Tableaus mit Tickets der verschiedensten Couleur: Von der Kinderkarte bis zur Kriegskarte, Fahrradkarten, aber auch Karten-Fehldrucke und andere Raritäten.</p>
                <p>Der Großteil der Karten hat das standardisierte Format der sogenannten Edmondschen Fahrkarten. Diese Fahrkarten konnte man in ebenfalls standardisierten Fahrkartenschränken verwahren. Die Karten weisen eine hohe Varianz in der farblichen Gestaltung auf und wurden mit ganz unterschiedlichen Lochzangen entwertet.</p>
                <p>Die Sammlung umfasst auch ältere und noch nicht vereinheitlichte Formate, die z.T. handschriftlich ausgestellt wurden. Die Sammlung liegt noch in der ursprünglichen Ordnung und Kategorisierung vor, wie sie vom Sammler angelegt wurde.<br>
                <small>(Quelle: <a href="http://codingdavinci.de" target="_blank">codingdavinci.de</a>)</small>
                </p>
                <ul class="mb-3">
                    <li>
                        <a href="https://commons.wikimedia.org/wiki/Category:Rail_tickets_from_the_collection_of_the_Deutsches_Technikmuseum" target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            Die Fahrkartensammlung auf Wikimedia commons
                        </a>
                    </li>
                    <li>
                        <a href="https://codingdavinci.de/downloads/daten-2017/1245_BO3_DeutschesTechnikmuseum-Fahrkarten.pdf" target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            Datenpräsentation der Sammlung auf codingdavinci.de
                        </a>
                </ul>
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
            <h4 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Coding da Vinci
                </a>
            </h4>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                <p>Coding da Vinci ist der erste deutsche Hackathon für offene Kulturdaten. Seit 2014 vernetzt Coding da Vinci technikaffine und kulturbegeisterte Communities mit deutschen Kulturinstitutionen, um das kreative Potential in unserem digitalen Kulturerbe weiter zu entfalten.</p>
                <p>Während ein klassischer Hackathon den Teilnehmern nur wenig Zeit gibt, Softwareanwendungen zu entwickeln – in der Regel ein Wochenende – erstreckt sich Coding da Vinci über eine Zeitspanne von sechs bis zehn Wochen. Dieser erweiterte Zeitrahmen schafft den dringend benötigten Raum, in dem sich die oft getrennten Welten kreativer Technologieentwicklung und institutioneller Kulturbewahrung treffen können, um voneinander zu lernen und miteinander aktiv zu werden.
                <small>(Quelle: <a href="https://codingdavinci.de/about/index-de.html" target="_blank">codingdavinci.de</a>)</small>
                </p>
                <p class="mt-3">
                    <a href="https://codingdavinci.de/">
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                        Website von Coding da Vinci
                    </a>
                </p>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection