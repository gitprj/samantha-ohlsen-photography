<form id="form-404" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="row">
        <div class="uxb-col large-12 columns center">
            <input type="text" name="s" placeholder="<?php echo esc_attr(__('Search ...', 'uxbarn')); ?>" value="<?php echo trim( get_search_query() ); ?>" class="search-field" />
            <a href="javascript:;" class="button" onclick="document.getElementById('form-404').submit();"><i class="icon-search"></i>Search</a>
        </div>
    </div>
</form>