<?php

namespace mozartk\GetKeyFrames\Parser;


class CsvParser implements ParserInterface
{
    public function parseResult($data)
    {
        $arr = array();
        foreach(explode("\n",$data) as $row) {
            if(trim($row) === '') continue;
            $field = explode(',', $row);
            if(trim($field[2]) === 'I') {
                $arr['frame'][] = trim($field[3]);
                $arr['time'][] = trim($field[1]);
            }
        }

        return $arr;
    }
}
