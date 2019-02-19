<?php
session_start();

require 'includes/helpers.php';

# Get data from form request
$numResults = $_POST['numResults'];
$year = $_POST['year'];
$chart = $_POST['chart'];

# Load chart data
$chartJson = file_get_contents('charts.json');
$albums = json_decode($chartJson, true);

# Filter chart data according to search terms
foreach ($albums as $key => $album) {
    if ($year) {
        $yearMatch = $year == $album['year'];
    }
    if ($chart) {
        $chartMatch = $chart == $album['chart'];
    }

    if (!$yearMatch || !$chartMatch) {
        unset($albums[$key]);
    }
}

# Only show the number of results selected
if ($numResults) {
    $albums = array_slice($albums, 0, $numResults, true);
}

# Store our data in the session
$_SESSION['results'] = [
    'numResults' => $numResults,
    'albums' => $albums,
    'albumCount' => count($albums),
    'year' => $year,
    'chart' => $chart,
];

# Redirect back to the form
header('location: index.php');
