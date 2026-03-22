<?php
$content = '
<h1>' . htmlspecialchars($welcome) . '</h1>
<p>' . htmlspecialchars($description) . '</p>

<div style="margin: 20px 0;">
    <a href="' . BASE_URL . '/register" class="btn" style="margin-right: 10px;">Почати користуватися</a>
    <a href="' . BASE_URL . '/about" class="btn">Дізнатися більше</a>
</div>

<h2>Особливості</h2>
<ul>
';

foreach ($features as $feature) {
    $content .= '<li>' . htmlspecialchars($feature) . '</li>';
}

$content .= '
</ul>

<h2>Останні оновлення</h2>
<p>Система знаходиться в стадії активного розвитку.</p>
';

require ROOT_DIR . '/app/Views/layouts/main.php';
