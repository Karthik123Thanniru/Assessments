<?php

namespace CustomCommand\ImportData\Api;

/**
 * Interface ProfileInterface
 * @package CustomCommand\ImportData\Api
 */
interface ProfileInterface
{

    /**
     * Import data from a source
     *
     * @param string $source The source path or location
     * @return void
     */
    public function import($source);
}