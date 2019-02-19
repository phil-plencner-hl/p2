<?php
require 'includes/helpers.php';
require 'logic.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>

    <title>Billboard Top Album Charts</title>
    <meta charset='utf-8'>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <link href='/styles/app.css' rel='stylesheet'>

</head>
<body>

<h1>Billboard Top Album Charts</h1>

<p>Select your options below to display a particular Billboard Top Album chart.</p>

<form method='POST' action='search.php'>
    <label>Type in number of results
        <input type='text'
               name='numResults'
               maxlength="2"
               size="3"
               value='<?php if (isset($numResults)) echo $numResults; ?>'>
    </label>
    <label>Select Year
        <select name='year' id='year'>
            <option value='choose'>Choose one...</option>
            <option value='2002' <?php if (isset($year) and $year == '2002') echo 'selected' ?>>2002</option>
            <option value='2003' <?php if (isset($year) and $year == '2003') echo 'selected' ?>>2003</option>
            <option value='2004' <?php if (isset($year) and $year == '2004') echo 'selected' ?>>2004</option>
        </select>
    </label>
    <fieldset class='radios'>
        <legend>Select Billboard Chart</legend>
        <ul id='chart-radios' class='radios'>
            <li><label><input type='radio'
                              name='chart'
                              value='TOP BILLBOARD ALBUMS' <?php if (isset($chart) and $chart == 'TOP BILLBOARD ALBUMS') echo 'checked' ?>> Top Billboard Albums</label>
            <li><label><input type='radio'
                              name='chart'
                              value='TOP R & B ALBUMS' <?php if (isset($chart) and $chart == 'TOP R & B ALBUMS') echo 'checked' ?>> Top R & B Albums</label>
            <li><label><input type='radio'
                              name='chart'
                              value='TOP COUNTRY ALBUMS' <?php if (isset($chart) and $chart == 'TOP COUNTRY ALBUMS') echo 'checked' ?>> Top Country Albums</label>
        </ul>
    </fieldset>

    <input type='submit' value='Search' class='btn btn-primary btn-sm'>
</form>

<?php if (isset($numResults)): ?>
    <div class='alert alert-primary' role='alert'>
        You searched for the top <?= $numResults ?> of the <?= ucwords(strtolower($chart)) ?> in <?= $year ?>.
    </div>
<?php endif; ?>

<?php if (isset($albumCount) && $albumCount == 0): ?>
    <div class='alert alert-warning' role='alert'>
        No results found.
    </div>
<?php endif; ?>

<?php if (isset($albums)): ?>
    <ul class='albums'>
        <?php foreach ($albums as $key => $album): ?>
            <li class='album'>
                <div class='position'><?= $album['position'] ?></div>
                <div class='title'><?= $album['title'] ?></div>
                <div class='artist'> by <?= $album['artist'] ?></div>
                <div class='year'><?= $album['year'] ?></div>
                <img src='<?= $album['cover_url'] ?>' alt='Cover photo for the album <?= $album['title'] ?>'>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif; ?>

</body>
</html>