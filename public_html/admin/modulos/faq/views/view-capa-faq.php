<?php $fGrupos = self::getFaqGrupos();

if (is_array($fGrupos)&&count($fGrupos)>0): ?>
  <section class="s_faq py-5" >
      <div class="wrapper wrapper-1130 py-md-5 ">
          <h2 class="title_section text-center" >
            Perguntas Frequentes
            <hr>
            <small><?php echo Sis::config("DESCRICAO-CAPA-SECAO-FAQ"); ?></small>
          </h2>

          <div class="items_faq mt-5" >
            <?php foreach ($fGrupos as $key => $fGrupo):
              $fItens = self::getFaqItens($fGrupo['faq_idx']);
            ?>
            <div class="accordion_item" >
              <?php if (is_array($fItens)&&count($fItens)>0): ?>
                <?php foreach ($fItens as $key => $fItem): ?>
                <div class="list_questions">
                  <div class="question_faq"><?php echo $fItem['pergunta'] ?></div>
                  <div class="infos_accordion ativo" >
                    <?php echo $fItem['resposta'] ?>
                  </div>
                </div>
                <?php
                if($key > 3) break;
                 endforeach ?>
              <?php endif ?>
            </div>
            <?php 
           if($key > 2) break;
            endforeach ;?>

            <div class="text-center mt-md-5 mt-3" >
              <a href="/atendimento" class="btn btn-secondary px-5" > 
                  Ver todas as dúvidas 
                  <img class="ml-2 svg" src="/assets/images/arrow-right.svg" alt="ver-todas-as-duvidas" width="24" height="24" />
              </a>
            </div>
            
          </div>
      </div>
  </section>

<?php endif ?>