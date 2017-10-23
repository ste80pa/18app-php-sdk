<?php
$autoloadPath = implode(DIRECTORY_SEPARATOR, array('..','..', 'autoload.php'));
$prefix = 'Italia\\SDK18App\\';
$baseDir = implode(DIRECTORY_SEPARATOR, array('..','src')) . DIRECTORY_SEPARATOR;

if(file_exists($autoloadPath))
{
    require_once($autoloadPath);
}
else
{   
    $len = strlen($prefix);

    spl_autoload_register(function ($class) use ($prefix, $len, $baseDir){
            if (strncmp($prefix, $class, $len) !== 0)
                return;
        
            $relativeClass = substr($class, $len);
            
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file))
                require $file;
            
    });
}
