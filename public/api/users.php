<?php
/**
*   Copyright (C) 2014 University of Central Florida, created by Jacob Bates, Eric Colon, Fenel Joseph, and Emily Sachs.
*
*   This program is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This program is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details.
*
*   You should have received a copy of the GNU General Public License
*   along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
*   Primary Author Contact:  Jacob Bates <jacob.bates@ucf.edu>
*/

require_once(__DIR__.'/includes.php');

// Verify we have the minimum GET parameters we need
if (empty($_GET['action'])) {
    // Set response to 400 (Bad Request)
    respond_with_error(400, 'Request is missing the deauth parameter.  Please contact your administrator.');
}

switch ($_GET['action']) {
    case 'deauth':
        $user_id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT) ? filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT) : null;
        $result = UdoitUtils::instance()->createOrUpdateUser($user_id, '', '', '');
        respond_with_success($results);
        break;

    case 'list':
        $results = UdoitStats::instance()->getUsers();
        if (false === $results) {
            respond_with_error(500, "Error retrieving Users from database.");
        }
        respond_with_success($results);
        break;

    default:
        respond_with_error(400, "Stat {$_GET['action']} does not exist.");
}