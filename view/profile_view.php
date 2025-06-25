<div class="profile_container">
    <h1>Mon Profile</h1>


    <div class="profile-infos">
        <div class="left-content">
            <div class="header-left">
                <h2> D'un coup d'oeil </h2>
                <div class="profile-card">
                    <div class="card-header">
                        <img src='https://avataaars.io/?avatarStyle=Transparent&topType=LongHairFro&accessoriesType=Blank&hairColor=Brown&facialHairType=Blank&clotheType=ShirtCrewNeck&clotheColor=Pink&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Brown' />
                    </div>
                    <div class="card-content">
                        <h3 class="card-title"><?= htmlspecialchars($userProfile['prenom']) . ' ' . htmlspecialchars($userProfile['nom']) ?></h3>
                        <p><strong>Email:</strong> <?= htmlspecialchars($userProfile['email']) ?></p>

                        <?php if (empty($userProfile['date_naissance'])): ?>
                            <p><strong>Date de naissance:</strong> Pas encore renseignée</p>
                        <?php else: ?>
                            <p> <strong>Date de naissance:</strong> <?= htmlspecialchars($userProfile['date_naissance']) ?></p>
                        <?php endif; ?>
                        <?php if (empty($userProfile['tel'])): ?>
                            <p><strong>Téléphone:</strong> Pas encore renseigné</p>
                        <?php else: ?>
                            <p><strong>Téléphone:</strong> <?= htmlspecialchars($userProfile['tel']) ?></p>
                        <?php endif; ?>

                        <?php if (empty($userProfile['adresse_rue']) && empty($userProfile['adresse_ville']) && empty($userProfile['adresse_cp'])): ?>
                            <p><strong>Adresse:</strong> Pas encore renseignée</p>
                        <?php else: ?>
                            <p><strong>Adresse:</strong> <?= htmlspecialchars($userProfile['adresse_ville']) . "," ?> <?= htmlspecialchars($userProfile['adresse_cp']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <h2>Liens utiles</h2>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <ul class="profile-links">
                    <li><a href="/gestion" class="go_to_link">Espace Admin</a></li>
                </ul>
            <?php endif; ?>
            <ul class="profile-links">
                <li><a href="/messagerie" class="go_to_link">Messagerie</a></li>
                <li><a href="/profile/password_reset" class="go_to_link">Changer de mot de passe</a></li>
                <li><a href="/avis" class="go_to_link">Mes avis</a></li>
                <li><a href="/reservations" class="go_to_link">Mes réservations </a></li>
            </ul>
        </div>
        <div class="form-container right-content">
            <h2>Mettre à jour</h2>
            <form method="post" action="/profile/update">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($userProfile['nom']) ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($userProfile['prenom']) ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($userProfile['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="date_naissance">Date de naissance:</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($userProfile['date_naissance']) ?>">
                </div>
                <div class="form-group">
                    <label for="tel">Téléphone:</label>
                    <input type="tel" id="tel" name="tel" value="<?= htmlspecialchars($userProfile['tel']) ?>">
                </div>
                <div class="form-group">
                    <label for="adresse_rue">Adresse (Rue):</label>
                    <input type="text" id="adresse_rue" name="adresse_rue" value="<?= htmlspecialchars($userProfile['adresse_rue']) ?>">
                </div>
                <div class="form-group">
                    <label for="adresse_ville">Ville:</label>
                    <input type="text" id="adresse_ville" name="adresse_ville" value="<?= htmlspecialchars($userProfile['adresse_ville']) ?>">
                </div>
                <div class="form-group">
                    <label for="adresse_cp">Code Postale:</label>
                    <input type="text" id="adresse_cp" name="adresse_cp" value="<?= htmlspecialchars($userProfile['adresse_cp']) ?>">
                </div>
                <div class="form-group">
                    <button type="submit">Mettre à jour le profil</button>
                </div>
                <?php if (isset($_SESSION['successMessage'])): ?>
                    <div class="success-message"><?= htmlspecialchars($_SESSION['successMessage']) ?></div>
                    <?php unset($_SESSION['successMessage']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['errorMessage'])): ?>
                    <div class="error-message"><?= htmlspecialchars($_SESSION['errorMessage']) ?></div>
                    <?php unset($_SESSION['errorMessage']); ?>
                <?php endif; ?>
            </form>
        </div>

    </div>
</div>