<?php

namespace mozartk\GetKeyFrames;

use Symfony\Component\Process\Process;

class GetKeyFrames
{
    public function run()
    {

    }

    public function getVideoInfo(string $filePath)
    {

        $process = new Process(array('/usr/local/bin/ffprobe', "-show_frames", "-select_streams", "v", "-show_entries",
                "frame=coded_picture_number,pict_type,pkt_dts_time", "-print_format", "csv", $filePath));

        $process->run();
        $data = $process->getOutput();

        return $this->parseResult($data);
    }

    private function parseResult($data)
    {
        $arr = array();
        foreach(explode("\n",$data) as $row) {
            if(trim($row) === '') continue;
            $field = explode(',', $row);
            if(trim($field[2]) === 'I') {
                $arr[] = trim($field[3]);
            }
        }

        return $arr;
    }

}
