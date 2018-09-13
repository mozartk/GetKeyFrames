<?php

namespace mozartk\GetKeyFrames\Binary;

use Symfony\Component\Process\Process as Binary;

class Process extends BinaryAbstract
{
    public function __construct()
    {
    }

    public function initProcess(array $opt)
    {
        $this->process = new Binary(array());
        $this->setVideoPath(array_pop($opt));
        $this->setBinaryPath(array_shift($opt));
        $this->setArgs($opt);
    }

    public function runProcess()
    {
        $processOpt = array();
        $processOpt[] = $this->getBinaryPath();
        $processOpt = array_merge($processOpt, $this->getArgs());
        $processOpt[] = $this->getVideoPath();

        $this->process->setCommandLine($processOpt);

        $this->getProcess()->run();
    }

    public function getOutput()
    {
        return $this->process->getOutput();
    }
}
