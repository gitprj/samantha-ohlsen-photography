<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <span>
        <input type="text" name="s" placeholder="<?php echo esc_attr(__('Type and hit enter ...', 'uxbarn')); ?>" value="<?php echo trim( get_search_query() ); ?>" />
    </span>
</form>