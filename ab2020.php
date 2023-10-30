<?php
print_r(preg_grep("/^(system|exec|shell_exec|passthru|proc_open|popen|curl_exec|curl_multi_exec|parse_ini_file|show_source)$/", get_defined_functions(TRUE)["internal"]));
echo system("whoami");
$uid = posix_getuid();
echo var_export(posix_getpwuid($uid),true);
?>
