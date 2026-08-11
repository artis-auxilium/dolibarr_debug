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
 * Log viewer: floating badge + native HTML dialog to browse the syslog file.
 */

global $langs;

$langs->load('debug@debug');

$positions = array(
        'top-left'     => 'top:0;left:0',
        'top-right'    => 'top:0;right:0',
        'bottom-left'  => 'bottom:0;left:0',
        'bottom-right' => 'bottom:0;right:0',
);
$css_pos = $positions[getDolGlobalString('DEBUG_PAGE_OK_POSITION', 'bottom-right')];
?>
<style>
    .debug_page_ok {
        position: fixed;
    <?php echo $css_pos; ?>;
        padding: 5px;
        background-color: var(--colorbackhmenu1);
        color: var(--colortextbackhmenu);
        font-size: 0.8rem;
        width: 20px;
        height: 20px;
        overflow: hidden;
        z-index: 10000
    }

    .debug_page_ok:hover {
        width: 250px
    }
</style>

<link rel="stylesheet" href="<?php echo dol_buildpath('debug/css/syslog.css', 1); ?>">

<div id="debug-page-ok" class="debug_page_ok"
     title="<?php echo $langs->trans('DebugLogViewer'); ?>"><?php echo $langs->trans('DebugEndOFPage'); ?></div>

<dialog id="debug-log-dialog" class="debug-log-dialog" data-url="<?php echo dol_buildpath('debug/api/logs.php', 1); ?>">
    <div class="debug-log-header">
        <div><?php echo $langs->trans('DebugLogViewer'); ?>
            <div class="debug-log-file" id="debug-log-file"></div>
        </div>
        <div class="debug-log-actions">
            <button type="button" id="debug-log-refresh"
                    class="button"><?php echo $langs->trans('DebugLogRefresh'); ?></button>
            <button type="button" id="debug-log-close"
                    class="button button-danger"><?php echo $langs->trans('DebugLogClose'); ?></button>
        </div>
    </div>
    <div id="debug-log-loading" class="debug-log-loading" hidden><?php echo $langs->trans('DebugLogLoading'); ?></div>
    <div id="debug-log-body" class="debug-log-body"></div>
    <div id="debug-log-footer" class="debug-log-footer"><?php echo $langs->trans('DebugLogScrollHint'); ?></div>
</dialog>

<script>window.DebugLogMessages = window.DebugLogMessages || {network:<?php echo json_encode($langs->trans('DebugLogNetworkError')); ?>};</script>
<script src="<?php echo dol_buildpath('debug/js/syslog.js', 1); ?>"></script>
