<?php

namespace mozartk\GetKeyFrames\Parser;


class CsvParser implements ParserInterface
{
    use ParserTrait;
    /**
     * 시간만 얻을 때 사용
     */
    const RESULT_TIME = 1;

    /**
     * 프레임만 얻으려면
     */
    const RESULT_FRAME = 2;

    /**
     * 프레임과 시간을 동시에 얻으려면
     */
    const RESULT_BOTH = 3;

    public function getResult($data)
    {
        $arr = array();
        $field = array('frame', 'time');
        $i = 0;
        foreach($this->resultParse($data) as $val) {
            $arr[$field[$i%2]][] = $val;
            $i++;
        }

        return $arr;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getFrame($data)
    {
        $arr = array();
        foreach($this->resultParse($data, self::RESULT_FRAME) as $val) {
            $arr['frame'][] = $val;
        }

        return $arr;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getTime($data)
    {
        $arr = array();
        foreach($this->resultParse($data, self::RESULT_TIME) as $val) {
            $arr['time'][] = $val;
        }

        return $arr;
    }
}
