<div class="nav flex">
    <a href="./index.php" class="logo flex">
        <i class="fa-solid fa-truck"></i>
        <p>Rapido</p>
    </a>

    <div class="links flex">
        <a class="link <?php echo (basename($_SERVER['REQUEST_URI']) == '' || basename($_SERVER['REQUEST_URI']) == 'index.php') ? 'active' : ''; ?> after" href="index.php">Courses</a>

        <a class="link <?php echo (basename($_SERVER['REQUEST_URI']) == 'chauffeurs.php') ? 'active' : ''; ?> after" href="./chauffeurs.php">Chauffeurs</a>
    </div>
</div>