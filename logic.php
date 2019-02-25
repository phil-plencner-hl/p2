<?php
session_start();

$hasErrors = false;

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $albums = $results['albums'];
    $numResults = $results['numResults'];
    $year = $results['year'];
    $chart = $results['chart'];
    $albumCount = $results['albumCount'];
    $errors = $results['errors'];
    $hasErrors = $results['hasErrors'];
}

session_unset();