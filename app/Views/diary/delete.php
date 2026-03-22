<?php include __DIR__ . '/../layouts/main.php'; ?>

<h1>Видалення запису</h1>

<div style="background: #fff3cd; padding: 20px; border: 1px solid #ffeaa7; border-radius: 5px; margin-bottom: 20px;">
    <p>Ви впевнені, що хочете видалити запис <strong>"<?php echo htmlspecialchars($entry['title']); ?>"</strong>?</p>
    <p>Цю дію неможливо скасувати.</p>
</div>

<form method="POST" action="<?php echo BASE_URL; ?>/diary/delete/<?php echo $entry['id']; ?>">
    <button type="submit" style="background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
        Так, видалити
    </button>
    <a href="<?php echo BASE_URL; ?>/diary/view/<?php echo $entry['id']; ?>" style="margin-left: 10px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
        Скасувати
    </a>
</form>
