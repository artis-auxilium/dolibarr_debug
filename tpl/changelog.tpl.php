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
 * $changelog_file
 */

global $langs;

?>

<table class="noborder allwidth">
    <tr class="liste_titre">
        <td align="center"><?php echo $langs->trans('Version'); ?></td>
        <td align="center" width="2%"></td>
        <td align="center"><?php echo $langs->trans('PublicationDate'); ?></td>
        <td align="left" width="70%"><?php echo $langs->trans('Details'); ?></td>
    </tr>

<?php

if (file_exists($changelog_file))
{
    $changelog_json = file_get_contents($changelog_file);
    $changelog = json_decode($changelog_json);

    foreach ($changelog->releases as $release)
    {
        ?>
        <tr>
            <td align="center"><?php echo $release->version; ?></td>
            <td align="center"><?php if (isset($release->note)) echo img_warning($release->note); ?></td>
            <td align="center"><?php echo dol_print_date($release->date); ?></td>
            <td align="left">
                <?php foreach ($release->details as $entry) {
                    $badge = '';
                    if (isset($entry->badge) && ! empty($entry->badge))
                    {
                        $badge_class = 'badge ';
                        $badge_to_lower = strtolower($entry->badge);
                        if (in_array($badge_to_lower, array('new', 'upgrade', 'fix', 'experimental'))) {
                            $badge_class.= $badge_to_lower;
                        } else {
                            $badge_class.= 'other';
                        }
                        $badge = '<span class="'.$badge_class.'">'.$entry->badge.'</span>';
                    }

                    echo '<div class="release-details">'.$badge.$entry->text.'</div>';
                } ?>
            </td>
        </tr>
        <?php
    }
}
else
{
    ?>
    <tr>
        <td align="left" colspan="4"><?php echo $langs->trans('NoChangelogAvailable'); ?></td>
    </tr>
    <?php
}

?>

</table>
