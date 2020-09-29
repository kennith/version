<?php

namespace Kennith\Version;

interface FileManager
{
    function path(): string;
    function stub(): string;
}
