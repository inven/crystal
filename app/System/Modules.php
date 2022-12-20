<?php

namespace App\System;

use Crystal\Module;

class Modules
{

    public function __construct(

    )
    {
        # config modules

        # init modules
        $modules = $this->getModules();
        foreach ($modules as $module) {
            $module->init($this);
        }
    }

    public function run(): void
    {
        # run root module
    }

    /**
     * @return Module[]
     */
    public function getModules(): array
    {
        return get_object_vars($this);
    }

}
