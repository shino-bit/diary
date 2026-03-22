<?php
$content = '
<h1>' . htmlspecialchars($title) . '</h1>
<p>' . htmlspecialchars($content) . '</p>
<p>Цей проект розробляється як курсова робота з використанням архітектури MVC.</p>
';

require ROOT_DIR . '/app/Views/layouts/main.php';
