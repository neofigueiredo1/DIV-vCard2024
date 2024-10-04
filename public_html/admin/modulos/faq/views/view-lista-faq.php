<!-- <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block justify-content-start collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h2>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
      </div>
    </div>
  </div>




  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block justify-content-start collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Some placeholder content for the second accordion panel. This panel is hidden by default.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block justify-content-start collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
      </div>
    </div>
  </div>
</div> -->


<?php

$fGrupos = self::getFaqGrupos();

if (is_array($fGrupos)&&count($fGrupos)>0): ?>
  
  <div class="accordion" id="accordionExample" >
    
    <?php foreach ($fGrupos as $key => $fGrupo):
      $fItens = self::getFaqItens($fGrupo['faq_idx']);
    ?>
    <div class="card rounded border mb-2">
    <div class="card-header p-0" id="heading<?php echo $fGrupo['faq_idx']; ?>">
        <h2 class="mb-0" >
            <button class="btn btn-link btn-block justify-content-start collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $fGrupo['faq_idx']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $fGrupo['faq_idx']; ?>" >
                <span class="fs-18"><?php echo $fGrupo['nome']; ?></span>
            </button>
        </h2>
    </div>
    <div id="collapse<?php echo $fGrupo['faq_idx']; ?>" class="collapse" aria-labelledby="heading<?php echo $fGrupo['faq_idx']; ?>" data-parent="#accordionExample">
      <div class="card-body">
        
        <?php if (is_array($fItens)&&count($fItens)>0): ?>
            <?php foreach ($fItens as $key => $fItem): ?>
                
                <?php if ($key>0): ?>
                    <hr />
                <?php endif ?>

                <strong class="pergunta" ><i><?php echo $fItem['pergunta'] ?></i></strong><br/>
                <div class="resposta">
                  <?php echo $fItem['resposta'] ?>
                </div>
            <?php endforeach ?>
        <?php endif ?>


      </div>
    </div>
  </div>
    <?php endforeach; ?>

  </div>

<?php endif ?>