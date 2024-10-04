<?php

    global $pagina_data;

    $bannerInternoTopo = self::getBanner(55,$pagina_data["codigo"],$randomize=0,$lista=0,$limite=0,$cycle=0,$cycle_pause=0,$arrayImages=1,$prioridade=0); 

?> 

<?php if(is_array($bannerInternoTopo) &&count($bannerInternoTopo) > 0) :?>

    <?php foreach ($bannerInternoTopo as $bannerTopo): ?>

        <section class="banner-topo-institucional infos-section lazyload" style="background-image: url('/sitecontent/banner/<?php echo $bannerTopo['arquivo'];?>');">
            <h1 class="oswald branco text-center position-relative text-uppercase d-none"><?php echo $pagina_data["titulo"] ?></h1>
        </section>

    <?php endforeach; ?>

<?php endif;?>