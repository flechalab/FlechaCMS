
<div id="container-admin">

    <ul class="admin-list">
        <?php
        foreach ($items as $item) {
            echo "<li><a href='{$uri}/{$item['id']}' title='{$item['tooltip']}' class='button'>";
            echo "{$item['desc']}</a></li>";
        }
        ?>
        <br class="clear" />
    </ul>
    <br class="clear" />
</div>

