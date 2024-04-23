<!DOCTYPE html>
<html>
<head>
    <title>Service Detail</title>
</head>
<body>
    <h1>Service Detail</h1>
    <?php if ($Services): ?>
        <p>Name: <?= htmlspecialchars($Services['Nom']) ?></p>
        <p>Description: <?= htmlspecialchars($Services['Description']) ?></p>
        <p>Price: <?= htmlspecialchars($Services['Prix']) ?></p>
    <?php else: ?>
        <p>No service found.</p>
    <?php endif; ?>
</body>
</html>