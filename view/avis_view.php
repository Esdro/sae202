<div class="avis_container">
    <div class="new_avis">
        <a href="/avis/add" class="new_avis_btn">Donner mon avis </a>
    </div>
    <h1>Mes avis</h1>
    <?php if (!empty($mesAvis)): ?>
        <div class="avis-liste">
            <?php if ($mesAvis): ?>
                <?php foreach ($mesAvis as $avis): ?>
                    <div class="avis-box">
                        <div class="rating-box">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="avis-rate star <?= $i <= $avis['rate'] ? 'filled' : '' ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <p><?= htmlspecialchars($avis['username']) ?></p>
                        <p><?= $avis['content'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php else: ?>
            <p>Vous n'avez pas encore laissé d'avis.</p>
            <a href="/avis/add" class="button_action go_to_link">Donner mon avis</a>
        </div>
    <?php endif; ?>
</div>
    <div class="autres_avis">
        <h2>Les avis publiés par d'autres participants </h2>
        <?php if ($allPublishedAvis): ?>
            <div class="avis-liste">
                <?php foreach ($allPublishedAvis as $avi): ?>
                    <div class="avis-box">
                        <div class="rating-box">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="avis-rate star <?= $i <= $avi['rate'] ? 'filled' : '' ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <p><?= htmlspecialchars($avi['username']) ?></p>
                        <p><?= $avi['content'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>