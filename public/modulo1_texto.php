<?php
    include("modulos.php");
?>

<style>
/* força a sidebar do modulos.php a comportar-se como barra lateral */
.grid-container {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 100%;
  max-width: 300px;    /* opcional: limita largura em telas grandes */
  box-sizing: border-box;
  padding: 0.5rem;       /* opcional */
}

/* área que ocupa o restante (ao lado da sidebar) */
.area-conteudo {
  margin-left: 20%;    /* deixa o espaço para a sidebar fixa */
  width: 80%;
  min-height: 100%;   /* garante ocupar a altura */
  display: flex;
  justify-content: center; /* centraliza horizontalmente dentro dos 80% */
  align-items: center;  /* troque para center se quiser também vertical */
  padding: 2rem;
  box-sizing: border-box;
}

/* o bloco real do seu conteúdo */
.conteudo {
  width: 100%;
  max-width: 900px;    /* largura máxima do conteúdo */
  margin-left: 20%;
  color: #ffffff;
}

/* se outras regras estiverem sobrescrevendo, força com !important */
.area-conteudo.force { margin-left: 20% !important; }
</style>

<div class="area-conteudo">
  <div class="conteudo">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eaque accusantium veritatis exercitationem voluptates architecto dignissimos repellat ab, delectus omnis nesciunt consequatur itaque voluptate inventore repellendus! Reprehenderit corporis eligendi ex.
  </div>
</div>
