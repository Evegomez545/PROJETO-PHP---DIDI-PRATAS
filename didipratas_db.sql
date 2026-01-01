-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/01/2026 às 19:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `didipratas_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `estilo` varchar(50) NOT NULL,
  `mais-vendidos` varchar(3) NOT NULL,
  `lançamentos` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `estoque`, `imagem`, `descricao`, `tipo`, `estilo`, `mais-vendidos`, `lançamentos`) VALUES
(3, 'Tendência em jóias para seu final de ano', 0.00, 5, 'lancamento1.jpg', 'Uma joia exclusiva pensada para brilhar nas suas festas de fim de ano. Prata 925 com acabamento de luxo', 'Anéis', 'Nenhum Estilo Especifico', 'nao', 'sim'),
(4, 'Proteção em cada passo para todos os dias', 0.00, 8, 'lancamento2.jpg', 'Uma joia religiosa especial para trazer proteção e brilho ao seu dia a dia em Prata 925', 'Cordões e colares', 'Religiosos', 'nao', 'sim'),
(5, 'Lançamento do verão onde o sol encontra a moda', 0.00, -1, 'lancamento3.jpg', 'Uma joia solar e vibrante da nossa coleção de verão, feita em Prata 925 para brilhar em todos os momentos', 'Brincos', 'Nenhum Estilo Especifico', 'nao', 'sim'),
(6, 'Colar Nó de Prata Ajustável', 0.00, 10, 'lancamento4.jpg', 'A união perfeita entre a rusticidade do cordão preto e o brilho refinado dos detalhes. Com design versátil, este colar se adapta desde um visual casual com t-shirt até uma produção mais elaborada. Uma peça atemporal que não pode faltar no seu porta-joias', 'Cordões e colares', 'Nenhum Estilo Especifico', 'nao', 'sim'),
(7, 'Colar Beija-Flor Astral', 0.00, -1, 'colar-passaro.jpg', 'Um colar delicado em Prata 925 com pingente de beija-flor, simbolizando leveza e boas energias', 'Cordões e colares', 'Nenhum Estilo Especifico', 'sim', 'nao'),
(8, 'Combo Anéis Moeda Antiga', 0.00, 10, 'aneis.jpg', 'Lindo combo de anéis em moeda antiga com brilho eterno e alta durabilidade', 'Anéis', 'Nenhum Estilo Especifico', 'sim', 'nao'),
(9, 'Argolas Geométricas e Elegantes', 0.00, 10, 'argola.jpg', 'Argolas em Prata 925 com design geométrico moderno, perfeitas para um visual sofisticado e leve', 'Brincos', 'Minimalistas', 'sim', 'nao'),
(10, 'Anel Triplo Fios Lisos em Prata', 0.00, 10, 'aneis-prata.jpg', 'Anel triplo com fios lisos em Prata 925. Um design moderno e sofisticado que preenche o dedo com elegância e brilho legítimo', 'Anéis', 'Geral', 'nao', 'nao'),
(11, 'Mix de Anéis Astral', 0.00, 10, 'Mix-Anéis-Astral.jpg', 'Um conjunto celestial em Prata 925. O Mix Astral combina diferentes texturas e símbolos para um visual místico e cheio de personalidade', 'Anéis', 'Geral', 'nao', 'nao'),
(12, 'Anéis Geométricos e Reguláveis', 0.00, 10, 'Aneis-geométricos-reguláveis.jpg', 'Anéis modernos com design geométrico em Prata 925. Por serem reguláveis, oferecem o ajuste perfeito e muito conforto para qualquer ocasião', 'Anéis', 'Geral', 'nao', 'nao'),
(13, 'Pulseira Riviera Zircônias Prata', 0.00, 10, 'pulseira.jpg', 'Pulseira modelo Riviera em Prata 925 legítima, cravejada com zircônias de alto brilho. Um clássico da joalheria que traz sofisticação e elegância para qualquer ocasião', 'Pulseiras', 'Geral', 'nao', 'nao'),
(14, 'Mix de Pulseiras Proteção e Fé', 0.00, 10, 'pulseira2.jpg', 'Um conjunto poderoso que une estilo e espiritualidade. Este mix em Prata 925 traz símbolos de proteção e fé para te acompanhar com brilho e significado em todos os momentos', 'Pulseiras', 'Religiosos', 'nao', 'nao'),
(15, 'Pulseira Veneziana Cristal Gota Sky', 0.00, 10, 'pulseira3.jpg', 'Pulseira em malha Veneziana de Prata 925 com um deslumbrante cristal em formato de gota na cor Sky. Uma peça delicada que traz um ponto de cor e sofisticação ao seu pulso.', 'Pulseiras', 'Cristais', 'nao', 'nao'),
(16, 'Colar Patuá Búzios Naturais', 0.00, 10, 'colar.jpg', 'Colar estilo Patuá em Prata 925 com búzios naturais selecionados. Uma peça com energia praiana e acabamento impecável, perfeita para compor mixes de colares', 'Cordões e colares', 'Geral', 'nao', 'nao'),
(17, 'Colar Amuleto Olho Grego', 0.00, 10, 'colar-olho.jpg', 'Um poderoso amuleto em Prata 925 legítima. Este colar une a proteção do olho grego com um design minimalista e elegante, ideal para uso diário ou para presentear alguém especial', 'Cordões e colares', 'Religiosos', 'nao', 'nao'),
(18, 'Choker lacraia 35+5cm', 0.00, 10, 'Choker-lacraia35+5cm..jpg', 'Choker modelo lacraia em Prata 925 legítima. Com 35cm de comprimento e extensor de 5cm para o ajuste perfeito, é uma peça que brilha intensamente e destaca o colo com elegância', 'Cordões e colares', 'Geral', 'nao', 'nao'),
(19, 'Brinco Argola Geométrica Triângulo', 0.00, 10, 'brincos.jpg', 'Brincos em formato de argola geométrica triangular em Prata 925 legítima. Um design moderno e minimalista que traz um toque contemporâneo e sofisticado para qualquer look', 'Brincos', 'Geral', 'nao', 'nao'),
(20, 'Brincos Prata Clássicos e Atemporais', 0.00, 10, 'brincos1.jpg', 'Brincos essenciais em Prata 925 legítima. Com design limpo e brilho eterno, são peças versáteis que combinam com qualquer estilo, do casual ao elegante, sendo indispensáveis no seu porta-joias', 'Brincos', 'Geral', 'nao', 'nao'),
(21, 'Brincos Pratas Geometria de Proteção', 0.00, 10, 'brinco2.jpg', 'Brincos em Prata 925 com design geométrico exclusivo. Uma peça que une o simbolismo da proteção com a modernidade das formas, criando um acessório marcante e cheio de significado para o seu dia a dia', 'Brincos', 'Religiosos', 'nao', 'nao'),
(22, 'Tornozeleira Dupla Snake & Chevron', 0.00, 10, 'tornozeleira1.jpg', 'O mix perfeito entre a fluidez da malha snake e o design moderno da corrente chevron. Uma peça dupla em prata 925 que garante movimento e brilho máximo a cada passo.', 'Tornozeleiras', 'Geral', 'nao', 'nao'),
(23, 'Tornozeleira Amuleto Faith (Fé)', 0.00, 10, 'tornozeleira2.jpg', 'Delicadeza que inspira confiança. Uma peça atemporal com garantia de autenticidade, ideal para compor seu mix de joias ou brilhar sozinha com sua mensagem de fé.', 'Tornozeleiras', 'Religiosos', 'nao', 'nao'),
(24, 'Tornozeleira Marítima Aqua & Medalhas', 0.00, 11, 'tornozeleira3.jpg', 'Estilo praiano com a sofisticação da prata legítima. As medalhas garantem um balanço charmoso, enquanto o acabamento premium mantém o brilho eterno mesmo sob o sol.', 'Tornozeleiras', 'Nenhum Estilo Especifico', 'nao', 'nao'),
(25, 'Tornozeleira Elo Celestial', 0.00, 10, 'tornozeleira4.jpg', 'Eleve seu estilo com a Tornozeleira Cascata. Um mix delicado de correntes em prata com pontos de luz que garantem um brilho sofisticado e um movimento encantador a cada passo', 'Tornozeleiras', 'Nenhum', 'nao', 'nao'),
(26, 'Pulseira 7 chakras', 0.00, 10, 'pulseira4.jpg', 'Os sete Chakras podem proporcionar um estado físico, mental e emocional de equilíbrio perfeito e tem uma função muito útil para para nossa evolução em direção à harmonia interior. Chakras está associado a diferentes sentimentos, emoções, desejos ou medos.', 'pulseiras', 'Pedrarias', 'nao', 'nao'),
(27, 'Anéis Astrais em Prata', 0.00, 10, 'aneisfinos.jpg', 'A união perfeita entre pulseira e anel em uma peça só. Com design inspirado no misticismo e detalhes de lua, esta joia em prata legítima envolve a mão com delicadeza e estilo. Um acessório marcante para quem busca um visual autêntico e cheio de significado.', 'Aneis', 'Minimalistas', 'sim', 'nao');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
