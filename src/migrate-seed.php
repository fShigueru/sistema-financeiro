<?php
try {
    exec(__DIR__ . '/vendor/bin/phinx rollback -t=0');
    exec(__DIR__ . '/vendor/bin/phinx migrate');
    exec(__DIR__ . '/vendor/bin/phinx seed:run');
    echo "Sucesso!" . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage();
}