<?php
defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname' => '\core\event\base',
        'callback' => 'local_mycourses_extend_navigation',
        'includefile' => '/local/mycourses/lib.php',
    ],
];
