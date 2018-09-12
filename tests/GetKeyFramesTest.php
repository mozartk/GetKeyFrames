<?php

namespace mozartk\GetKeyFrames\Test;

use PHPUnit\Framework\TestCase;
use mozartk\GetKeyFrames\GetKeyFrames;

class GetKeyFramesTest extends TestCase
{
    public function testGetVideoInfo()
    {
        $info = new GetKeyFrames();
        $data = $info->getVideoInfo("./samples.mkv");

        print_r($data);

        $this->assertGreaterThan(1, count($data['frame']));
    }
}
