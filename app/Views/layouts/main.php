<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Онлайн-щоденник'); ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">Онлайн-щоденник</div>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/">Головна</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/about">Про нас</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/contact">Контакти</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/login">Вхід</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/register">Реєстрація</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="message success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['warning'])): ?>
            <div class="message warning"><?php echo htmlspecialchars($_SESSION['warning']); unset($_SESSION['warning']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['info'])): ?>
            <div class="message info"><?php echo htmlspecialchars($_SESSION['info']); unset($_SESSION['info']); ?></div>
        <?php endif; ?>
        
        <?php echo $content ?? ''; ?>
    </main>
    
</body>
</html>
