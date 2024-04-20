<!DOCTYPE html>
<html>
<head>
    <title>Service Detail</title>
</head>
<body>
    <h1>Service Detail</h1>
    <?php if ($service): ?>
        <p>Name: <?= htmlspecialchars($services['Nom']) ?></p>
        <p>Description: <?= htmlspecialchars($services['Description']) ?></p>
        <p>Price: <?= htmlspecialchars($services['Prix']) ?></p>
    <?php else: ?>
        <p>No service found.</p>
    <?php endif; ?>
</body>
</html>