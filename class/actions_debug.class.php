<?php
require_once dirname(__DIR__).'/lib/debug.lib.php';

class ActionsDebug
{
     private $waitListAction = ['list'];
    /**
     * @var DoliDB
     */
    public $resprints;



    public function beforeBodyClose($parameters, &$object, &$action)
    {
        if (!isDebugActive()) return 0;
        require_once dirname(__DIR__).'/lib/page.lib.php';
        load_template('debug/tpl/logviewer.tpl.php');
        return 0;
    }

    public function llxFooter($parameters, &$object, &$action)
    {
        if (!isDebugActive()) return 0;

        if (in_array($action, $this->waitListAction)) {
            return 0;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            setEventMessage('POST not redirected', 'warnings');
        }

        return 0;
    }

}
