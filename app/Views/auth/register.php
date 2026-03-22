<?php include __DIR__ . '/../layouts/main.php'; ?>

<h1>Реєстрація</h1>

<form method="POST" action="<?php echo BASE_URL; ?>/register">
    <div style="margin-bottom: 15px;">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    
    <div style="margin-bottom: 20px;">
        <label for="confirm_password">Підтвердження паролю:</label>
        <input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    
    <button type="submit" style="background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
        Зареєструватися
    </button>
    
    <p style="margin-top: 15px;">
        Вже маєте акаунт? <a href="<?php echo BASE_URL; ?>/login">Увійти</a>
    </p>
</form>
