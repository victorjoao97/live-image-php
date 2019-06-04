<?
require_once "../config/config.php";
$event = DBRead( 'events', "where id = '{$_GET['id']}' order by date desc limit 1" )[0];
// Get real path for our folder
$rootPath = realpath(path("assets/images/events/" . $event['id']));

// Initialize archive object
$zip = new ZipArchive();
$zip->open($event['id'].'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();