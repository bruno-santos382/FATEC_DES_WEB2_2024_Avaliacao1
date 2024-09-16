    

</div>

<script src="static/lib/bootstrap@523/js/bootstrap.min.js"></script>

<?php if (!empty($script)): ?>
    <?php foreach ($script as $src): ?>
        <script src="<?= htmlspecialchars($src, ENT_QUOTES) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>