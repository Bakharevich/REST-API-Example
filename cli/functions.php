<?php
function echoCliError($text)
{
echo "
\033[0;31mERROR:\033[0m {$text}
\n
";
exit(0);
}