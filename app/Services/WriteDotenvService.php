<?php

namespace App\Services;

/**
 * .envの書き換え
 *
 * @see vendor/laravel/framework/src/Illuminate/Foundation/Console/KeyGenerateCommand.php
 */
class WriteDotenvService
{
    public function setValue(string $key, string $value)
    {
        $dotenvpath = base_path('.env');
        $replaced = preg_replace(
            "/^{$key}.*$/m",
            $key.'='.$value,
            file_get_contents($dotenvpath)
        );

        if ($replaced === null) {
            return throw new \Exception('.envに '.$key.' キーが設定されておらず、書き換えが出来ませんでした');
        }

        file_put_contents($dotenvpath, $replaced);
    }
}
