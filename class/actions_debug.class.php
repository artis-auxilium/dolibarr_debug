<?php


class ActionsDebug
{
    /**
     * @var DoliDB
     */
    private $db;
    public $resprints;

    /**
     * @param DoliDB $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }



    public function beforeBodyClose($parameters, &$object, &$action)
    {
        global $langs;
        $langs->load('debug@debug');
        print '<div style="position: fixed; bottom: 0; right:0;padding: 5px;background-color: var(--colorbackhmenu1);
                color : var(--colortextbackhmenu);font-size: 1.2rem">'.$langs->trans('EndOFPage').'</div>';
        return 0;
    }
}
