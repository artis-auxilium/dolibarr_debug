<?php
/**
 * Copyright (C) 2025 JoeDev2a  <jfd@dev2a.pro>
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

// Load Dolibarr environment
if (false === (@include_once '../../main.inc.php')) {
    require_once '../../../main.inc.php';
}

dol_include_once('debug/lib/page.lib.php');
dol_include_once('debug/lib/setup.lib.php');
dol_include_once('debug/lib/debug.lib.php');

control_access('$user->admin');

$action = GETPOST('action', 'alpha');
load_default_actions($action);

print_header('Options', array('admin', 'debug@debug'));
print_subtitle('Options', 'title_admin.png', 'link:modules_list');
print_debug_admin_tabs('Options');

print_options(array(
    array('name' => 'DEBUG_PAGE_OK_POSITION', 'type' => 'select', 'desc' => 'DebugPageOkPosition', 'values' => array(
        'bottom-right' => 'BottomRight',
        'bottom-left' => 'BottomLeft',
        'top-right' => 'TopRight',
        'top-left' => 'TopLeft'
    )),
));

print_footer(true);
