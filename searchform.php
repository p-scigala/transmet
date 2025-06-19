<div class="col-12 col-sm-8 offset-sm-2">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="d-flex flex-column gap-4">
            <div class="flex-fill">
                <div class="form-floating">
                    <input id='base-search-form' type="search" class="search-field form-control" placeholder="<?php _e("Czego szukasz?", "candyweb"); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <label for="base-search-form">
                        <?php _e("Czego szukasz?", "candyweb"); ?>
                    </label>
                </div>
            </div>
            <div class="flex-fill">
                <button type="submit" class="btn btn-primary btn-sm"><?php echo esc_attr_x('Szukaj', 'candyweb'); ?> </button>
            </div>
        </div>
    </form>
</div>