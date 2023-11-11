<?php

function cuckooremind_version(): string
{
    return trim(file_get_contents(base_path('.version')));
}
