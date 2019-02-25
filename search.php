<?php
require 'includes/helpers.php';
require 'AlbumList.php';
require 'Form.php';

use DWA\Form;
use P2\AlbumList;

session_start();

$albumList = new AlbumList('charts.json');
$form = new Form($_POST);

# Get data from form request
$numResults = $form->get('numResults');
$year = $form->get('year');
$chart = $form->get('chart');

$errors = $form->validate([
    'numResults' => 'required|digit|min:1|max:10',
    'year' => 'required',
    'chart' => 'required',
]);

if (!$form->hasErrors) {
    # Load chart data
    $albums = $albumList->getByYearAndChart($year, $chart);

    # Only show the number of results selected
    if ($numResults) {
        $albums = array_slice($albums, 0, $numResults, true);
    }
}

# Store our data in the session
$_SESSION['results'] = [
    'errors' => $errors,
    'hasErrors' => $form->hasErrors,
    'numResults' => $numResults,
    'albums' => $albums,
    'albumCount' => count($albums),
    'year' => $year,
    'chart' => $chart,
];

# Redirect back to the form
header('location: index.php');
