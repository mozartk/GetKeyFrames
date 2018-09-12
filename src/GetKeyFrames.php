<?php

namespace mozartk\GetKeyFrames;

use mozartk\GetKeyFrames\Parser\CsvParser;
use Symfony\Component\Process\Process;

class GetKeyFrames
{
    /**
     * @var 데이터를 파싱하는 파서의 인스턴스
     */
    protected $parser;


    public function __construct($opt = array())
    {
        if(!array_key_exists('parser', $opt)) {
            $opt['parser'] = new CsvParser();
        }

        $this->parser = $opt['parser'];
    }

    /**
     * 동영상의 키 정보를 추출함.
     *
     * @param string $filePath
     * @return array
     */
    public function getVideoInfo(string $filePath)
    {

        $process = new Process(array('/usr/local/bin/ffprobe', "-show_frames", "-select_streams", "v", "-show_entries",
                "frame=coded_picture_number,pict_type,pkt_dts_time", "-print_format", "csv", $filePath));

        $process->run();
        $data = $process->getOutput();

        return $this->parser->parseResult($data);
    }
}
