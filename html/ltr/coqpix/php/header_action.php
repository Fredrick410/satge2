<style>.none-validation{display: none;}</style>
<a class="dropdown-item" href="page-user-profile.php">
    <i class="bx bx-user mr-50"></i>
    Profil
</a>
<div class="dropdown-divider mb-0">

</div>
<a class="dropdown-item" href="php/disconnect.php">
    <i class="bx bx-power-off mr-50"></i>
    Se déconnecter
</a>
<div class="dropdown-divider mb-0"></div>
<a class="dropdown-item" href="php/change_theme.php?num=<?= $entreprise['id'] ?>&theme=<?= $entreprise['theme_web'] ?>&path=<?= $_SERVER['PHP_SELF'] ?>">
    <i class="bx bxs-moon mr-50 <?php if ($entreprise['theme_web'] == "dark") {echo 'none-validation';} ?>"></i>
    <i class="bx bx-moon mr-50 <?php if ($entreprise['theme_web'] == "light") {echo 'none-validation';} ?>"></i>
    Apparence
</a>