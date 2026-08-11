<?php

/**
 * Copyright (C) 2025 Idayat Noufou  <contact@dev2a.pro>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * Endpoint to read the Dolibarr syslog file.
 * Returns the last lines of the file as JSON.
 *
 * Query parameters:
 * - limit:      number of lines to return (default 300, max 1000)
 * - end_offset: byte offset of the end of the block to read (used for pagination)
 */

// Load Dolibarr environment (mandatory)
if (false === (@include_once '../../main.inc.php')) { // From htdocs directory
    require_once '../../../main.inc.php'; // From "custom" directory
}

// Load debug lib
dol_include_once('debug/lib/debug.lib.php');

// Load translations
$langs->load('debug@debug');

header('Content-Type: application/json; charset=utf-8');

$response = array(
    'error' => '',
    'lines' => array(),
    'start_offset' => 0,
    'has_more' => false,
    'file' => ''
);

if (!isDebugActive()) {
    $response['error'] = $langs->trans('DebugLogAccessDenied');
    echo json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

$logfile = debug_get_log_file();
if (empty($logfile)) {
    $response['error'] = $langs->trans('DebugLogNotConfigured');
    echo json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

if (!file_exists($logfile) || !is_readable($logfile)) {
    $response['error'] = $langs->trans('DebugLogFileNotReadable', basename($logfile));
    echo json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

$limit = GETPOST('limit', 'int');
if (empty($limit) || $limit < 1 || $limit > 1000) {
    $limit = 300;
}

$end_offset = null;
if (GETPOSTISSET('end_offset') && GETPOST('end_offset', 'alpha') !== '') {
    $end_offset = GETPOST('end_offset', 'int');
}

$block = debug_read_log_block($logfile, $limit, $end_offset);

foreach ($block['lines'] as $line) {
    $response['lines'][] = array(
        'text' => $line,
        'level' => debug_log_level($line)
    );
}
$response['start_offset'] = $block['start_offset'];
$response['has_more'] = $block['has_more'];
$response['file'] = $logfile;

echo json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE);
