<?php

namespace mozartk\GetKeyFrames\Binary;

class Process extends BinaryAbstract
{
    public function __construct()
    {
    }

    public function runProcess()
    {
        $processOpt = array();
        $processOpt[] = $this->getBinaryPath();
        $processOpt = array_merge($processOpt, $this->getArgs());
        $processOpt[] = $this->getVideoPath();

        $this->process = new \Symfony\Component\Process\Process(array());

        $this->process->setCommandLine($processOpt);

        $this->getProcess()->run();
    }

    public function getOutput()
    {
        return $this->process->getOutput();
    }
}
