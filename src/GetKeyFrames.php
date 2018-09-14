<?php

namespace mozartk\GetKeyFrames;

use mozartk\GetKeyFrames\Parser\CsvParser;
use Symfony\Component\Process\Process;

class GetKeyFrames
{
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

        $process->setBinaryPath('/usr/local/bin/ffprobe');
        $process->setArgs(array('-show_frames', '-select_streams', 'v', '-show_entries',
            'frame=coded_picture_number,pict_type,pkt_dts_time', '-print_format', 'csv'));

        $this->process = $process;
    }

    /**
     * 동영상의 키 정보를 추출함.
     *
     * @param string $filePath
     * @return array
     */
    public function getVideoInfo(string $filePath)
    {
        $this->process->setVideoPath($filePath);

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
    public function getFrame(string $filePath)
    {
        $this->process->setVideoPath($filePath);

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
    public function getTime(string $filePath)
    {
        $this->process->setVideoPath($filePath);

        $this->process->runProcess();
        $data = $this->process->getOutput();

        return $this->parser->getTime($data);
    }
}
