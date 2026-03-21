<ul class="menu">
    <li class="dropdown">
        <a href="#">Relatório</a>
         <ul class="submenu">
            <li><a href="relatorio_gasto.php">Relatório Gastos</a></li>
        </ul> 
    </li>
    <li class="dropdown">
        <a href="#">Cadastro</a>
         <ul class="submenu">
            <li><a href="cadastro_gasto.php">Cadastrar Gasto</a></li>
        </ul> 
    </li>
    <a href="logout.php">Logout</a>
</ul>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.menu .dropdown > a').on('click', function(e){
            var $parentLi = $(this).parent();

            if ($(this).attr('href') === '#') {
                e.preventDefault();
            }
            $('.menu .dropdown').not($parentLi).removeClass("active");
            $parentLi.toggleClass('active');
        })
    });
</script>