# SCAN AND CLONE MALICIOUS PHP YARA SAMPLES
## Table of Contents

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Usage](#usage)
- [Notes](#notes)

## Introduction

This PHP script is designed to scan and copy YARA samples specifically for WordPress projects. It utilises YARA rules to identify specific patterns within the projects and generates a comprehensive report.

## Prerequisites

Before running this script, please ensure that the following prerequisites are met:

- PHP is installed on your system.
- YARA is installed on your system.
- Place the YARA rule file (`php.yar`) inside the `scan_shell` directory.

## Usage

To use this script, follow these steps:

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
5. The report (`report.txt`) will contain detailed information about the identified files that match the YARA rules.
6. The script will also copy the identified files to the corresponding project's output directory for further analysis.

## Notes

Please take note of the following:

- Make sure to adjust the variables in the script to match your specific setup.
- The script assumes that the necessary WordPress files (`wp-config.php`, `wp-login.php`, and `wp-settings.php`) exist in each project directory.
- The script utilises the `shell_exec` function to execute the YARA command. Ensure that your system allows the execution of shell commands.
- The script will create the necessary directories if they don't already exist.

## Author

**Eugene Chu** (@eugeneChuBNE)  
Email (work): [datch@vietnix.com.vn](mailto:datch@vietnix.com.vn)  
Email (personal): [hiendat.chu.dev@gmail.com](mailto:hiendat.chu.dev@gmail.com)  
Telegram: [@eugeneChuBNE](https://t.me/eugeneChuBNE)

---

## License

This project is licensed under the MIT License. See the [LICENSE](./LICENSE) file for details.
