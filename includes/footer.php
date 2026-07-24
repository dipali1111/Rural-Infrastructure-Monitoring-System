<footer class="footer" id="contact">
    <div class="container footer-grid">
        <div>
            <h3><?php echo $brand_name; ?></h3>
            <p><?php echo __('footer_about'); ?></p>
        </div>
        <div>
            <h4><?php echo __('footer_contact'); ?></h4>
            <ul>
                <li>Email: <?php echo $contact_email; ?></li>
                <li>Phone: <?php echo $contact_phone; ?></li>
                <li>Location: <?php echo $address; ?></li>
            </ul>
        </div>
        <div>
            <h4><?php echo __('footer_quicklinks'); ?></h4>
            <ul>
                <li><a href="#about"><?php echo __('nav_about'); ?></a></li>
                <li><a href="#services"><?php echo __('nav_services'); ?></a></li>
                <li><a href="#impact"><?php echo __('nav_impact'); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>© <?php echo date('Y'); ?> <?php echo $brand_name; ?>. All rights reserved.</p>
    </div>
</footer>
<script src="assets/js/language.js"></script>
</body>
</html>
