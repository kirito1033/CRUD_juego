<?php if (isset($profile) && !empty($profile['profile_photo'])): ?>
    <img src="<?= base_url($profile['profile_photo']) ?>" alt="Foto de perfil" width="100">
<?php else: ?>
    <p>No hay foto de perfil disponible.</p>
<?php endif; ?>