<?php

function findWordPressProjects($dir) {
    $wp_projects = [];
    $directories = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($directories, RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $file) {
        if ($file->isDir() && strpos($file->getPathname(), 'scan_shell') === false) {
            $path = $file->getPathname();
            if (file_exists("$path/wp-config.php") && file_exists("$path/wp-login.php") && file_exists("$path/wp-settings.php")) {
                $wp_projects[] = $path;
            }
        }
    }

    return $wp_projects;
}

function runYaraOnProjects($projects, $yaraRuleFile, $outputDir) {
    foreach ($projects as $project) {
        // Extract the project name from the path
        $projectName = basename($project);

        // Create the output directory inside "cp"
        $projectOutputDir = "$outputDir/cloned_$projectName";
        if (!file_exists($projectOutputDir)) {
            mkdir($projectOutputDir, 0777, true);
        }

        // Create the output file name
        $outputFile = "$projectOutputDir/report.txt";

        // Build the YARA command
        $relativeProjectPath = "../" . basename($project); // Ensure correct relative path
        $command = "yara -r $yaraRuleFile $relativeProjectPath > $outputFile";

        // Execute the command
        shell_exec($command);

        // Print the result of the command for debugging purposes
        echo "Executed command: $command\n";

        // Copy files listed in the report
        copyFilesFromReport($outputFile, $relativeProjectPath, $projectOutputDir);
    }
}

function copyFilesFromReport($reportFile, $sourceProjectDir, $destinationProjectDir) {
    $reportContents = file($reportFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($reportContents as $line) {
        // Extract the file path from the line
        $filePath = preg_replace('/^\w+ \.\.\//', '', $line);
        $fullSourcePath = "$sourceProjectDir/$filePath";
        $fullDestinationPath = "$destinationProjectDir/$filePath";

        if (file_exists($fullSourcePath)) {
            // Create the destination directory if it doesn't exist
            $destinationDir = dirname($fullDestinationPath);
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }

            // Copy the file
            copy($fullSourcePath, $fullDestinationPath);
        }
    }
}

// Define the directories
$homeDir = '../'; // Adjust as needed
$scanShellDir = 'scan_shell'; // Adjust as needed
$yaraRuleFile = "php.yar"; // Path to the YARA rule file relative to scan_shell
$outputDir = 'cp'; // Output directory for logs inside scan_shell

// Ensure the cp directory exists
if (!file_exists($outputDir)) {
    mkdir($outputDir, 0777, true);
}

// Find all WordPress projects
$wp_projects = findWordPressProjects($homeDir);

// Run YARA on each project
runYaraOnProjects($wp_projects, $yaraRuleFile, $outputDir);

?>
