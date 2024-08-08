# SCAN_AND_CP_YARA_SAMPLES.PHP
## Table of Contents

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Usage](#usage)
- [Notes](#notes)

## Introduction

This PHP script scans and copies YARA samples for WordPress projects. It utilizes YARA rules to identify specific patterns in the projects and generates a report.

## Prerequisites

Before running this script, ensure the following:

- PHP is installed on your system.
- YARA is installed on your system.
- Place the YARA rule file (`php.yar`) inside the `scan_shell` directory.

## Usage

1. Clone this repository to your local machine.
2. Adjust the necessary variables in the script according to your setup:
    - `$homeDir`: The directory where your WordPress projects are located.
    - `$scanShellDir`: The directory name where the script is located.
    - `$yaraRuleFile`: The path to the YARA rule file relative to `scan_shell`.
    - `$outputDir`: The output directory for logs inside `scan_shell`.
3. Run the script by executing the following command in your terminal:

    ```bash
    php scan_and_cp_yara_samples.php
    ```

4. The script will scan all WordPress projects in the specified directory and generate a report in the `cp` directory inside `scan_shell`.
5. The report (`report.txt`) will contain information about the identified files that match the YARA rules.
6. The script will also copy the identified files to the corresponding project's output directory for further analysis.

## Notes

- Make sure to adjust the variables in the script to match your specific setup.
- The script assumes that the necessary WordPress files (`wp-config.php`, `wp-login.php`, and `wp-settings.php`) exist in each project directory.
- The script utilizes the `shell_exec` function to execute the YARA command. Ensure your system allows the execution of shell commands.
- The script creates the necessary directories if they don't already exist.

Author: Eugene Chu (eugeneChuBNE@Github)
License: MIT License

