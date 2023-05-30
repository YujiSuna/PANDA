-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jun-2022 às 16:50
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_panda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id_avaliacao` int(11) NOT NULL,
  `fk_id_destino` int(11) NOT NULL,
  `fk_id_professor` int(11) NOT NULL,
  `name_avaliacao` text NOT NULL,
  `detalhe` text NOT NULL,
  `data_criada` datetime NOT NULL DEFAULT current_timestamp(),
  `data_marcada` datetime NOT NULL DEFAULT current_timestamp(),
  `tipo` int(1) NOT NULL COMMENT '1:turma\r\n2:individual',
  `situation` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id_avaliacao`, `fk_id_destino`, `fk_id_professor`, `name_avaliacao`, `detalhe`, `data_criada`, `data_marcada`, `tipo`, `situation`) VALUES
(1, 1, 3, 'Avaliacao 1', 'Testando Avaliacao 1', '2022-04-27 10:20:18', '2022-04-07 10:20:18', 1, 1),
(2, 4, 6, 'Avaliacao 2', 'Testando Avaliacao 2', '2022-04-27 10:20:18', '2022-05-27 10:20:18', 2, 1),
(3, 2, 9, 'Avaliacao 3', 'Testando Avaliacao 3', '2022-04-27 10:20:18', '2022-06-17 10:20:18', 1, 1),
(4, 7, 3, 'Avaliacao 4', 'Testando Avaliacao 4', '2022-04-27 10:20:18', '2022-04-30 10:20:18', 2, 1),
(5, 3, 6, 'Avaliacao 5', 'Testando Avaliacao 5', '2022-04-27 10:20:18', '2022-05-20 10:20:18', 1, 1),
(6, 10, 9, 'Avaliacao 6', 'Testando Avaliacao 6', '2022-04-27 10:20:18', '2022-06-27 10:20:18', 2, 1),
(17, 0, 3, 'Avaliação 5', 'Avaliação do Alan', '2022-06-08 16:50:38', '2022-06-16 00:00:00', 1, 1),
(18, 0, 3, 'Avaliação 5', 'Avaliação do Alan', '2022-06-08 16:50:38', '2022-06-16 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes_logs`
--

CREATE TABLE `avaliacoes_logs` (
  `id_avaliacao_log` int(11) NOT NULL,
  `fk_id_avaliacao` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `aprovado` int(11) NOT NULL,
  `falta` int(11) NOT NULL,
  `data_modificada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `avaliacoes_logs`
--

INSERT INTO `avaliacoes_logs` (`id_avaliacao_log`, `fk_id_avaliacao`, `fk_id_user`, `aprovado`, `falta`, `data_modificada`) VALUES
(1, 1, 1, 0, 1, 20220518);

-- --------------------------------------------------------

--
-- Estrutura da tabela `presenca`
--

CREATE TABLE `presenca` (
  `id_presenca` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `fk_id_turma` int(11) NOT NULL DEFAULT 1,
  `date` date NOT NULL,
  `presenca` int(11) NOT NULL DEFAULT 0 COMMENT '0-falta 1-presente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `presenca`
--

INSERT INTO `presenca` (`id_presenca`, `fk_id_user`, `fk_id_turma`, `date`, `presenca`) VALUES
(1, 4, 1, '2021-12-13', 0),
(2, 10, 1, '2021-12-13', 0),
(3, 7, 1, '2021-12-13', 0),
(4, 4, 1, '2022-05-18', 1),
(5, 4, 1, '2022-05-17', 0),
(6, 4, 8, '2022-05-22', 0),
(7, 7, 8, '2022-05-22', 0),
(8, 10, 8, '2022-05-22', 0),
(9, 4, 1, '2022-05-28', 0),
(10, 4, 1, '2022-05-29', 0),
(11, 4, 1, '2022-06-04', 0),
(12, 4, 1, '2022-06-14', 0),
(13, 4, 1, '2022-06-08', 1),
(14, 7, 1, '2022-06-08', 1),
(15, 4, 1, '2022-06-20', 0),
(16, 7, 1, '2022-06-20', 0),
(17, 4, 1, '2022-06-22', 0),
(18, 7, 1, '2022-06-22', 0),
(19, 10, 1, '2022-06-08', 1),
(20, 7, 1, '2022-06-14', 0),
(21, 10, 1, '2022-06-14', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recados`
--

CREATE TABLE `recados` (
  `id_recado` int(11) NOT NULL,
  `fk_id_professor` int(11) NOT NULL,
  `name_recado` varchar(50) NOT NULL,
  `mensagem` text NOT NULL,
  `tipo` int(1) NOT NULL,
  `data_criada` datetime NOT NULL DEFAULT current_timestamp(),
  `data_marcada` datetime DEFAULT NULL,
  `situation` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recados`
--

INSERT INTO `recados` (`id_recado`, `fk_id_professor`, `name_recado`, `mensagem`, `tipo`, `data_criada`, `data_marcada`, `situation`) VALUES
(1, 3, 'Sobre a aula do dia 23/09/2022', 'Para próxima aula, tragam a autorização dos responsáveis. Será necessário para participação da atividade extra.', 1, '2021-05-04 04:05:51', '2021-09-23 00:00:00', 1),
(2, 6, 'Feriado de Páscoa', 'Próxima semana não teremos aula. Feliz Páscoa!', 1, '2022-01-12 04:06:08', '2022-02-19 00:00:00', 1),
(3, 9, 'Sobre a comemoração', 'Boa tarde responsáveis, nós junto com os alunos decidimos realizar uma celebração da promoção', 1, '2022-03-20 04:06:17', '2022-03-25 00:00:00', 1),
(4, 0, '', '', 0, '2022-06-08 15:48:23', '0000-00-00 00:00:00', 1),
(5, 0, '', '', 0, '2022-06-08 15:48:23', '0000-00-00 00:00:00', 1),
(6, 0, '', '', 0, '2022-06-08 15:48:23', '0000-00-00 00:00:00', 1),
(7, 0, '', '', 0, '2022-06-08 15:48:23', '0000-00-00 00:00:00', 1),
(8, 3, 'Recado sobre próximas aulas', 'Não terá aula', 1, '2022-06-08 16:49:49', '2022-06-15 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id_turma` int(11) NOT NULL,
  `fk_id_professor` int(11) NOT NULL,
  `name_turma` text NOT NULL,
  `imagem_turma` text DEFAULT NULL,
  `detalhe` text DEFAULT NULL,
  `situation` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `fk_id_professor`, `name_turma`, `imagem_turma`, `detalhe`, `situation`) VALUES
(1, 3, 'Turma 1', 'xxx.png', 'Segunda e Quarta 13h-16h', 1),
(3, 6, 'Turma 2', 'xxx.png', 'Terça e Quinta 9h-12h', 1),
(8, 9, 'Turma 3', NULL, 'Sábado 13h-19h', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_alunos`
--

CREATE TABLE `turma_alunos` (
  `id_aluno_t` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `fk_id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma_alunos`
--

INSERT INTO `turma_alunos` (`id_aluno_t`, `fk_id_user`, `fk_id_turma`) VALUES
(40, 4, 1),
(41, 7, 1),
(43, 4, 3),
(44, 10, 3),
(46, 10, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `birthday` text NOT NULL,
  `gender` varchar(1) NOT NULL COMMENT 'M (masculino)\r\nF (feminino)\r\nN (nao especificar)',
  `phone` varchar(11) NOT NULL,
  `nivel` int(1) NOT NULL COMMENT '0-admin\r\n1-professor\r\n2-aluno',
  `situation` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id_user`, `name`, `surname`, `email`, `password`, `birthday`, `gender`, `phone`, `nivel`, `situation`) VALUES
(2, 'Admin', '1', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '15/01/2001', 'f', '67991356155', 0, 1),
(3, 'Ademar', 'Santana', 'professor@gmail.com', '202cb962ac59075b964b07152d234b70', '10/10/2010', 'm', '67991356155', 1, 1),
(4, 'Alan', 'Silva', 'aluno1@gmail.com', '202cb962ac59075b964b07152d234b70', '17/02/2008', 'm', '67991356155', 2, 1),
(6, 'Bruno', 'Mars', 'professor@gmail.com', '202cb962ac59075b964b07152d234b70', '11/04/2003', 'm', '67991356155', 1, 1),
(7, 'Brenda', 'Alves', 'aluno2@gmail.com', '202cb962ac59075b964b07152d234b70', '05/03/2007', 'f', '67991356155', 2, 1),
(9, 'Carla', 'Cida', 'professor@gmail.com', '202cb962ac59075b964b07152d234b70', '13/06/2005', 'f', '67991356155', 1, 1),
(10, 'Caique', 'Rocha', 'aluno3@gmail.com', '202cb962ac59075b964b07152d234b70', '25/11/2009', 'm', '67991356155', 2, 1),
(14, 'Mario', 'Andrade', 'aluno4@gmail.com', '202cb962ac59075b964b07152d234b70', '22 / 09 / 2006', 'm', '(67) 99135 ', 0, 1),
(15, 'Maria', 'Borges', 'aluno5@gmail.com', '202cb962ac59075b964b07152d234b70', '29 / 08 / 2009', 'f', '(67) 99135 ', 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id_avaliacao`);

--
-- Índices para tabela `avaliacoes_logs`
--
ALTER TABLE `avaliacoes_logs`
  ADD PRIMARY KEY (`id_avaliacao_log`);

--
-- Índices para tabela `presenca`
--
ALTER TABLE `presenca`
  ADD PRIMARY KEY (`id_presenca`);

--
-- Índices para tabela `recados`
--
ALTER TABLE `recados`
  ADD PRIMARY KEY (`id_recado`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id_turma`);

--
-- Índices para tabela `turma_alunos`
--
ALTER TABLE `turma_alunos`
  ADD PRIMARY KEY (`id_aluno_t`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `avaliacoes_logs`
--
ALTER TABLE `avaliacoes_logs`
  MODIFY `id_avaliacao_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `presenca`
--
ALTER TABLE `presenca`
  MODIFY `id_presenca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `recados`
--
ALTER TABLE `recados`
  MODIFY `id_recado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `turma_alunos`
--
ALTER TABLE `turma_alunos`
  MODIFY `id_aluno_t` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
