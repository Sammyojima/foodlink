<?php
// Redirect the live demo to the Bolt-friendly SQLite version.
// Your original PHP+MySQL app remains unchanged for local use.
header('Location: bolt/index.php');
exit;
