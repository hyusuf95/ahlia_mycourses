<?php
// This file is part of Moodle Course Rollover Plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     mycourses
 * @author      Husain Mohamed
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @var stdClass $plugin
 */


function local_mycourses_extend_navigation(global_navigation $navigation)
{
    global $USER, $CFG;

    // Ensure the user is logged in
    if (!isloggedin() || isguestuser()) {
        return;
    }

    // Get the user's enrolled courses
    $userid = $USER->id;
    $courses = enrol_get_users_courses($userid, true, 'id, fullname');

    // Check if the user is enrolled in any courses
    if (empty($courses)) {
        return;
    }

    // Build the "My Courses" menu
    $mycoursesnode = $navigation->add(get_string('mycourses', 'local_mycourses'), null, navigation_node::TYPE_CONTAINER);

    foreach ($courses as $course) {
        $url = new moodle_url('/course/view.php', ['id' => $course->id]);
        $mycoursesnode->add(format_string($course->fullname), $url);
    }
}
