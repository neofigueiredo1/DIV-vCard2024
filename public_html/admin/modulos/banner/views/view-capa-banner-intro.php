<?php

// $bannerMobileID = 63; //Local
// $bannerMobileID = 68; //Homologacao
$bannerMobileID = 75; //Producao

$homeIntro = self::getBanner(49,$pagina=0,$randomize=0,$lista=0,$limite=0,$cycle=0,$cycle_pause=0,$arrayImages=1,$prioridade=0); 
$homeIntroMobile = self::getBanner($bannerMobileID,$pagina=0,$randomize=0,$lista=0,$limite=0,$cycle=0,$cycle_pause=0,$arrayImages=1,$prioridade=0);

?>

<?php if(is_array($homeIntro) && count($homeIntro)>0): ?>
    
    <section class="intro-topo-home <?php echo (is_array($homeIntroMobile) && count($homeIntroMobile)>0)?'d-none d-sm-block':''; ?>" >
        <div class="owl-carousel owl-theme owl-banner-topo-home d-block" >
            <?php

            foreach ($homeIntro as $key => $intro):
                
                $aLink_abre="";
                $aLink_fecha="";
                if($intro['url'] != ""){
                    $aLink_abre = '<a href="'.$intro['url'].'" target="'.$intro['alvo'].'" title="'.$intro['nome'].'" rel="noreferrer" >';
                    $aLink_fecha = '</a>';
                }


                $LPC_lazy = "lazy-background";
                $LPC_image = "background-color:#eee;";
                if ($key==0) {
                    $LPC_lazy = "";
                    $LPC_image = "background-image:url('/sitecontent/banner/".$intro['arquivo']."');";
                }
            
            ?>
                <div>
                    <?php if ($key==0 && !(is_array($homeIntroMobile) && count($homeIntroMobile)>0) ): ?>
                        <img
                            fetchPriority="high" alt="LCP_treat" src="/sitecontent/banner/<?php echo $intro['arquivo'];?>"
                            alt="<?php echo $intro['nome'];?>"
                            width="1920" height="800" style="display:block; position:absolute; visibility:hidden;max-width: initial !important;"
                        />
                    <?php endif ?>
                    <?php echo $aLink_abre ?>
                    <div class="banner-topo-home <?php echo $LPC_lazy; ?>" 
                        style="<?php echo $LPC_image; ?> background-color:#eee;"
                        <?php echo ($key>0)?' data_back="/sitecontent/banner/'.$intro['arquivo'].'" ':''; ?>
                    >
                            

                        <div class="wrapper wrapper-1120 d-flex align-items-center" style="position:absolute;top:0px;height: 100%;" >

                            <?php
                            $descricao = trim(strip_tags($intro['descricao']));
                            if($descricao!=""): ?>
                            <div class="infos-section" >
                                
                                <h1 class="max-350 mb-3 bold branco d-none"><?php echo $intro['nome'];?></h1>
                            
                                <div class="banner-topo-content max-350 mb-2 mb-sm-5 branco">
                                    <?php echo $intro['descricao'];?>
                                </div>

                                <?php if(false)://$intro['url'] != "" ?>
                                    <div class="btn-banner-intro">
                                        <a href="<?php echo $intro['url'];?>" target="<?php echo $intro['alvo'];?>" class="btn btn-primary max-200" title="Ver detalhes" rel="noreferrer">
                                            VER DETALHES
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <?php endif ?>

                        </div>

                    </div>
                    <?php echo $aLink_fecha ?>

                </div>
                
            <?php endforeach ?>
        
        </div>
        <div class="owl-nav" style="visibility:hidden;position:absolute;" ><button type="button" class="owl-prev" title="botao slide"><span aria-label="Previous">‹</span></button><button type="button" class="owl-next" title="botao slide"><span aria-label="Next">›</span></button></div>
        <div class="owl-dots" style="visibility:hidden;position:absolute;" ><button role="button" class="owl-dot" title="botao slide"><span></span></button></div>
    </section>

<?php endif; ?>

<?php if(is_array($homeIntroMobile) && count($homeIntroMobile)>0): ?>
    
    <section class="intro-topo-home intro-topo-home-mobile d-block d-sm-none" >
        <div class="owl-carousel owl-theme owl-banner-topo-home d-block" >
            <?php

            foreach ($homeIntroMobile as $key => $intro):
                
                $aLink_abre="";
                $aLink_fecha="";
                if($intro['url'] != ""){
                    $aLink_abre = '<a href="'.$intro['url'].'" target="'.$intro['alvo'].'" title="'.$intro['nome'].'" rel="noreferrer" >';
                    $aLink_fecha = '</a>';
                }


                $LPC_lazy = "lazy-background";
                $LPC_image = "background-color:#eee;";
                if ($key==0) {
                    $LPC_lazy = "";
                    $LPC_image = "background-image:url('/sitecontent/banner/".$intro['arquivo']."');";
                }
            
            ?>
                <div>
                    <?php if ($key==0): ?>
                        <img
                            fetchPriority="high" alt="LCP_treat" src="/sitecontent/banner/<?php echo $intro['arquivo'];?>"
                            alt="<?php echo $intro['nome'];?>"
                            width="1080" height="700" style="display:block; position:absolute; visibility:hidden;max-width: initial !important;"
                        />
                    <?php endif ?>
                    <?php echo $aLink_abre ?>
                    <div class="banner-topo-home <?php echo $LPC_lazy; ?>" 
                        style="<?php echo $LPC_image; ?> background-color:#eee;"
                        <?php echo ($key>0)?' data_back="/sitecontent/banner/'.$intro['arquivo'].'" ':''; ?>
                    >
                            

                        <div class="wrapper wrapper-1120 d-flex align-items-center" style="position:absolute;top:0px;height: 100%;" >

                            <?php
                            $descricao = trim(strip_tags($intro['descricao']));
                            if($descricao!=""): ?>
                            <div class="infos-section" >
                                
                                <h1 class="max-350 mb-3 bold branco d-none"><?php echo $intro['nome'];?></h1>
                            
                                <div class="banner-topo-content max-350 mb-2 mb-sm-5 branco">
                                    <?php echo $intro['descricao'];?>
                                </div>

                                <?php if(false)://$intro['url'] != "" ?>
                                    <div class="btn-banner-intro">
                                        <a href="<?php echo $intro['url'];?>" target="<?php echo $intro['alvo'];?>" class="btn btn-primary max-200" title="Ver detalhes" rel="noreferrer">
                                            VER DETALHES
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <?php endif ?>

                        </div>

                    </div>
                    <?php echo $aLink_fecha ?>

                </div>
                
            <?php endforeach ?>
        
        </div>
        <div class="owl-nav" style="visibility:hidden;position:absolute;" ><button type="button" class="owl-prev" title="botao slide"><span aria-label="Previous">‹</span></button><button type="button" class="owl-next" title="botao slide"><span aria-label="Next">›</span></button></div>
        <div class="owl-dots" style="visibility:hidden;position:absolute;" ><button role="button" class="owl-dot" title="botao slide"><span></span></button></div>
    </section>

<?php endif; ?>
