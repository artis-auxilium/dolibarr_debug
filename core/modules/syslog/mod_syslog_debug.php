<?php

require_once DOL_DOCUMENT_ROOT . '/core/modules/syslog/logHandler.php';


class mod_syslog_debug extends LogHandler
{
    public $code = 'debug';
    public $active = true;
    public function __construct()
    {
        include_once dirname(__DIR__, 3) . '/lib/debug.lib.php';
        if (defined('DEBUG_LOADED_FILES')) {
            register_shutdown_function(function () {
                debug_log(get_included_files());
            });
        }
        $path = dirname(__DIR__, 3) . '/vendor/autoload.php';
        if (!file_exists($path)) {
            $this->active = false;
            dol_syslog('Run composer install in ' . dirname(__DIR__, 3), LOG_ERR);
            return;
        }
        include_once $path;
    }
    public function isActive()
    {
        return $this->active;
    }

    public function getVersion()
    {
        if (!defined('DEBUG_VERSION')) {
            include_once dirname(__DIR__, 3) . '/define.php';
        }
        return DEBUG_VERSION;
    }

}