<footer id="footer" class="footer">
  <div class="wrapper">
    <div class="footer__top">

      <div class="footer__col footer__col--1">
        <div class="footer__logo">
          <a href="<?php echo home_url(); ?>" class="footer__logo-link">
            <?php echo get_custom_logo(); ?>
          </a>
        </div>
        <?php if(get_field("options_footer_desc", "option")): ?>
        <p class="footer__desc">
          <?php echo get_field("options_footer_desc", "option"); ?>
        </p>
        <?php endif; ?>
        <?php
      get_template_part("template-parts/components/socials", null, array(
        "class" => "footer__socials",
        "hide_labels" => true
      ));
      ?>
      </div>

      <div class="footer__col footer__col--2">
        <h4 class="footer__menu-label">Menu</h4>
        <?php
        wp_nav_menu(array(
          "theme_location" => "footer",
          "menu_class" => "footer__menu",
          "container" => "ul"
        ));
        ?>
      </div>

      <div class="footer__col footer__col--3">
        <h4 class="footer__menu-label">Produkty</h4>
        <ul class="footer__menu">
          <li>
            <a href="">Bestsellery</a>
          </li>
          <li>
            <a href="">Ostatnio dodane</a>
          </li>
        </ul>
      </div>

      <div class="footer__col footer__col--4">
        <h4 class="footer__menu-label">Kontakt</h4>
        <ul class="footer__menu">

          <?php if(get_field("options_address", "option")): ?>
          <li class="footer__menu-item">
            <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icon-pin.svg" class="footer__menu-icon"
              alt="Address:" />
            <span><?php echo get_field("options_address", "option"); ?></span>
          </li>
          <?php endif; ?>

          <?php if(get_field("options_email", "option")): ?>
          <li class="footer__menu-item">
            <a href="mailto: <?php echo get_field("options_email", "option"); ?>">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icon-mail.svg" class="footer__menu-icon"
                alt="E-mail:" />
              <span><?php echo get_field("options_email", "option"); ?></span>
            </a>
          </li>
          <?php endif; ?>

          <?php if(get_field("options_phone", "option")): ?>
          <li class="footer__menu-item">
            <a href="tel: <?php echo get_field("options_phone", "option"); ?>">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icon-phone.svg" class="footer__menu-icon"
                alt="Phone:" />
              <span><?php echo get_field("options_phone", "option"); ?></span>
            </a>
          </li>
          <?php endif; ?>

        </ul>
      </div>

    </div>
  </div>

  <div class="wrapper">
    <div class="footer__bottom">

      <a href="/privacy-policy">Regulamin i polityka prywatności</a>

      <!-- <div class="footer__copy">
      &copy;
      <a href="https://candyweb.pl">Candyweb</a>
      <?php echo date("Y"); ?>
    </div> -->

    </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>

</html>