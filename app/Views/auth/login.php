<?php include __DIR__ . '/../layouts/main.php'; ?>

<h1>Мій щоденник</h1>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="flash-message"><?= $_SESSION['flash_message'] ?></div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>

<a href="/diary/create">Створити новий запис</a>

<?php if (empty($entries)): ?>
    <p>Записів ще немає.</p>
<?php else: ?>
    <ul>
        <?php foreach ($entries as $entry): ?>
            <li>
                <h3><a href="/diary/<?= $entry['id'] ?>"><?= htmlspecialchars($entry['title']) ?></a></h3>
                <small><?= date('d.m.Y H:i', strtotime($entry['created_at'])) ?></small>
                <a href="/diary/<?= $entry['id'] ?>/edit">Редагувати</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
