<?php

namespace mozartk\GetKeyFrames\Parser;


trait ParserTrait
{
    protected function resultParse($data, $mode = SELF::RESULT_BOTH)
    {
        foreach(explode("\n",$data) as $row) {
            if(trim($row) === '') continue;
            $field = explode(',', $row);
            if(trim($field[2]) === 'I') {
                if($mode & SELF::RESULT_FRAME) {
                    yield $field[3];
                }

                if($mode & SELF::RESULT_TIME) {
                    yield $field[1];
                }
            }
        }
    }
}
