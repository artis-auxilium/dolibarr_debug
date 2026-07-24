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

        global $langs;
        $langs->load('debug@debug');
        print '<style>.debug_page_ok {position: fixed; top: 0; left:0;padding: 5px;background-color: var(--colorbackhmenu1);
                color : var(--colortextbackhmenu);font-size: 0.8rem; width: 20px; height: 20px; overflow: hidden; z-index: 10000} .debug_page_ok:hover { width: 250px }</style><div class="debug_page_ok">'.$langs->trans('DebugEndOFPage').'</div>';
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
