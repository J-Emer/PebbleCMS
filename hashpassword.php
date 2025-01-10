<?php 

echo "Generating hash" . PHP_EOL;
echo "hash = password" . PHP_EOL;
echo password_hash("password", PASSWORD_DEFAULT);

?>