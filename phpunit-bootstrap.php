<?php
$prefix = 'Italia\\SDK18App\\';

$composerautoloadPath = implode(DIRECTORY_SEPARATOR, array(
    '..',
    '..',
    'autoload.php'
));

$baseDir = implode(DIRECTORY_SEPARATOR, array(
    __DIR__,
    'src'
));

if (file_exists($composerautoloadPath)) {
    require_once ($composerautoloadPath);
} else {
    $len = strlen($prefix);
    
    spl_autoload_register(function ($class) use ($prefix, $len, $baseDir) {
        
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }
        
        $relativeClass = substr($class, $len);
        
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        
        if (file_exists($file)) {
            require $file;
        }
    });
}
