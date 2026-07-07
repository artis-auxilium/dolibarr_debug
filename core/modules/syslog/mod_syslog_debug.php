<?php

require_once DOL_DOCUMENT_ROOT . '/core/modules/syslog/logHandler.php';
require_once dirname(__DIR__, 3) . '/class/BaseSysLogHandler.php';

if (version_compare(DOL_VERSION, '20', '<')) {
    require_once dirname(__DIR__, 3) . '/class/LegacyDebugSysLogHandler.php';
} else {
    require_once dirname(__DIR__, 3) . '/class/DebugSysLogHandler.php';
}


class mod_syslog_debug extends DebugSysLogHandler
{


}