<?php include_once 'language.php'; ?>
<?php include_once 'includes/header.php'; ?>

<main>
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow"><?php echo __('hero_eyebrow'); ?></p>
                <h1><?php echo __('hero_title'); ?></h1>
                <p><?php echo __('hero_description'); ?></p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="#about"><?php echo __('learn_more'); ?></a>
                    <a class="btn btn-secondary" href="#contact"><?php echo __('login_portal'); ?></a>
                </div>
                <ul class="hero-highlights">
                    <li>✅ <?php echo __('highlight_1'); ?></li>
                    <li>✅ <?php echo __('highlight_2'); ?></li>
                    <li>✅ <?php echo __('highlight_3'); ?></li>
                </ul>
            </div>
            <div class="hero-card">
                <img src="<?php echo $hero_image_path; ?>" alt="Rural village infrastructure development">
            </div>
        </div>
    </section>

    <section class="section" id="about">
        <div class="container section-grid">
            <div>
                <p class="eyebrow"><?php echo __('about_eyebrow'); ?></p>
                <h2><?php echo __('about_title'); ?></h2>
                <p><?php echo __('about_p1'); ?></p>
                <p><?php echo __('about_p2'); ?></p>
            </div>
            <div class="card">
                <h3><?php echo __('features_title'); ?></h3>
                <ul>
                    <li><?php echo __('feature_1'); ?></li>
                    <li><?php echo __('feature_2'); ?></li>
                    <li><?php echo __('feature_3'); ?></li>
                    <li><?php echo __('feature_4'); ?></li>
                    <li><?php echo __('feature_5'); ?></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section section-alt" id="services">
        <div class="container">
            <p class="eyebrow"><?php echo __('services_eyebrow'); ?></p>
            <h2><?php echo __('services_title'); ?></h2>
            <div class="card-grid-image">
                <article class="card-with-image">
                    <img src="<?php echo $transport_image; ?>" alt="<?php echo __('service_1_title'); ?>">
                    <div class="card-content">
                        <h3><?php echo __('service_1_title'); ?></h3>
                        <p><?php echo __('service_1_desc'); ?></p>
                    </div>
                </article>
                <article class="card-with-image">
                    <img src="<?php echo $education_image; ?>" alt="<?php echo __('service_2_title'); ?>">
                    <div class="card-content">
                        <h3><?php echo __('service_2_title'); ?></h3>
                        <p><?php echo __('service_2_desc'); ?></p>
                    </div>
                </article>
                <article class="card-with-image">
                    <img src="<?php echo $water_image; ?>" alt="<?php echo __('service_3_title'); ?>">
                    <div class="card-content">
                        <h3><?php echo __('service_3_title'); ?></h3>
                        <p><?php echo __('service_3_desc'); ?></p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section" id="impact">
        <div class="container">
            <p class="eyebrow"><?php echo __('roles_eyebrow'); ?></p>
            <h2><?php echo __('roles_title'); ?></h2>
            <div class="roles-grid">
                <div class="role-card">
                    <h3><?php echo __('role_1_title'); ?></h3>
                    <p><?php echo __('role_1_desc'); ?></p>
                    <small><?php echo __('role_1_level'); ?></small>
                </div>
                <div class="role-card">
                    <h3><?php echo __('role_2_title'); ?></h3>
                    <p><?php echo __('role_2_desc'); ?></p>
                    <small><?php echo __('role_2_level'); ?></small>
                </div>
                <div class="role-card">
                    <h3><?php echo __('role_3_title'); ?></h3>
                    <p><?php echo __('role_3_desc'); ?></p>
                    <small><?php echo __('role_3_level'); ?></small>
                </div>
                <div class="role-card">
                    <h3><?php echo __('role_4_title'); ?></h3>
                    <p><?php echo __('role_4_desc'); ?></p>
                    <small><?php echo __('role_4_level'); ?></small>
                </div>
            </div>
        </div>
    </section>

    <section class="section cta-section">
        <div class="container cta-box">
            <h2><?php echo __('cta_title'); ?></h2>
            <p><?php echo __('cta_description'); ?></p>
            <a class="btn btn-primary" href="#contact">Login / Register</a>
        </div>
    </section>
</main>

<?php include_once 'includes/footer.php'; ?>
