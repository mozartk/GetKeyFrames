<?php

namespace mozartk\GetKeyFrames\Test;

use PHPUnit\Framework\TestCase;
use mozartk\GetKeyFrames\GetKeyFrames;

class GetKeyFramesTest extends TestCase
{
    public function testGetResult()
    {
        $info = new GetKeyFrames();
        $data = $info->getVideoInfo("./samples.mkv");

        print_r($data);

        $this->assertGreaterThan(1, count($data['frame']));
        $this->assertGreaterThan(1, count($data['time']));
    }

    public function testGetTime()
    {
        $info = new GetKeyFrames();
        $data = $info->getTime("./samples.mkv");

        $this->assertGreaterThan(1, count($data['time']));
        $this->assertArrayNotHasKey('frame', $data);
    }

    public function testGetFrame()
    {
        $info = new GetKeyFrames();
        $data = $info->getFrame("./samples.mkv");

        $this->assertGreaterThan(1, count($data['frame']));
        $this->assertArrayNotHasKey('time', $data);
    }

    /**
     * @expectedException \mozartk\GetKeyFrames\Exceptions\FFProbeNotFoundException
     */
    public function testFFProbeNotFound()
    {
        $info = new GetKeyFrames();
        $info->setFFProbePath('/a/b/c/d/e');
    }

    /**
     * @expectedException \mozartk\GetKeyFrames\Exceptions\VideoNotFoundException
     */
    public function testVideoNotFound()
    {
        $info = new GetKeyFrames();
        $info->getVideoInfo('/a/b/c/d/e');
    }
}
