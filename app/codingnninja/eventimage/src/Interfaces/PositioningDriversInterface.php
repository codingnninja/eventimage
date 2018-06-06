<?php

namespace Codingnninja\Eventimage\Interfaces;

interface PositioningDriverInterface
{
    public function query($searchString);

    public function select(/* $columns */);

    public function get();
}
