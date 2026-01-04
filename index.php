<?php
require('conexao.php');
$estilo_filtro = isset($_GET['estilo']) ? $_GET['estilo'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css?v=2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <title>Didi Pratas | Joias em Prata 925</title>
</head>

<body>
    <header class="header-principal">
        <div class="header-container">
            <div class="header-left">
                <div class="menu-toggle" onclick="document.querySelector('.sidebar').classList.add('active')">
                    <span></span><span></span><span></span>
                </div>
                <div class="logo-img">
                    <a href="index.php">
                        <img src="img/logo2.png" alt="Didi Pratas">
                    </a>
                </div>
            </div>
            <nav class="menu-fixo">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="#todos-os-produtos">PRODUTOS</a></li>
                    <li><a href="#rodape-profissional">CONTATOS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <nav class="categorias-container">
        <ul class="categorias-lista">
            <li><a href="index.php">TODOS</a></li>
            <li><a href="index.php?estilo=Religiosos">RELIGIOSOS</a></li>
            <li><a href="index.php?estilo=Cristais">CRISTAIS</a></li>
            <li><a href="index.php?estilo=Minimalistas">MINIMALISTAS</a></li>
            <li><a href="index.php?estilo=Pedrarias">PEDRARIAS</a></li>
        </ul>
    </nav>

    <div class="sidebar">
        <div class="close-menu" onclick="document.querySelector('.sidebar').classList.remove('active')">×</div>
        <h3 class="titulo-menu">Categorias</h3>
        <ul>
            <li><a href="#brincos" onclick="fecharMenu()">Brincos</a></li>
            <li><a href="#aneis" onclick="fecharMenu()">Anéis</a></li>
            <li><a href="#cordoes" onclick="fecharMenu()">Cordões</a></li>
            <li><a href="#pulseiras" onclick="fecharMenu()">Pulseiras</a></li>
            <li><a href="#tornozeleiras" onclick="fecharMenu()">Tornozeleiras</a></li>
        </ul>
    </div>

    <section class="banner-principal">
        <div class="banner-conteudo">
            <span class="tag-promo">Promoção</span>
            <h1>NOSSAS PRATAS</h1>
            <p>Joias que contam histórias</p>
            <a href="#mais-vendidos" class="btn-confira">Confira</a>
        </div>
    </section>

    <main class="container">
        <div id="todos-os-produtos"></div>

        <?php
        // MAIS VENDIDOS 
        if ($estilo_filtro == '' || $estilo_filtro == 'All'):
            $q_venda = "SELECT * FROM produtos WHERE `mais-vendidos` = 'sim' ORDER BY id DESC LIMIT 4";
            $res_venda = mysqli_query($conn, $q_venda);
            if ($res_venda && mysqli_num_rows($res_venda) > 0): ?>
                <section id="mais-vendidos" class="secao-produtos">
                    <h2 class="titulo-secao">Mais Vendidos</h2>
                    <div class="grid-produtos">
                        <?php while ($prod_venda = mysqli_fetch_assoc($res_venda)): ?>
                            <div class="card-prata <?php echo ($prod_venda['estoque'] <= 0) ? 'card-esgotado' : ''; ?>" style="position: relative;">
                                <?php if ($prod_venda['estoque'] <= 0): ?>
                                    <div class="selo-indisponivel">Indisponível</div>
                                <?php endif; ?>
                                
                                <div class="img-container">
                                    <a href="produto-detalhes.php?id=<?php echo $prod_venda['id']; ?>">
                                        <img src="img/<?php echo $prod_venda['imagem']; ?>" alt="mais vendidos">
                                    </a>
                                </div>
                                <h3><?php echo $prod_venda['nome']; ?></h3>
                                <span class="preco">R$ <?php echo number_format($prod_venda['preco'], 2, ',', '.'); ?></span>
                                
                                <?php if ($prod_venda['estoque'] <= 0): ?>
                                    <span class="btn-esgotado">ESGOTADO</span>
                                <?php else: ?>
                                    <a href="produto-detalhes.php?id=<?php echo $prod_venda['id']; ?>" class="btn-comprar">Eu quero este</a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php endif;
        endif; ?>

        <?php
        // BLOCO DE LANÇAMENTOS 
        $ids_exibidos = [];
        $q_novidades = ($estilo_filtro != '' && $estilo_filtro != 'All') 
            ? "SELECT * FROM produtos WHERE lançamentos = 'sim' AND estilo = '$estilo_filtro' ORDER BY id DESC"
            : "SELECT * FROM produtos WHERE lançamentos = 'sim' ORDER BY id DESC";
        
        $res_novidades = mysqli_query($conn, $q_novidades);
        if ($res_novidades && mysqli_num_rows($res_novidades) > 0): ?>
            <section id="lancamentos" class="secao-produtos">
                <h2 class="titulo-secao">Novidades da Semana</h2>
                <div class="grid-produtos">
                    <?php while ($produto = mysqli_fetch_assoc($res_novidades)): 
                        $ids_exibidos[] = $produto['id']; ?>
                        <div class="card-prata <?php echo ($produto['estoque'] <= 0) ? 'card-esgotado' : ''; ?>" style="position: relative;">
                            <?php if ($produto['estoque'] <= 0): ?>
                                <div class="selo-indisponivel">Indisponível</div>
                            <?php endif; ?>

                            <div class="img-container">
                                <a href="produto-detalhes.php?id=<?php echo $produto['id']; ?>">
                                    <img src="img/<?php echo $produto['imagem']; ?>" alt="novidades">
                                </a>
                            </div>
                            <h3><?php echo $produto['nome']; ?></h3>
                            <span class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                            
                            <?php if ($produto['estoque'] <= 0): ?>
                                <span class="btn-esgotado">ESGOTADO</span>
                            <?php else: ?>
                                <a href="produto-detalhes.php?id=<?php echo $produto['id']; ?>" class="btn-comprar">Eu quero este</a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        //  2 BLOCO AUTOMÁTICO PARA AS OUTRAS CATEGORIAS 
        $lista_excluir = !empty($ids_exibidos) ? implode(',', $ids_exibidos) : '0';
        $categorias = [
            ['id' => 'aneis', 'titulo' => 'Anéis em Prata 925', 'tipo' => 'Anéis'],
            ['id' => 'pulseiras', 'titulo' => 'Pulseiras', 'tipo' => 'Pulseiras'],
            ['id' => 'cordoes', 'titulo' => 'Cordões e Colares', 'tipo' => 'Cordões e colares'],
            ['id' => 'brincos', 'titulo' => 'Brincos', 'tipo' => 'Brincos'],
            ['id' => 'tornozeleiras', 'titulo' => 'Tornozeleiras', 'tipo' => 'Tornozeleiras']
        ];

        foreach ($categorias as $cat):
            $t = $cat['tipo'];
            $query = ($estilo_filtro != '' && $estilo_filtro != 'All')
                ? "SELECT * FROM produtos WHERE tipo = '$t' AND estilo = '$estilo_filtro' AND id NOT IN ($lista_excluir) ORDER BY id DESC"
                : "SELECT * FROM produtos WHERE tipo = '$t' AND id NOT IN ($lista_excluir) ORDER BY id DESC";
            
            $res = mysqli_query($conn, $query);
            if ($res && mysqli_num_rows($res) > 0): ?>
                <section id="<?php echo $cat['id']; ?>" class="secao-produtos">
                    <h2 class="titulo-secao"><?php echo $cat['titulo']; ?></h2>
                    <div class="grid-produtos">
                        <?php while ($prod = mysqli_fetch_assoc($res)): ?>
                            <div class="card-prata <?php echo ($prod['estoque'] <= 0) ? 'card-esgotado' : ''; ?>" style="position: relative;">
                                <?php if ($prod['estoque'] <= 0): ?>
                                    <div class="selo-indisponivel">Indisponível</div>
                                <?php endif; ?>

                                <div class="img-container">
                                    <a href="produto-detalhes.php?id=<?php echo $prod['id']; ?>">
                                        <img src="img/<?php echo $prod['imagem']; ?>" alt="">
                                    </a>
                                </div>
                                <h3><?php echo $prod['nome']; ?></h3>
                                <span class="preco">R$ <?php echo number_format($prod['preco'], 2, ',', '.'); ?></span>
                                
                                <?php if ($prod['estoque'] <= 0): ?>
                                    <span class="btn-esgotado">ESGOTADO</span>
                                <?php else: ?>
                                    <a href="produto-detalhes.php?id=<?php echo $prod['id']; ?>" class="btn-comprar">Comprar Agora</a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php endif; 
        endforeach; ?>

        <section class="secao-cuidados">
            <div class="container-cuidados">
                <h2 class="titulo-secao">Por que escolher nossas joias?</h2>
                <p class="subtitulo">Uma das vantagens das joias de prata é que elas <strong>duram a vida toda</strong>.</p>
                <hr class="divisor-sutil">
                <h2 class="titulo-secao">Cuidados com as Pratas</h2>
                <div class="grid-cuidados">
                    <div class="card-cuidado"><i class="fas fa-flask"></i><h3>Produtos Químicos</h3><p>Evite contato com produtos de limpeza e cosméticos.</p></div>
                    <div class="card-cuidado"><i class="fas fa-dumbbell"></i><h3>Esforço Físico</h3><p>Evite levantar objetos pesados que possam deformar a peça.</p></div>
                    <div class="card-cuidado"><i class="fas fa-bed"></i><h3>Ao Dormir</h3><p>Retire seus acessórios antes de dormir para evitar quebras.</p></div>
                    <div class="card-cuidado"><i class="fas fa-tint-slash"></i><h3>Local Seco</h3><p>Mantenha em local seco e limpe regularmente.</p></div>
                </div>
            </div>
        </section>
    </main>

    <footer id="rodape-profissional" class="rodape-profissional">
        <div class="footer-container">
            <div class="footer-info">
                <img src="img/didipratas.png" alt="Didi Pratas" class="logo-footer">
                <p>Joias em prata 925 com garantia exclusiva.</p>
            </div>
            <div class="footer-contato">
                <h3>Compre por telefone</h3>
                <p>(21) 98140-4612</p>
                <h3>Envie uma mensagem</h3>
                <p>Nalair98@gmail.com</p>
            </div>
            <div class="footer-horario">
                <h3>Horário de Atendimento</h3>
                <p>Seg à Quinta das 09h as 17h.</p>
                <p>Sexta à domingo das 09h as 16h.</p>
            </div>
            <div class="footer-col">
                <h3>Garantia e Trocas</h3>
                <p><strong>Prazo de Troca:</strong> 30 dias após o recebimento.</p>
                <p>A garantia não cobre quebra ou perda de pedras.</p>
            </div>
        </div>
    </footer>

    <script>
        function fecharMenu() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) sidebar.classList.remove('active');
        }
    </script>
</body>
</html>