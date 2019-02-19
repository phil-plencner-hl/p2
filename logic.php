<?php
session_start();

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $albums = $results['albums'];
    $numResults = $results['numResults'];
    $year = $results['year'];
    $chart = $results['chart'];
    $albumCount = $results['albumCount'];
}

session_unset();