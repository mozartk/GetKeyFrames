<?php

namespace mozartk\GetKeyFrames\Binary;


/**
 * Interface BinaryInterface
 * @package mozartk\GetKeyFrames\Binary
 */
interface BinaryInterface
{
    /**
     * Set ffprobe path
     *
     * @param string $binaryPath
     * @return mixed
     */
    public function setBinaryPath(string $binaryPath);

    /**
     * Get the ffprobe path
     *
     * @return string
     */
    public function getBinaryPath();

    /**
     * Sets Arguments to be executed.
     *
     * @param mixed $arguments
     * @return mixed
     */
    public function setArgs($arguments);

    /**
     *
     * Get the Arguments from Binary
     *
     * @return mixed
     */
    public function getArgs();

    /**
     * Set Video Path for encoding
     *
     * @param string $videoPath
     * @return mixed
     */
    public function setVideoPath(string $videoPath);


    /**
     * Set Video Path for encoding
     *
     * @return bool
     */
    public function getVideoPath();

    /**
     * Initialize option arguments
     *
     * @param array $opt
     * @return mixed
     */
    public function initProcess();

    /**
     * 실행 준비된 프로세스 받기.
     *
     * @return mixed
     */
    public function getProcess();

    /**
     * 실행
     *
     * @return bool
     */
    public function runProcess();

    /**
     * @return mixed
     */
    public function getOutput();
}
