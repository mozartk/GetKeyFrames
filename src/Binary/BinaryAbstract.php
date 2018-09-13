<?php

namespace mozartk\GetKeyFrames\Binary;


abstract class BinaryAbstract implements BinaryInterface
{
    /**
     * @var string ffprobe path
     */
    protected $binaryPath;

    /**
     * @var mixed
     */
    protected $arguments;

    /**
     * @var string
     */
    protected $videoPath;

    protected $process;

    public function getProcess()
    {
        return $this->process;
    }

    public function setBinaryPath(string $binaryPath)
    {
        $this->binaryPath = $binaryPath;
    }

    public function getBinaryPath()
    {
        return $this->binaryPath;
    }

    public function setArgs($arguments)
    {
        $this->arguments = $arguments;
    }

    public function getArgs()
    {
        return $this->arguments;
    }

    public function setVideoPath(string $videoPath)
    {
        $this->videoPath = $videoPath;
    }

    public function getVideoPath()
    {
        return $this->videoPath;
    }
}
