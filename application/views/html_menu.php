    <!-- header start -->
    <div id="header">

        <a href="index.php" title="Flecha Web">
            <!--
            <img src="images/logo-flechaweb.png" alt="Flecha Web" width="150" height="150" border="0" />
             -->
            <img src="./lib/images/logos/logo-flecha.png" alt="Flecha Web" border="0" />
        </a>
        <!--
            <h1>Donec scelerisque arcu</h1>
            <a href="#" class="service" title="Services Join Now">Services Join Now</a>
            <a href="#" class="recycle" title="Recycle Join Now">Recycle Join Now</a>
            -->
    </div>
    <!-- header end -->

    <!-- top navigation pannel start -->
    <div id="topNav">
        <ul>
            <?php
            foreach ($content as $item) {
                ?>
                <li>
                    <a href="/#<?php echo $item['info']['page'] ?>" title="<?php echo $item['info']['title'] ?>">
                        <?php echo $item['info']['title'] ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <!-- top navigation pannel end -->