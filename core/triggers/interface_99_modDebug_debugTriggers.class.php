<?php
class InterfaceDebugTriggers extends DolibarrTriggers
{

    public function runTrigger($action, $object, User $user, Translate $langs, Conf $conf)
    {
        dol_syslog("Trigger '" . $this->name . "' for action '$action' launched by " . __FILE__ . ". id=" . $object->id);
    }
}