<?php

trait BaseSysLogHandler
{
    public $active = true;

    public function __construct()
    {
        $this->code = 'debug';
        include_once dirname(__DIR__) . '/lib/debug.lib.php';
        if (!isDebugActive()) {
            $this->active = false;
            return;
        }

        if (defined('DEBUG_LOADED_FILES')) {
            register_shutdown_function(function () {
                debug_log(get_included_files());
            });
        }
        $path = dirname(__DIR__) . '/vendor/autoload.php';
        if (!file_exists($path)) {
            $this->active = false;
            dol_syslog('Run composer install in ' . dirname(__DIR__), LOG_ERR);
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
            include_once dirname(__DIR__) . '/define.php';
        }
        return DEBUG_VERSION;
    }
}