<?php
  //cabeçalho e menu
  include_once __DIR__ . '/../includes/header.php';
?>
  
  <style>
    .btn{
        background-color:#001e86; 
    }
    .btn1{
        border-radius: 0;
    }
    .btn2{
        border-radius: 0 0 12px 12px;
    }
    ul{
        color: #ffffff;
        text-decoration: none;
    }
    #botoes {
        z-index: 1;
        display: flex;   
    }
    #botoes:hover {
  background-color: rgb(10, 58, 202);
}
/* Estilos do contêiner de rolagem do grid */
.grid-container {
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  /* Essencial para a rolagem interna */
  height: 100%; /* Defina uma altura fixa */
  width: 20%;
  margin-top: 5%;
  text-align: center;
  /* Opcional: para que a rolagem funcione em dispositivos touch */
  -webkit-overflow-scrolling: touch;
  overflow-y: auto; /* Adiciona a barra de rolagem quando necessário */
  
}
</style>

<div class="d-grid" id="botoes" >
  <button class="btn btn1 text-white" type="button">INÍCIO</button>
  <button class="btn btn2 text-white" type="button">PRATICAR</button>
</div>

  <div class="grid-container">
 <ul class="menu">
    <li>
      <a>MÓDULO - 1 - NOME MÓDULO</a>
      <ul class="submenu">
        <li><a href="modulo1_texto.php">AULA- 1</a></li>
        <li><a href="modulo1_video.php">VIDEOAULA - 1</a></li>
      </ul>
    </li>
    <li>
      <a>MÓDULO - 2 - NOME MÓDULO</a>
      <ul class="submenu">
        <li><a href="modulo1_texto.php">AULA- 2</a></li>
        <li><a href="modulo1_video.php">VIDEOAULA - 2</a></li>
      </ul>
    </li>
    <li>
      <a>MÓDULO - 3 - NOME MÓDULO</a>
      <ul class="submenu">
        <li><a href="modulo1_texto.php">AULA- 3</a></li>
        <li><a href="modulo1_video.php">VIDEOAULA - 3</a></li>
    </ul>
    </li>
    <li>
      <a>MÓDULO - 4 - NOME MÓDULO</a>
      <ul class="submenu">
        <li><a href="modulo1_texto.php">AULA- 4</a></li>
        <li><a href="modulo1_video.php">VIDEOAULA - 4</a></li>
      </ul>
  </li>
  <li>
      <a>MÓDULO - 5 - NOME MÓDULO</a>
      <ul class="submenu">
        <li><a href="modulo1_texto.php">AULA- 5</a></li>
        <li><a href="modulo1_video.php">VIDEOAULA - 5</a></li>
      </ul>
  </li>
  <li>
    <a>MÓDULO - 6 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 6</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 6</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 7 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 7</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 7</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 8 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 8</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 8</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 9 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 9</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 9</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 10 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 10</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 10</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 11 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 11</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 11</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 12 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 12</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 12</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 13 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 13</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 13</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 14 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 14</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 14</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 15 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 15</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 15</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 16 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 16</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 16</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 17 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 17</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 17</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 18 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 18</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 18</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 19 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 19</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 19</a></li>
    </ul>
  </li>
  <li>
    <a>MÓDULO - 20 - NOME MÓDULO</a>
    <ul class="submenu">
      <li><a href="modulo1_texto.php">AULA- 20</a></li>
      <li><a href="modulo1_video.php">VIDEOAULA - 20</a></li>
    </ul>
  </li>
</ul>
    <!-- Adicione mais itens para que o conteúdo ultrapasse a altura máxima -->
  </div>
  <script>
     // Seleciona todos os links principais do menu
  const secoes = document.querySelectorAll('.menu > li > a');

  secoes.forEach(secao => {
    secao.addEventListener('click', () => {
      const li = secao.parentElement;
      const submenu = li.querySelector('.submenu');

     /* // Fecha todos os outros submenus
      document.querySelectorAll('.menu > li').forEach(item => {
        if (item !== li) {
          item.classList.remove('ativo');
          const sub = item.querySelector('.submenu');
          if (sub) sub.classList.remove('aberto');
        }
      });*/

      // Alterna o submenu clicado
      li.classList.toggle('ativo');
      submenu.classList.toggle('aberto');
    });
  });
</script>
<?php
  //código para acesso dos módulos e salvar módulos concluídos
?>
<?php include_once __DIR__ . '/../includes/footer.php'?>
  


