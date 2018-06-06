<?php

namespace Codingnninja\Eventimage\Interfaces;

interface EventImageBuilderInterface
{
    public function query($searchString);

    public function select(/* $columns */);

    public function get();
}
