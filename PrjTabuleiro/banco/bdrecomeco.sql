-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/09/2025 às 03:32
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
(4, 'Promoção de materiais escolares', 'Você acabou se deparando com uma promoção de materiais escolares em um apapelaria e conseguiu comprar coisas novas para te ajudar a estudar!', 'avance 3 casas', 'facil', 'bom');

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
-- Índices de tabela `tbevento`
--
ALTER TABLE `tbevento`
  ADD PRIMARY KEY (`idEvento`);

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
-- AUTO_INCREMENT de tabela `tbevento`
--
ALTER TABLE `tbevento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
