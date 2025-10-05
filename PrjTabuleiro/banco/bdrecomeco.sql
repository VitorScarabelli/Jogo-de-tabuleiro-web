-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/09/2025 às 19:54
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
-- Banco de dados: `bdrecomeco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbevento`
--

CREATE TABLE `tbevento` (
  `idEvento` int(11) NOT NULL,
  `nomeEvento` varchar(50) NOT NULL,
  `descricaoEvento` varchar(255) NOT NULL,
  `modificadorEvento` varchar(120) NOT NULL,
  `dificuldadeEvento` varchar(10) NOT NULL,
  `impactoEvento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbevento`
--

INSERT INTO `tbevento` (`idEvento`, `nomeEvento`, `descricaoEvento`, `modificadorEvento`, `dificuldadeEvento`, `impactoEvento`) VALUES
(1, 'Visita técnica', 'Sua sala saiu para um evento onde vocês vão aprender sobre coias diferentes do habitual', 'anda mais 2 casas', 'facil', 'bom'),
(2, 'Falta de luz', 'Você esava no meio de uma sessão de estudos e a luz caiu completamente!', 'volte 2 casas', 'fácil', 'ruim'),
(3, 'enchente', 'Acabou chovendo muito e sua casa acabou ficando alagada após uma enchente', 'perde 1 turno', 'medio', 'ruim'),
(4, 'Promoção de materiais escolares', 'Você acabou se deparando com uma promoção de materiais escolares em um apapelaria e conseguiu comprar coisas novas para te ajudar a estudar!', 'avance 3 casas', 'facil', 'bom'),
(5, 'Ajuda do chefe', 'Seu chefe pagou seu almoço hoje e você não terá que gastar o pouco que você tem.', 'Avance 2 casas.', 'fácil', 'bom'),
(6, 'Carona', 'Seu colega de trabalho/escola te deu uma carona hoje, e você não terá que gastar dinheiro com condução.', 'Avance 2 casas.', 'fácil', 'bom'),
(7, 'Aniversário', 'Hoje é seu aniversário e você recebeu uma mini festa surpresa (bolo e salgados) de alguns amigos seus.', 'Avance 2 casas.', 'fácil', 'bom'),
(8, 'Atendimento rápido', 'Você estava no médico e por sorte seu atendimento foi rápido.', 'Avance 2 casas.', 'fácil', 'bom'),
(9, 'Materiais', 'Seu vizinho ia jogar fora os materiais dele do ano passado, e você como estava precisando, pediu a ele, e ele te deu.', 'Avance 2 casas.', 'fácil', 'bom'),
(10, 'Bolsa Família/Pé de Meia', 'Você sacou o seu Bolsa Família/Pé de Meia.', 'Avance 4 casas.', 'médio', 'bom'),
(11, 'Cesta básica', 'Você recebeu uma cesta básica de um familiar seu.', 'Avance 4 casas.', 'médio', 'bom'),
(12, 'Aumento', 'Seu chefe te deu um aumento de 20% no salário.', 'Avance 4 casas.', 'médio', 'bom'),
(13, 'Dinheiro na rua', 'Você achou uma nota de 100 reais na rua do centro.', 'Avance 4 casas.', 'médio', 'bom'),
(14, 'Comoção', 'Um amigo seu ficou comovido ao ver você sofrendo preconceitos e resolveu te ajudar a passar por isso.', 'Avance 4 casas.', 'médio', 'bom'),
(15, 'Promoção', 'O seu chefe te deu uma boa promoção, com um bom aumento incluído.', 'Avance 6 casas.', 'difícil', 'bom'),
(16, 'Roupas novas', 'Ganhou roupas novas em um bazar social e não precisará gastar com isso por um bom tempo.', 'Avance 6 casas.', 'difícil', 'bom'),
(17, 'Celular novo', 'Seu melhor amigo estava pra trocar de celular e te deu o antigo dele.', 'Avance 6 casas.', 'difícil', 'bom'),
(18, 'Quitação de dívidas', 'Um familiar seu quitou boa parte de suas dívidas como forma de apoio e agradecimento.', 'Avance 6 casas.', 'difícil', 'bom'),
(19, 'Bicicleta', 'Você ganhou uma bicicleta de presente de um amigo seu, e agora pode se locomover sem gastar com condução.', 'Avance 6 casas.', 'difícil', 'bom'),
(20, 'Emprego', 'Conseguiu um emprego em uma cidade de classe alta em outra cidade com moradia e alimentação incluídos.', 'Avance 8 casas.', 'extremo', 'bom'),
(21, 'Ganhou um processo', 'Ganhou um processo por danos morais e recebeu uma indenização muito alta.', 'Avance 8 casas.', 'extremo', 'bom'),
(22, 'Estudo Completo', 'No dia do seu aniversário, um familiar decidiu pagar todos os seus estudos até o fim da faculdade.', 'Avance 8 casas.', 'extremo', 'bom'),
(23, 'Casa popular', 'Foi sorteado para receber uma casa popular mobiliada, pronta para morar.', 'Avance 8 casas.', 'extremo', 'bom'),
(24, 'Ganhou na loteria', 'Você ganhou na loteria!!!', 'Avance 8 casas.', 'extremo', 'bom'),
(25, 'Cachorro fugiu', 'Seu cachorro fugiu e você precisou procurar.', 'Volte 2 casas.', 'fácil', 'ruim'),
(26, 'Perdeu o ônibus', 'Não pegou o ônibus por que ficou sem dinheiro pra passagem.', 'Volte 2 casas.', 'fácil', 'ruim'),
(27, 'Perdeu as chaves', 'Perdeu as chaves pois saiu com pressa.', 'Volte 2 casas.', 'fácil', 'ruim'),
(28, 'Ficou doente', 'Ficou doente pois não seguiu as normas de higiene básica.', 'Volte 2 casas.', 'fácil', 'ruim'),
(29, 'Falta de energia', 'O seu despertador não tocou pois a energia da sua casa acabou e o celular descarregou.', 'Volte 2 casas.', 'fácil', 'ruim'),
(30, 'Trabalho da escola', 'Você teve que voltar pra casa e terminar um trabalho da escola, faltando ao trabalho.', 'Volte 4 casas.', 'médio', 'ruim'),
(31, 'Recusado no emprego', 'Você foi recusado em uma entrevista de emprego.', 'Volte 4 casas.', 'médio', 'ruim'),
(32, 'Ameaças na escola', 'Recebeu ameaças na escola e precisou faltar alguns dias.', 'Volte 4 casas.', 'médio', 'ruim'),
(33, 'Ficou endividado', 'Você ficou endividado e agora precisa juntar dinheiro.', 'Volte 4 casas.', 'médio', 'ruim'),
(34, 'Empréstimo não devolvido', 'Você emprestou dinheiro e não recebeu de volta.', 'Volte 4 casas.', 'médio', 'ruim'),
(35, 'Celular quebrou', 'Você esbarrou em alguém, o celular caiu no chão e quebrou.', 'Volte 6 casas.', 'difícil', 'ruim'),
(36, 'Recuperação', 'Você reprovou em uma matéria e ficou de recuperação.', 'Volte 6 casas.', 'difícil', 'ruim'),
(37, 'Atraso de dívida', 'Você atrasou a conta de luz e ficou alguns dias sem energia.', 'Volte 6 casas.', 'difícil', 'ruim'),
(38, 'Hora extra', 'Teve que fazer hora extra no trabalho e perdeu a prova na escola.', 'Volte 6 casas.', 'difícil', 'ruim'),
(39, 'Carteira roubada', 'Sua carteira foi roubada no ônibus com documentos e dinheiro.', 'Volte 6 casas.', 'difícil', 'ruim'),
(40, 'Demissão', 'Seu chefe te demitiu injustamente por causa de um problema causado por outro funcionário.', 'Volte 8 casas.', 'extremo', 'ruim'),
(41, 'Incêndio', 'Houve um incêndio na sua casa por causa da fiação elétrica antiga.', 'Volte 8 casas.', 'extremo', 'ruim'),
(42, 'Acidente', 'Você sofreu um acidente gravíssimo no trabalho e foi hospitalizado.', 'Volte 8 casas.', 'extremo', 'ruim'),
(43, 'Preconceito Forte', 'Enquanto andava na rua, você sofreu preconceito pesado, com danos físicos e mentais.', 'Volte 8 casas.', 'extremo', 'ruim'),
(44, 'Enchente', 'Sua casa em área de risco foi alagada e você perdeu a maioria dos seus pertences.', 'Volte 8 casas.', 'extremo', 'ruim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpersonagens`
--

CREATE TABLE `tbpersonagens` (
  `idPersonagem` int(11) NOT NULL,
  `nomePersonagem` varchar(100) NOT NULL,
  `vantagem1Personagem` varchar(255) NOT NULL,
  `vantagem2Personagem` varchar(255) NOT NULL,
  `desvatagem1Personagem` varchar(255) NOT NULL,
  `desvatagem2Personagem` varchar(255) NOT NULL,
  `descricaoPersonagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbpersonagens`
--

INSERT INTO `tbpersonagens` (`idPersonagem`, `nomePersonagem`, `vantagem1Personagem`, `vantagem2Personagem`, `desvatagem1Personagem`, `desvatagem2Personagem`, `descricaoPersonagem`) VALUES
(1, 'Pessoa idosa', 'INSS: Ao cair em uma casa \"Dificuldade financeira\" rode apenas um dado para voltar as casas', 'Preferencial: Roda um dado quando cair na casa especial \"Transporte público\" e avance a quantidade de casas', 'Ingênuo: Quando cair na casa especial \"golpe\", você perde uma rodada', 'Saúde frágil: Quando cair em uma casa especial de \"esforço extra\", gire um dado e volte as casas.', 'Uma pessoa que já viveu bastante, já se aposentou mas ainda acredita que o mundo pode ser um lugar melhor, tendo muita experiência de vida.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `emailUsuario` varchar(255) NOT NULL,
  `senhaUsuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`) VALUES
(1, 'mateus', 'mateus@gmail.com', 'senhafoda123'),
(2, 'vitor', 'vitor@gmail.com', '12345');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbpersonagens`
--
ALTER TABLE `tbpersonagens`
  ADD PRIMARY KEY (`idPersonagem`);

--
-- Índices de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbpersonagens`
--
ALTER TABLE `tbpersonagens`
  MODIFY `idPersonagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
