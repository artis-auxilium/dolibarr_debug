<?php

/**
 * Copyright (C) 2025 Idayat Noufou  <contact@dev2a.pro>
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

dol_include_once('/debug/vendor/autoload.php');

if (!function_exists('ds')) {
   dol_syslog('Dolibar debug, run `composer install` to use `ds`',LOG_WARNING);
}

class ActionsDebug
{
}