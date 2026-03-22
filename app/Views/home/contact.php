<?php
$content = '
<h1>' . htmlspecialchars($title) . '</h1>
<p>' . htmlspecialchars($content) . '</p>
<p>Email: support@back-end.local</p>
';

require ROOT_DIR . '/app/Views/layouts/main.php';
