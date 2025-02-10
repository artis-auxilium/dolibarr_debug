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
 * This file is a part of DAMB
 *
 * An advanced module builder for Dolibarr ERP/CRM
 *
 *
 * @package     DAMB
 * @author      AXeL
 * @copyright   Copyright (c) 2019 - 2020, AXeL-dev
 * @license     GPL
 * @link        https://github.com/AXeL-dev/damb
 *
 */

/**
 * The following variables are required for this template:
 * $module_name
 * $module_desc
 * $module_picture
 * $module_version
 * $module_url
 * $author_name
 * $author_url
 * $author_email
 */

global $langs, $conf, $db;

?>

<br>
<div style="float: left; margin-right: 20px;">
    <?php echo img_picto($module_name, $module_picture, 'width="128"'); ?>
</div>
<div>
    <div>
        <a href="<?php echo $module_url; ?>" target="_blank"><b><?php echo $langs->trans($module_name); ?></b></a>
        <span><?php echo ' : '.$langs->trans($module_desc); ?></span>
    </div>
    <br>
    <div>
        <span><?php echo $langs->trans('DevelopedBy'); ?></span>
        <a href="<?php echo $author_url; ?>" target="_blank"><b><?php echo $author_name; ?></b></a>
    </div>
    <br>
    <div>
        <span><?php echo $langs->trans('ForAnyQuestions'); ?></span>
        <a href="mailto:<?php echo $author_email; ?>"><?php echo $author_email; ?></a>
    </div>
    <br>
    <div class="tabsAction" style="text-align: center;">
        <a href="<?php echo $_SERVER['PHP_SELF'].'?mainmenu=home&action=report_bug'; ?>" class="buttonDelete"><?php echo $langs->trans('ReportBug'); ?></a>
    </div>
</div>

<?php

$action = GETPOST('action', 'alpha');

if ($action == 'report_bug')
{

$log_file_name = basename($conf->global->SYSLOG_FILE);
$log_file_link = '<a href="'.DOL_URL_ROOT.'/document.php?modulepart=logs&file='.$log_file_name.'" title="'.$langs->transnoentities('Download').'">'.$log_file_name.'</a>';
echo $langs->trans('ReportBugNotice', $log_file_link);

if (empty($conf->syslog->enabled)) {
    $enable_log_link = '<a href="'.$_SERVER['PHP_SELF'].'?mainmenu=home&action=enable_log">'.img_picto($langs->trans('ClickToEnable'), 'switch_off').'</a>';
    echo img_warning().'&nbsp;'.$langs->trans('EnableLogModule', $enable_log_link);
}

?>

<br><br>

<table class="noborder allwidth">
    <tr class="liste_titre">
        <td width="20%"><?php echo $langs->trans('TechnicalInformations'); ?></td>
        <td><?php echo $langs->trans('Value'); ?></td>
    </tr>
    <tr>
        <td><?php echo $langs->trans('DolibarrVersion'); ?></td>
        <td><?php echo DOL_VERSION; ?></td>
    </tr>
    <tr>
        <td><?php echo $langs->trans('ModuleVersion'); ?></td>
        <td><?php echo $module_version; ?></td>
    </tr>
    <tr>
        <td><?php echo $langs->trans('PHPVersion'); ?></td>
        <td><?php echo phpversion(); ?></td>
    </tr>
    <tr>
        <td><?php echo $langs->trans('DatabaseVersion'); ?></td>
        <td><?php echo $db->getVersion(); ?></td>
    </tr>
    <tr>
        <td><?php echo $langs->trans('WebServerVersion'); ?></td>
        <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
    </tr>
</table>

<?php

}
