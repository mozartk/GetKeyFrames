<?php

namespace mozartk\GetKeyFrames\Parser;


interface ParserInterface
{
    public function getResult($data);
    public function getFrame($data);
    public function getTime($data);
}
