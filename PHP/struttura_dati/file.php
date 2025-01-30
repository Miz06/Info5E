<?php
$materie = [
    "INFORMATICA" => [
        "C:\\Utenti\\Alessandro\\Documenti" => ["argomento" => "Algoritmi di Ordinamento", "mese" => "Febbraio"],
        "C:\\Utenti\\Alessandro\\Documenti2" => ["argomento" => "Programmazione Orientata agli Oggetti", "mese" => "Aprile"]
    ],
    "SISTEMI" => [
        "C:\\Utenti\\Alessandro\\Documenti" => ["argomento" => "Reti di Calcolatori", "mese" => "Marzo"],
        "C:\\Utenti\\Alessandro\\Documenti2" => ["argomento" => "Dijkstra", "mese" => "Maggio"]
    ],
    "TPS" => [
        "C:\\Utenti\\Alessandro\\Documenti" => ["argomento" => "Socket", "mese" => "Gennaio"],
        "C:\\Utenti\\Alessandro\\Documenti2" => ["argomento" => "Sicurezza Informatica", "mese" => "Giugno"]
    ]
];

function stampa($materie, $disciplina, $percorso):string {
    if (array_key_exists($disciplina, $materie)) {
        if (array_key_exists($percorso, $materie[$disciplina])) {
            $info = $materie[$disciplina][$percorso];

            return 'Argomento: ' . $info['argomento'] . '<br><br>' . 'Mese: ' . $info['mese'];
        } else {
            return "Percorso non trovato per la disciplina $disciplina.<br>";
        }
    } else {
        return 'Disciplina non trovata.<br>';
    }
}

echo stampa($materie, 'INFORMATICA', 'C:\\Utenti\\Alessandro\\Documenti' );

?>