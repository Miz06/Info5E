<?php
echo getcwd(); //current directory
echo '<br>';

echo DIRECTORY_SEPARATOR;
echo '<br>';

//is_file - is_dir
$path = getcwd();
echo is_file($path.DIRECTORY_SEPARATOR.'prova.txt') ? 'trovato' : 'non trovato';
echo '<br>';

echo is_dir($path.DIRECTORY_SEPARATOR.'mydir') ? 'trovato' : 'non trovato';
echo '<br>';

//scandir
$items = scandir($path.DIRECTORY_SEPARATOR.'mydir');
echo '<h2> Files in myDir </h2>';
echo '<ul>';
foreach ($items as $item)
    if(str_starts_with($item, 'f'))
        echo '<li>'.$item.'</li>';
echo '</ul>';

//file_get_content: do not recognize rows
$text = file_get_contents($path.DIRECTORY_SEPARATOR.'prova.txt');
echo '<div>'.$text.'</div>';
echo '<br>';

//file: recognize rows
$rows = file ($path.DIRECTORY_SEPARATOR.'prova.txt');
foreach ($rows as $row)
    echo '<div>'.$row.'</div>';
echo '<br>';

//file_put_contents: overwrite content into the file
$text ='ciao ciao, scrivo ancora';
file_put_contents($path.DIRECTORY_SEPARATOR.'prova.txt', $text);

$subjects = [
    'informatica',
    'tpsit',
    'sistemi e reti',
];

$names = implode("\n", $subjects);
$text = file_put_contents($path.DIRECTORY_SEPARATOR.'prova.txt', $names, FILE_APPEND);

//copy - rename - unlink - feof()

//---------------------------------------------------------
echo '-----------------------------------';
echo '<br>';

// Get the current working directory
echo "Current working directory: " . getcwd() . "\n";
echo '<br>';

// Show the directory separator
echo "Directory separator: " . DIRECTORY_SEPARATOR . "\n";
echo '<br>';

// Check if a path is a file, a directory or if it exists
$path = 'example.txt';
echo "Is file? " . (is_file($path) ? 'Yes' : 'No') . "\n";
echo '<br>';

echo "Is directory? " . (is_dir($path) ? 'Yes' : 'No') . "\n";
echo '<br>';

echo "File exists? " . (file_exists($path) ? 'Yes' : 'No') . "\n";
echo '<br>';

// List contents of a directory
$files = scandir('.');
echo "Contents of directory:\n";
print_r($files);
echo '<br>';

// Read and write file contents
file_put_contents('example.txt', "Hello, world!\n");
echo "Contents of 'example.txt': " . file_get_contents('example.txt') . "\n";
echo '<br>';

// Copy, rename, and delete files
copy('example.txt', 'copy_example.txt');
echo "File copied.\n";
echo '<br>';

rename('copy_example.txt', 'renamed_example.txt');
echo "File renamed.\n";
echo '<br>';

unlink('renamed_example.txt');
echo "File deleted.\n";
echo '<br>';

// Working with large files using fopen, fgets, fwrite, and feof
$file = fopen('large_file.txt', 'w');
fwrite($file, "Line 1\nLine 2\nLine 3\n");
fclose($file);
echo '<br>';

$file = fopen('large_file.txt', 'r');
while (!feof($file)) {
    $line = fgets($file);
    echo $line . "\n";
}
fclose($file);
echo '<br>';

unlink('large_file.txt'); // Clean up the file
echo '<br>';
