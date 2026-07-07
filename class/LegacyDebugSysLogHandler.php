<?php

class DebugSysLogHandler extends LogHandler implements LogHandlerInterface
{
    use BaseSysLogHandler;

    public function getName()
    {
        return 'debug';
    }

    public function export($content)
    {
        // TODO: Implement export() method.
    }
}