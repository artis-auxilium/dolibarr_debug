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
 * This file was generated by DAMB
 *
 * @copyright   Copyright (c) 2019 - 2020, AXeL-dev
 * @license     GPL
 * @link        https://github.com/AXeL-dev/damb
 */

// Load Dolibarr environment (mandatory)
if (false === (@include_once '../../main.inc.php')) { // From htdocs directory
    require_once '../../../main.inc.php'; // From "custom" directory
}

// Load page & debug lib
dol_include_once('debug/lib/page.lib.php');
dol_include_once('debug/lib/debug.lib.php');
dol_include_once('debug/lib/dolistore.lib.php');

// Load module class
dol_include_once('debug/core/modules/modDebug.class.php');

// Control access to page
control_access('$user->admin');

/**
 * View
 */

print_header('About', array('admin', 'debug@debug'));

print_subtitle('About', 'title_generic.png', 'link:modules_list');

print_debug_admin_tabs('About');

$module = new modDebug(null);

load_template('debug/tpl/about.tpl.php', array(
    'module_name' => $module->name,
    'module_desc' => $module->description,
    'module_picture' => 'debug.png@debug',
    'module_version' => $module->version,
    'module_url' => '#',
    'author_name' => $module->editor_name,
    'author_url' => $module->editor_url,
    'author_email' => 'contact@dev2a.pro',
));

print_footer(true);
