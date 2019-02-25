<?php

namespace P2;

class AlbumList
{
    # Properties
    private $albums;

    # Methods
    public function __construct($json)
    {
        # Load chart data
        $chartJson = file_get_contents('charts.json');
        $this->albums = json_decode($chartJson, true);
    }

    public function getAll()
    {
        return $this->albums;
    }

    public function getByYear(Int $year)
    {
        $results = [];

        # Filter album list according to year
        foreach ($this->albums as $key => $album) {
            $match = $year == $album['year'];
            if ($match) {
                $results[$album['position'] . '-' . $album['title']] = $album;
            }
        }

        return $results;
    }

    public function getByChart(String $chart)
    {
        $results = [];

        # Filter album list according to Billboard chart
        foreach ($this->albums as $key => $album) {
            $match = $chart == $album['chart'];
            if ($match) {
                $results[$album['position'] . '-' . $album['title']] = $album;
            }
        }

        return $results;
    }

    public function getByYearAndChart(Int $year, String $chart)
    {
        $results = [];

        $yearAlbums = $this->getByYear($year);
        $chartAlbums = $this->getByChart($chart);
        $mergedAlbums = array_intersect_key($yearAlbums, $chartAlbums);

        // Sort by Position
        foreach ($mergedAlbums as $key => $album) {
            $results[$album['position']] = $mergedAlbums[$key];
        }
        ksort($results);

        return $results;
    }

}