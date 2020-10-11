<?php

/**
 * Reads a text file into an array of strings, 
 * where each element of the array is one line from the file.
 * 
 * @param String - $fileName the name of the file to read
 * @return array - one line per element
 */
function readFileIntoArray($fileName) {
    $res = [];
    $theFile = fopen($fileName, "r") or die("Unable to open file!");

    while (!feof($theFile)) {
        array_push($res, fgets($theFile));
    }
    fclose($theFile);
    return $res;
}

/**
 * Reads a text file as a single string
 * 
 * @param String $fileName the name of the file to read
 * @return String - a string containing the entire file contents
 */
function readFileIntoString($fileName) {
    $theFile = fopen($fileName, "r") or die("sorry!");
    $text = fread($theFile, filesize($fileName));
    fclose($theFile);
    return $text;
}
