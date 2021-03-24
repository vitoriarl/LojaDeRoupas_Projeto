-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para projeto
CREATE DATABASE IF NOT EXISTS `projeto` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `projeto`;

-- Copiando estrutura para tabela projeto.forma
CREATE TABLE IF NOT EXISTS `forma` (
  `id` int(11) NOT NULL,
  `tamanho` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela projeto.forma: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `forma` DISABLE KEYS */;
/*!40000 ALTER TABLE `forma` ENABLE KEYS */;

-- Copiando estrutura para tabela projeto.funcionario
CREATE TABLE IF NOT EXISTS `funcionario` (
  `funcionario_id` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `funcionario_cpf` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `funcionario_funcao` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`funcionario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela projeto.funcionario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` (`funcionario_id`, `funcionario_nome`, `funcionario_cpf`, `funcionario_funcao`) VALUES
	(1, 'Vitoria Leonardo', '014.890.975-09', 'dona');
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;

-- Copiando estrutura para tabela projeto.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela projeto.produtos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `nome`, `preco`, `imagem`) VALUES
	(1, 'Vestido Corte Noturna', 200.00, 'vestido-corte-noturna.jpg'),
	(2, 'Blusa Manga longa', 50.00, 'camisa_manga_longa_gola_blazer.jpg'),
	(3, 'Saia Rodada', 60.00, 'saia rodada.jpg'),
	(4, 'Vestido Corte Primaveril', 100.00, 'vestido-corte-primaveril.jpg'),
	(5, 'Top Cami Couro PU com Blusa', 259.00, 'croped.webp'),
	(6, 'Shots Alfaiataria', 89.90, 'short.jpg'),
	(7, 'Vestido Tie Dye', 99.90, 'tiedye.png'),
	(8, 'Macacao Pantacurt Liso', 129.90, 'macacao.png');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

-- Copiando estrutura para tabela projeto.tem
CREATE TABLE IF NOT EXISTS `tem` (
  `tem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_id_venda` int(11) NOT NULL DEFAULT '0',
  `tem_id_produto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tem_id`),
  KEY `tem_id_produto` (`tem_id_produto`),
  KEY `tem_id_venda` (`tem_id_venda`),
  CONSTRAINT `tem_ibfk_1` FOREIGN KEY (`tem_id_produto`) REFERENCES `produtos` (`id`),
  CONSTRAINT `tem_ibfk_2` FOREIGN KEY (`tem_id_venda`) REFERENCES `venda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela projeto.tem: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tem` DISABLE KEYS */;
/*!40000 ALTER TABLE `tem` ENABLE KEYS */;

-- Copiando estrutura para tabela projeto.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `usuario_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `usuario_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `usuario_cpf` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `usuario_senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela projeto.usuario: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`, `usuario_nome`, `usuario_email`, `usuario_user`, `usuario_cpf`, `usuario_senha`) VALUES
	(8, 'Vitoria Rodrigues', 'vitoriarleonardo@gmail.com', 'vitoria', '818.658.350-56', '827ccb0eea8a706c4c34a16891f84e7b'),
	(11, 'Renan Santos', 'renansantos@gmail.com', 'renan', '111.111.111-11', '827ccb0eea8a706c4c34a16891f84e7b'),
	(13, 'beatriz souza', 'beatriz@gmail.com', 'beatriz', '000.000.000-00', '827ccb0eea8a706c4c34a16891f84e7b'),
	(15, 'Heitor', 'heitor@gmail.com', 'heitor', '12345678900', '827ccb0eea8a706c4c34a16891f84e7b'),
	(16, 'emanuel nao sei', 'emanuel@gmail.com', 'emanuel', '0000000000', '827ccb0eea8a706c4c34a16891f84e7b');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela projeto.venda
CREATE TABLE IF NOT EXISTS `venda` (
  `id` int(11) NOT NULL,
  `venda_id_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela projeto.venda: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `venda` DISABLE KEYS */;
/*!40000 ALTER TABLE `venda` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
