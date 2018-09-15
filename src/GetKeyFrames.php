<?php

namespace mozartk\GetKeyFrames;

use mozartk\GetKeyFrames\Exceptions\FFProbeNotFoundException;
use mozartk\GetKeyFrames\Exceptions\VideoNotFoundException;
use mozartk\GetKeyFrames\Parser\CsvParser;
use Symfony\Component\Process\Process;

class GetKeyFrames
{
    const DEFAULT_FFPROBE_PATH = '/usr/local/bin/ffprobe';

    /**
     * @var object 데이터를 파싱하는 파서의 인스턴스
     */
    protected $parser;

    /**
     * @var mixed ffprobe에서 출력하는 데이터의 형식
     */
    protected $ffmpegOutputMode;


    /**
     * @var mixed
     */
    protected $process;

    protected $ffprobePath;

    protected $videoPath;


    public function __construct($opt = array())
    {
        if(!array_key_exists('parser', $opt)) {
            $opt['parser'] = new CsvParser();
        }

        $this->parser = $opt['parser'];

        $this->init();
    }

    private function init()
    {
        $symfony = new Process(array());

        $process = new \mozartk\GetKeyFrames\Binary\Process();
        $process->initProcess();

        $process->setArgs(array('-show_frames', '-select_streams', 'v', '-show_entries',
            'frame=coded_picture_number,pict_type,pkt_dts_time', '-print_format', 'csv'));

        $this->process = $process;
    }

    public function setFFProbePath($ffprobePath)
    {
        if(!file_exists($ffprobePath)) {
            throw new FFProbeNotFoundException("FFProbe not found.");
        }

        $this->ffprobePath = $ffprobePath;
    }

    public function getFFProbePath()
    {
        if(trim($this->ffprobePath) == '') {
            $this->setFFProbePath(self::DEFAULT_FFPROBE_PATH);
        }

        return $this->ffprobePath;
    }

    private function setVideoPath($videoPath)
    {
        if(!file_exists($videoPath)) {
            throw new VideoNotFoundException('videofile not found.');
        }

        $this->videoPath = $videoPath;
    }

    private function getVideoPath()
    {
        return $this->videoPath;
    }

    /**
     * 동영상의 키 정보를 추출함.
     *
     * @param string $videoPath
     * @return array
     */
    public function getVideoInfo(string $videoPath)
    {
        $ffprobe   = $this->getFFProbePath();
        $this->setVideoPath($videoPath);
        $videoPath = $this->getVideoPath();

        $this->process->setBinaryPath($ffprobe);
        $this->process->setVideoPath($videoPath);

        $this->process->runProcess();
        $data = $this->process->getOutput();

        return $this->parser->getResult($data);
    }

    /**
     * 동영상의 키 정보를 추출함.
     *
     * @param string $filePath
     * @return array
     */
    public function getFrame(string $videoPath)
    {
        $ffprobe   = $this->getFFProbePath();
        $this->setVideoPath($videoPath);
        $videoPath = $this->getVideoPath();

        $this->process->setBinaryPath($ffprobe);
        $this->process->setVideoPath($videoPath);

        $this->process->runProcess();
        $data = $this->process->getOutput();

        return $this->parser->getFrame($data);
    }

    /**
     * 동영상의 키 정보를 추출함.
     *
     * @param string $filePath
     * @return array
     */
    public function getTime(string $videoPath)
    {
        $ffprobe   = $this->getFFProbePath();
        $this->setVideoPath($videoPath);
        $videoPath = $this->getVideoPath();

        $this->process->setBinaryPath($ffprobe);
        $this->process->setVideoPath($videoPath);

        $this->process->runProcess();
        $data = $this->process->getOutput();

        return $this->parser->getTime($data);
    }
}
