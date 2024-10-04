<?php global $pagina_data, $m_conteudo; ?>

<section class="s_atendimento">

    <div class="wrapper wrapper-1120 infos-section">

        <div class="row">

            <div class="col-lg-3">

                <nav class="navbar flex-column">
                    <?php
                        /* Menu Atendimento */
                        $menu=5; 
                        $lista=true;
                        $separador=false;
                        $submenu=true;
                        $inicio=true;
                        $inicio_side='l';
                        $inicio_txt="";
                        echo $m_conteudo->get_menu($menu,$lista,$separador,$submenu,$inicio,$inicio_side,$inicio_txt);
                    ?>
                </nav>

            </div>

            <div class="col-lg-9 mt-4 mt-lg-0">

                <section class="s_fale_conosco">
                 
                    <h1 class="text-center text-lg-left light fs-24">
                        <?php echo $pagina_data["titulo"] ?>
                    </h1>

                    <hr class="mb-4">


                    <div>
                        <?php echo Sis::desvar($pagina_data['conteudo']); ?>
                        <?php require_once("site/direct-includes/site-contato-form.php"); ?>
                    </div>
                    
                </section>

            </div>

        </div>

    </div>

</section>