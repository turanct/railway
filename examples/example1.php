<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Declare some simple php functions
$shouldContainAtSign = function($string) {
    if (!stristr($string, '@')) {
        throw new InvalidArgumentException('The string should contain an @ sign.');
    }

    return $string;
};
$shouldContainDot = function($string) {
    if (!stristr($string, '.')) {
        throw new InvalidArgumentException('The string should contain a . sign.');
    }

    return $string;
};

// Wrap those functions in Railway tracks!
$dotRailway = new Railway\TwoTrack($shouldContainDot);
$atRailway = new Railway\TwoTrack($shouldContainAtSign);

// Compose them into one function
$composed = function($argument) use ($dotRailway, $atRailway) {
    $argument = new Railway\Success($argument);
    return $dotRailway($atRailway($argument));
};

// Try it
$correctEmail = 'toon@example.com';
var_dump($composed($correctEmail)); // SUCCESS toon@example.com

$malformedEmail1 = 'toon@examplecom';
var_dump($composed($malformedEmail1)); // FAILURE The string should contain a . sign.

$malformedEmail2 = 'toon.example.com';
var_dump($composed($malformedEmail2)); // FAILURE The string should contain an @ sign.

