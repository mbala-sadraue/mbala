-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Abr-2021 às 23:15
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controlescola`
--
CREATE DATABASE IF NOT EXISTS `controlescola` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `controlescola`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admina`
--

CREATE TABLE `admina` (
  `idAdminA` int(11) NOT NULL,
  `Login_idLogin` int(11) DEFAULT NULL,
  `pessoa_idPessoa` int(11) NOT NULL,
  `admina_Ativo` enum('1','0') NOT NULL DEFAULT '1',
  `idDeparta` int(11) NOT NULL,
  `adming_idAdminG` int(11) NOT NULL,
  `NomeImagem` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adming`
--

CREATE TABLE `adming` (
  `idAdminG` int(11) NOT NULL,
  `pessoa_idPessoa` int(11) NOT NULL,
  `login_idLogin` int(11) DEFAULT NULL,
  `NomeImagem` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adming`
--

INSERT INTO `adming` (`idAdminG`, `pessoa_idPessoa`, `login_idLogin`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idAluno` int(11) NOT NULL,
  `pessoa_idPessoa` int(11) NOT NULL,
  `curso_idCurso` int(11) NOT NULL,
  `usuario_udUsuario` int(11) NOT NULL,
  `login_idLogin` int(11) DEFAULT NULL,
  `idDeparta` int(11) NOT NULL,
  `dataRegistro` int(11) NOT NULL,
  `encarregado_id` int(11) NOT NULL,
  `Aluno_Ativo` enum('0','1') NOT NULL DEFAULT '1',
  `NomeImagem` varchar(200) DEFAULT NULL,
  `aluno_idAnoEscolar` int(11) NOT NULL,
  `aluno_idTurma` int(11) NOT NULL,
  `anoletivo_idAno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anoletivo`
--

CREATE TABLE `anoletivo` (
  `idAnoLetivo` int(11) NOT NULL,
  `AnoLetivo` year(4) DEFAULT NULL,
  `DataRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anosescolares`
--

CREATE TABLE `anosescolares` (
  `idAnosEscolares` int(11) NOT NULL,
  `NomeAnoEscolar` varchar(100) NOT NULL,
  `Ciclo` varchar(100) NOT NULL,
  `escolarAtivo` enum('1','0') NOT NULL DEFAULT '1',
  `letivo_idAno_letivo` int(11) NOT NULL,
  `Departa_idDeparta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ano_letivo`
--

CREATE TABLE `ano_letivo` (
  `idAno_letivo` int(11) NOT NULL,
  `NomeAnoletivo` varchar(50) NOT NULL,
  `AnoAtivo` enum('1','0') NOT NULL DEFAULT '1',
  `AnoDataRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ano_letivo`
--

INSERT INTO `ano_letivo` (`idAno_letivo`, `NomeAnoletivo`, `AnoAtivo`, `AnoDataRegistro`) VALUES
(1, '2020/2021', '1', '2021-04-16 20:57:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `idContato` int(11) NOT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `pessoa_idPessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`idContato`, `Telefone`, `Email`, `pessoa_idPessoa`) VALUES
(1, '942494250', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `NomeCurso` varchar(150) NOT NULL,
  `Ativo` enum('0','1') NOT NULL DEFAULT '1',
  `curso_idDeparta` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `AnoLetivo_idAno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `idDeparta` int(11) NOT NULL,
  `NomeDeparta` varchar(100) NOT NULL,
  `departa_Ativo` enum('1','0') NOT NULL DEFAULT '1',
  `idAdminG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(11) NOT NULL,
  `NomeDisciplina` varchar(100) NOT NULL,
  `Ativo` enum('1','0') NOT NULL DEFAULT '1',
  `curso_idCurso` int(11) DEFAULT NULL,
  `profe_idProfessor` int(11) DEFAULT NULL,
  `AnoLetivo_idAno` int(11) NOT NULL,
  `anoEscolar_idEscolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_vs_aluno`
--

CREATE TABLE `disciplina_vs_aluno` (
  `idDisciplina` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_vs_curso`
--

CREATE TABLE `disciplina_vs_curso` (
  `idDisciCurso` int(11) NOT NULL,
  `discipliana_idDisciplina` int(11) NOT NULL,
  `curso_idCurso` int(11) NOT NULL,
  `anoEscolar_idEscolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `idEncarregado` int(11) NOT NULL,
  `NomeEncarregado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL,
  `Cidade` varchar(45) DEFAULT NULL,
  `Municipio` varchar(50) NOT NULL,
  `Bairro` varchar(50) DEFAULT NULL,
  `pessoa_idPessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idEndereco`, `Cidade`, `Municipio`, `Bairro`, `pessoa_idPessoa`) VALUES
(1, 'Luanda', 'Belas', 'Kilamba', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `idImagem` int(11) NOT NULL,
  `NomeImagem` varchar(200) DEFAULT NULL,
  `pessoa_idPessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `idLogin` int(11) NOT NULL,
  `Usuario` varchar(75) NOT NULL,
  `Senha` varchar(75) NOT NULL,
  `tipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`idLogin`, `Usuario`, `Senha`, `tipoUsuario`) VALUES
(1, 'Gercilina', '56ee2d4e05342a92adf852482355d2fb8f635e0a', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `idMateria` int(11) NOT NULL,
  `DescriMateria` varchar(1000) NOT NULL,
  `profe_idProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idPessoa` int(11) NOT NULL,
  `NomePessoa` varchar(100) NOT NULL,
  `Sexo` enum('Feminino','Masculino') DEFAULT NULL,
  `Nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idPessoa`, `NomePessoa`, `Sexo`, `Nascimento`) VALUES
(1, 'Gercilina Madeira Bravo', 'Feminino', '1990-10-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `idProfessor` int(11) NOT NULL,
  `pessoa_idPessoa` int(11) NOT NULL,
  `login_idLogin` int(11) DEFAULT NULL,
  `professor_Ativo` enum('1','0') NOT NULL DEFAULT '1',
  `usuario_idUsuario` int(11) NOT NULL,
  `idDeparta` int(11) DEFAULT NULL,
  `NomeImagem` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_vs_aluno`
--

CREATE TABLE `professor_vs_aluno` (
  `aluno_idAluno` int(11) NOT NULL,
  `profe_idProfessor` int(11) NOT NULL,
  `usuario_idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_vs_curso`
--

CREATE TABLE `professor_vs_curso` (
  `id_profe_curso` int(11) NOT NULL,
  `profe_idProfessor` int(11) NOT NULL,
  `curso_idCurso` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Ativo` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretario`
--

CREATE TABLE `secretario` (
  `idSecretario` int(11) NOT NULL,
  `pessoa_idPessoa` int(11) DEFAULT NULL,
  `secretario_Ativo` enum('1','0') NOT NULL DEFAULT '1',
  `Login_idLogin` int(11) DEFAULT NULL,
  `idDeparta` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `NomeImagem` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL,
  `NomeTurma` varchar(50) NOT NULL,
  `Sala` varchar(50) NOT NULL,
  `Diretor` varchar(200) DEFAULT NULL,
  `curso_idCurso` int(11) NOT NULL,
  `Escolar_idAnoEsco` int(11) NOT NULL,
  `Departa_idDeparta` int(11) NOT NULL,
  `ano_letivo_idAno` int(11) NOT NULL,
  `TurmaAtivo` enum('1','0') NOT NULL DEFAULT '1',
  `Vaga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admina`
--
ALTER TABLE `admina`
  ADD PRIMARY KEY (`idAdminA`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`),
  ADD KEY `Login_idLogin` (`Login_idLogin`),
  ADD KEY `idDeparta` (`idDeparta`),
  ADD KEY `adming_idAdminG` (`adming_idAdminG`);

--
-- Indexes for table `adming`
--
ALTER TABLE `adming`
  ADD PRIMARY KEY (`idAdminG`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`),
  ADD KEY `login_idLogin` (`login_idLogin`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idAluno`),
  ADD KEY `login_idLogin` (`login_idLogin`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`),
  ADD KEY `curso_idCuro` (`curso_idCurso`),
  ADD KEY `idDeparta` (`idDeparta`),
  ADD KEY `encarregado_id` (`encarregado_id`),
  ADD KEY `anoletivo_idAno` (`dataRegistro`),
  ADD KEY `aluno_idAnoEscolar` (`aluno_idAnoEscolar`),
  ADD KEY `aluno_idTurma` (`aluno_idTurma`),
  ADD KEY `anoletivo_idAno_2` (`anoletivo_idAno`);

--
-- Indexes for table `anoletivo`
--
ALTER TABLE `anoletivo`
  ADD PRIMARY KEY (`idAnoLetivo`);

--
-- Indexes for table `anosescolares`
--
ALTER TABLE `anosescolares`
  ADD PRIMARY KEY (`idAnosEscolares`),
  ADD KEY `letivo_idAno_letivo` (`letivo_idAno_letivo`),
  ADD KEY `Departa_idDeparta` (`Departa_idDeparta`);

--
-- Indexes for table `ano_letivo`
--
ALTER TABLE `ano_letivo`
  ADD PRIMARY KEY (`idAno_letivo`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`idContato`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `idDeparta` (`curso_idDeparta`),
  ADD KEY `usuario_idUsuario` (`usuario_idUsuario`),
  ADD KEY `AnoLetivo_idAno` (`AnoLetivo_idAno`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDeparta`),
  ADD KEY `idAdminG` (`idAdminG`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`),
  ADD KEY `curso_idCurso` (`curso_idCurso`),
  ADD KEY `profe_idProfessor` (`profe_idProfessor`),
  ADD KEY `AnoLetivo_idAno` (`AnoLetivo_idAno`),
  ADD KEY `anoEscolar_idEscolar` (`anoEscolar_idEscolar`);

--
-- Indexes for table `disciplina_vs_aluno`
--
ALTER TABLE `disciplina_vs_aluno`
  ADD KEY `idAluno` (`idAluno`),
  ADD KEY `idDisciplina` (`idDisciplina`);

--
-- Indexes for table `disciplina_vs_curso`
--
ALTER TABLE `disciplina_vs_curso`
  ADD PRIMARY KEY (`idDisciCurso`),
  ADD KEY `discipliana_idDisciplina` (`discipliana_idDisciplina`),
  ADD KEY `curso_idCurso` (`curso_idCurso`),
  ADD KEY `anoEscolar_idEscolar` (`anoEscolar_idEscolar`);

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`idEncarregado`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`);

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`idImagem`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idLogin`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `profe_idProfessor` (`profe_idProfessor`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idPessoa`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idProfessor`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`),
  ADD KEY `login_idLogin` (`login_idLogin`),
  ADD KEY `usuario_idUsuario` (`usuario_idUsuario`),
  ADD KEY `idDeparta` (`idDeparta`);

--
-- Indexes for table `professor_vs_aluno`
--
ALTER TABLE `professor_vs_aluno`
  ADD KEY `profe_idProfessor` (`profe_idProfessor`),
  ADD KEY `aluno_idAluno` (`aluno_idAluno`),
  ADD KEY `usuario_idUsuario` (`usuario_idUsuario`);

--
-- Indexes for table `professor_vs_curso`
--
ALTER TABLE `professor_vs_curso`
  ADD PRIMARY KEY (`id_profe_curso`),
  ADD KEY `idCurso` (`curso_idCurso`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProfessor` (`profe_idProfessor`);

--
-- Indexes for table `secretario`
--
ALTER TABLE `secretario`
  ADD PRIMARY KEY (`idSecretario`),
  ADD KEY `pessoa_idPessoa` (`pessoa_idPessoa`),
  ADD KEY `Login_idLogin` (`Login_idLogin`),
  ADD KEY `idDeparta` (`idDeparta`),
  ADD KEY `usuario_idUsuario` (`usuario_idUsuario`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`),
  ADD KEY `Escolar_idAnoEsco` (`Escolar_idAnoEsco`),
  ADD KEY `Departa_idDeparta` (`Departa_idDeparta`),
  ADD KEY `curso_idCurso` (`curso_idCurso`),
  ADD KEY `ano_letivo_idAno` (`ano_letivo_idAno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admina`
--
ALTER TABLE `admina`
  MODIFY `idAdminA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adming`
--
ALTER TABLE `adming`
  MODIFY `idAdminG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idAluno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anoletivo`
--
ALTER TABLE `anoletivo`
  MODIFY `idAnoLetivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anosescolares`
--
ALTER TABLE `anosescolares`
  MODIFY `idAnosEscolares` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ano_letivo`
--
ALTER TABLE `ano_letivo`
  MODIFY `idAno_letivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `idContato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDeparta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplina_vs_curso`
--
ALTER TABLE `disciplina_vs_curso`
  MODIFY `idDisciCurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `idEncarregado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `idImagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idPessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `idProfessor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professor_vs_curso`
--
ALTER TABLE `professor_vs_curso`
  MODIFY `id_profe_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secretario`
--
ALTER TABLE `secretario`
  MODIFY `idSecretario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admina`
--
ALTER TABLE `admina`
  ADD CONSTRAINT `admina_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`),
  ADD CONSTRAINT `admina_ibfk_2` FOREIGN KEY (`Login_idLogin`) REFERENCES `login` (`idLogin`),
  ADD CONSTRAINT `admina_ibfk_3` FOREIGN KEY (`idDeparta`) REFERENCES `departamento` (`idDeparta`),
  ADD CONSTRAINT `admina_ibfk_4` FOREIGN KEY (`adming_idAdminG`) REFERENCES `adming` (`idAdminG`);

--
-- Limitadores para a tabela `adming`
--
ALTER TABLE `adming`
  ADD CONSTRAINT `adming_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`),
  ADD CONSTRAINT `adming_ibfk_2` FOREIGN KEY (`login_idLogin`) REFERENCES `login` (`idLogin`);

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_10` FOREIGN KEY (`aluno_idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `aluno_ibfk_11` FOREIGN KEY (`anoletivo_idAno`) REFERENCES `ano_letivo` (`idAno_letivo`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`login_idLogin`) REFERENCES `login` (`idLogin`),
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`),
  ADD CONSTRAINT `aluno_ibfk_4` FOREIGN KEY (`curso_idCurso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `aluno_ibfk_5` FOREIGN KEY (`idDeparta`) REFERENCES `departamento` (`idDeparta`),
  ADD CONSTRAINT `aluno_ibfk_6` FOREIGN KEY (`encarregado_id`) REFERENCES `encarregado` (`idEncarregado`),
  ADD CONSTRAINT `aluno_ibfk_7` FOREIGN KEY (`encarregado_id`) REFERENCES `encarregado` (`idEncarregado`),
  ADD CONSTRAINT `aluno_ibfk_8` FOREIGN KEY (`dataRegistro`) REFERENCES `anoletivo` (`idAnoLetivo`),
  ADD CONSTRAINT `aluno_ibfk_9` FOREIGN KEY (`aluno_idAnoEscolar`) REFERENCES `anosescolares` (`idAnosEscolares`);

--
-- Limitadores para a tabela `anosescolares`
--
ALTER TABLE `anosescolares`
  ADD CONSTRAINT `anosescolares_ibfk_1` FOREIGN KEY (`letivo_idAno_letivo`) REFERENCES `ano_letivo` (`idAno_letivo`),
  ADD CONSTRAINT `anosescolares_ibfk_2` FOREIGN KEY (`Departa_idDeparta`) REFERENCES `departamento` (`idDeparta`);

--
-- Limitadores para a tabela `contato`
--
ALTER TABLE `contato`
  ADD CONSTRAINT `contato_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`);

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`curso_idDeparta`) REFERENCES `departamento` (`idDeparta`),
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `admina` (`idAdminA`),
  ADD CONSTRAINT `curso_ibfk_3` FOREIGN KEY (`AnoLetivo_idAno`) REFERENCES `ano_letivo` (`idAno_letivo`);

--
-- Limitadores para a tabela `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`idAdminG`) REFERENCES `adming` (`idAdminG`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`curso_idCurso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `disciplina_ibfk_2` FOREIGN KEY (`profe_idProfessor`) REFERENCES `professor` (`idProfessor`),
  ADD CONSTRAINT `disciplina_ibfk_3` FOREIGN KEY (`AnoLetivo_idAno`) REFERENCES `ano_letivo` (`idAno_letivo`),
  ADD CONSTRAINT `disciplina_ibfk_4` FOREIGN KEY (`anoEscolar_idEscolar`) REFERENCES `anosescolares` (`idAnosEscolares`);

--
-- Limitadores para a tabela `disciplina_vs_aluno`
--
ALTER TABLE `disciplina_vs_aluno`
  ADD CONSTRAINT `disciplina_vs_aluno_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `disciplina_vs_aluno_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Limitadores para a tabela `disciplina_vs_curso`
--
ALTER TABLE `disciplina_vs_curso`
  ADD CONSTRAINT `disciplina_vs_curso_ibfk_1` FOREIGN KEY (`discipliana_idDisciplina`) REFERENCES `disciplina` (`idDisciplina`),
  ADD CONSTRAINT `disciplina_vs_curso_ibfk_2` FOREIGN KEY (`curso_idCurso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `disciplina_vs_curso_ibfk_3` FOREIGN KEY (`anoEscolar_idEscolar`) REFERENCES `anosescolares` (`idAnosEscolares`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`);

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`);

--
-- Limitadores para a tabela `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`profe_idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`),
  ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`login_idLogin`) REFERENCES `login` (`idLogin`),
  ADD CONSTRAINT `professor_ibfk_3` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `adming` (`idAdminG`),
  ADD CONSTRAINT `professor_ibfk_4` FOREIGN KEY (`idDeparta`) REFERENCES `departamento` (`idDeparta`);

--
-- Limitadores para a tabela `professor_vs_aluno`
--
ALTER TABLE `professor_vs_aluno`
  ADD CONSTRAINT `professor_vs_aluno_ibfk_1` FOREIGN KEY (`aluno_idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `professor_vs_aluno_ibfk_2` FOREIGN KEY (`profe_idProfessor`) REFERENCES `professor` (`idProfessor`),
  ADD CONSTRAINT `professor_vs_aluno_ibfk_3` FOREIGN KEY (`aluno_idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `professor_vs_aluno_ibfk_4` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `admina` (`idAdminA`);

--
-- Limitadores para a tabela `professor_vs_curso`
--
ALTER TABLE `professor_vs_curso`
  ADD CONSTRAINT `professor_vs_curso_ibfk_1` FOREIGN KEY (`curso_idCurso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `professor_vs_curso_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `admina` (`idAdminA`),
  ADD CONSTRAINT `professor_vs_curso_ibfk_3` FOREIGN KEY (`profe_idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `secretario`
--
ALTER TABLE `secretario`
  ADD CONSTRAINT `secretario_ibfk_1` FOREIGN KEY (`pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`),
  ADD CONSTRAINT `secretario_ibfk_2` FOREIGN KEY (`Login_idLogin`) REFERENCES `login` (`idLogin`),
  ADD CONSTRAINT `secretario_ibfk_3` FOREIGN KEY (`idDeparta`) REFERENCES `departamento` (`idDeparta`),
  ADD CONSTRAINT `secretario_ibfk_4` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `admina` (`idAdminA`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`Escolar_idAnoEsco`) REFERENCES `anosescolares` (`idAnosEscolares`),
  ADD CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`Departa_idDeparta`) REFERENCES `departamento` (`idDeparta`),
  ADD CONSTRAINT `turma_ibfk_3` FOREIGN KEY (`curso_idCurso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `turma_ibfk_4` FOREIGN KEY (`ano_letivo_idAno`) REFERENCES `ano_letivo` (`idAno_letivo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
