<?php
include('conexao.php');

// 1. Pega o ID da URL. Se não tiver ID, volta para a vitrine
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// 2. Busca os dados reais no banco
$query = "SELECT * FROM produtos WHERE id = '$id'";
$resultado = mysqli_query($conn, $query);
$produto = mysqli_fetch_assoc($resultado);

// Se o ID não existir no banco, volta para a vitrine
if (!$produto) {
    header("Location: index.php");
    exit;
}

// 3. Configura o WhatsApp
$numeroDidi = "5521981404612";
$precoFormatado = number_format($produto['preco'], 2, ',', '.');
$mensagem = "Olá Didi Pratas! Gostaria de mais informações sobre: " . $produto['nome'] . " (R$ " . $precoFormatado . ")";
$linkFinal = "https://wa.me/" . $numeroDidi . "?text=" . urlencode($mensagem);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="Styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <title>Didi Pratas | <?php echo $produto['nome']; ?></title>

    <style>
        :root {
            --dourado: #b59b5d;
            --grafite: #333;
            --suave: #666;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: #fff;
            margin: 0;
            color: var(--grafite);
        }

        /* --- AJUSTES APENAS PARA COMPUTADOR --- */

        /* Voltar mais visível */
        .voltar-container {
            padding: 25px 40px;
        }

        .voltar-link {
            text-decoration: none;
            color: #888;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .container-detalhe {
            max-width: 1150px;
            margin: 10px auto 60px;
            padding: 20px;
            display: flex;
            gap: 60px;
            align-items: center;
        }

        /* --- AJUSTE NA IMAGEM PARA COMPUTADOR --- */
        .produto-imagem-foco {
            flex: 0.8;
            /* a proporção da coluna da imagem */
            text-align: center;
        }

        .produto-imagem-foco img {
            width: 100%;
            max-width: 400px;
            border-radius: 4px;
        }

        .produto-info {
            flex: 1.2;
            
        }

        /* Aumentando a descrição e textos laterais no PC */
        .material-tag {
            color: var(--dourado);
            font-size: 0.8rem;
            letter-spacing: 3px;
            font-weight: 700;
            display: block;
            margin-bottom: 15px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin: 0;
            font-weight: 500;
            color: #111;
            line-height: 1.1;
        }

        .preco-destaque {
            font-size: 2rem;
            color: #111;
            font-weight: 400;
            margin: 20px 0;
        }

        /* Descrição maior e mais legível no PC */
        .descricao {
            font-size: 1.1rem;
            color: var(--suave);
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .btn-whatsapp {
            background-color: #128c7e;
            color: white;
            text-decoration: none;
            padding: 20px;
            border-radius: 2px;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        /* SEÇÃO SEMELHANTES - */
        .secao-semelhantes {
            max-width: 1150px;
            margin: 100px auto;
            padding: 0 20px;
        }

        .titulo-semelhantes {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 50px;
            color: #111;
            font-weight: 500;
        }

        /* Ajuste dos textos dos cards abaixo da foto no PC */
        .card-prata h3 {
            font-size: 1.1rem !important;
            margin: 15px 0 8px !important;
            font-weight: 500 !important;
        }

        .card-prata .preco {
            font-size: 1.2rem !important;
            color: #222 !important;
            font-weight: 700 !important;
            display: block !important;
            margin-bottom: 15px !important;
        }

        .card-prata .btn-comprar {
            font-size: 0.9rem !important;
            padding: 12px !important;
            background: #333 !important;
            letter-spacing: 1px !important;
            text-transform: uppercase !important;
        }

        @media (max-width: 768px) {
            .container-detalhe {
                flex-direction: row !important;
                align-items: center !important;
                gap: 15px !important;
                padding: 15px !important;
            }

            .produto-imagem-foco {
                flex: 1.2 !important;
                max-width: 50% !important;
            }

            .produto-info {
                flex: 1 !important;
                text-align: left !important;
            }

            h1 {
                font-size: 0.95rem !important;
            }

            .preco-destaque {
                font-size: 0.95rem !important;
            }

            .descricao {
                font-size: 0.65rem !important;
                margin-bottom: 12px !important;
            }

            .btn-whatsapp {
                padding: 10px !important;
                font-size: 0.6rem !important;
            }

            .titulo-semelhantes {
                font-size: 1.1rem !important;
                margin-bottom: 25px !important;
            }

            /* Mantendo o seu grid/carrossel original do celular */
            .grid-produtos {
                display: flex !important;
                overflow-x: auto !important;
                gap: 10px !important;
            }

            .card-prata {
                flex: 0 0 44% !important;
                min-width: 44% !important;
            }

            .card-prata h3 {
                font-size: 0.7rem !important;
            }

            .card-prata .preco {
                font-size: 0.8rem !important;
            }

            .card-prata .btn-comprar {
                font-size: 0.7rem !important;
                padding: 6px !important;
            }
        }
    </style>

</head>

<body>

    <div class="voltar-container">
        <a href="index.php" class="voltar-link">
            <i class="fas fa-long-arrow-alt-left"></i> voltar para a vitrine
        </a>
    </div>

    <main class="container-detalhe">
        <div class="produto-imagem-foco">
            <img src="img/<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
        </div>

        <div class="produto-info">
            <span class="material-tag">Prata 925 Legítima</span>
            <h1><?php echo $produto['nome']; ?></h1>
            <div class="preco-destaque">R$ <?php echo $precoFormatado; ?></div>

            <p class="descricao">
                <?php
                echo !empty($produto['descrição']) ? $produto['descrição'] : "Joia em Prata 925 com acabamento premium, brilho eterno e garantia de autenticidade.";
                ?>
            </p>

            <a href="<?php echo $linkFinal; ?>" target="_blank" class="btn-whatsapp">
                <i class="fab fa-whatsapp"></i> ENCOMENDAR NO WHATSAPP
            </a>
        </div>
    </main>

    <section class="secao-semelhantes">
        <h2 class="titulo-semelhantes">você também pode gostar</h2>
        <div class="grid-produtos">
            <?php
            $tipo_atual = $produto['tipo'];
            // Busca 4 itens do mesmo tipo, pulando o que já está na tela
            $q_sem = "SELECT * FROM produtos WHERE tipo = '$tipo_atual' AND id != '$id' LIMIT 4";
            $res_sem = mysqli_query($conn, $q_sem);

            if ($res_sem && mysqli_num_rows($res_sem) > 0):
                while ($sem = mysqli_fetch_assoc($res_sem)):
                    $precoSem = number_format($sem['preco'], 2, ',', '.');
            ?>
                    <div class="card-prata">
                        <div class="img-container">
                            <img src="img/<?php echo $sem['imagem']; ?>" alt="<?php echo $sem['nome']; ?>">
                        </div>
                        <h3 style="font-weight: 400; font-size: 10px;"><?php echo $sem['nome']; ?></h3>
                        <span class="preco" style="font-size: 12px;">R$ <?php echo $precoSem; ?></span>
                        <a href="produto-detalhes.php?id=<?php echo $sem['id']; ?>" class="btn-comprar" style="font-size: 9px; padding: 5px;">ver joia</a>
                    </div>
            <?php endwhile;
            endif; ?>
        </div>
    </section>

</body>

</html>