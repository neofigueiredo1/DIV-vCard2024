-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: localhost    Database: divvcard
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `divvcard_banner`
--

DROP TABLE IF EXISTS `divvcard_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_banner` (
  `banner_idx` int NOT NULL AUTO_INCREMENT,
  `ranking` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `tipo_idx` int DEFAULT NULL,
  `monitor_impressao` int DEFAULT NULL,
  `monitor_clique` int DEFAULT NULL,
  `alinhamento` int DEFAULT NULL,
  `arquivo` longtext,
  `formato` int DEFAULT NULL,
  `pagina` longtext,
  `lugar` longtext,
  `nome` longtext,
  `descricao` longtext,
  `url` longtext,
  `alvo` longtext,
  `horario` int DEFAULT NULL,
  `horario_ini` int DEFAULT NULL,
  `horario_fim` int DEFAULT NULL,
  `indica_data` int DEFAULT NULL,
  `data_publicacao` datetime DEFAULT NULL,
  `data_expiracao` datetime DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`banner_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_banner`
--

LOCK TABLES `divvcard_banner` WRITE;
/*!40000 ALTER TABLE `divvcard_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `divvcard_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_banner_data`
--

DROP TABLE IF EXISTS `divvcard_banner_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_banner_data` (
  `data_idx` int NOT NULL AUTO_INCREMENT,
  `banner_idx` int DEFAULT NULL,
  `tipo` int DEFAULT NULL,
  `http_referer` longtext,
  `remote_addr` longtext,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`data_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_banner_data`
--

LOCK TABLES `divvcard_banner_data` WRITE;
/*!40000 ALTER TABLE `divvcard_banner_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `divvcard_banner_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_banner_tipo`
--

DROP TABLE IF EXISTS `divvcard_banner_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_banner_tipo` (
  `tipo_idx` int NOT NULL AUTO_INCREMENT,
  `nome` longtext,
  `largura` int DEFAULT NULL,
  `altura` int DEFAULT NULL,
  `animacao` longtext,
  `animacao_tempo` int DEFAULT NULL,
  `animacao_velocidade` int DEFAULT NULL,
  `perfil` int DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tipo_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_banner_tipo`
--

LOCK TABLES `divvcard_banner_tipo` WRITE;
/*!40000 ALTER TABLE `divvcard_banner_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `divvcard_banner_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_cadastro`
--

DROP TABLE IF EXISTS `divvcard_cadastro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_cadastro` (
  `cadastro_idx` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `nome_completo` varchar(550) DEFAULT NULL COMMENT 'Nome Completo',
  `nome_informal` varchar(50) DEFAULT NULL COMMENT 'Nome informal',
  `genero` int DEFAULT NULL COMMENT 'Gênero',
  `data_nasc` varchar(20) DEFAULT NULL COMMENT 'Data de nascimento',
  `email` varchar(550) DEFAULT NULL COMMENT 'E-mail',
  `senha` varchar(550) DEFAULT NULL,
  `telefone_resid` varchar(50) DEFAULT NULL COMMENT 'Telefone residencial',
  `telefone_comer` varchar(50) DEFAULT NULL COMMENT 'Telefone comercial',
  `celular` varchar(50) DEFAULT NULL COMMENT 'Celular',
  `endereco` varchar(50) DEFAULT NULL COMMENT 'Endereço',
  `numero` varchar(50) DEFAULT NULL COMMENT 'Número',
  `complemento` varchar(50) DEFAULT NULL COMMENT 'Complemento',
  `bairro` varchar(50) DEFAULT NULL COMMENT 'Bairro',
  `cep` varchar(50) DEFAULT NULL COMMENT 'CEP',
  `cidade` varchar(50) DEFAULT NULL COMMENT 'Cidade',
  `estado` varchar(50) DEFAULT NULL COMMENT 'Estado',
  `pais` varchar(50) DEFAULT NULL COMMENT 'País',
  `imagem` longtext,
  `cpf_cnpj` varchar(50) DEFAULT NULL COMMENT 'CPF',
  `profile_uri` varchar(145) DEFAULT NULL,
  `empresa_nome` varchar(245) DEFAULT NULL,
  `empresa_cargo` varchar(245) DEFAULT NULL,
  `site` varchar(245) DEFAULT NULL,
  `theme_background_type` varchar(45) DEFAULT NULL,
  `theme_background_data` varchar(145) DEFAULT NULL,
  `theme_text_color` varchar(145) DEFAULT NULL,
  `theme_link_color` varchar(45) DEFAULT NULL,
  `descricao` varchar(545) DEFAULT NULL,
  `receber_boletim` int DEFAULT NULL COMMENT 'Receber boletim',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cadastro_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_cadastro`
--

LOCK TABLES `divvcard_cadastro` WRITE;
/*!40000 ALTER TABLE `divvcard_cadastro` DISABLE KEYS */;
INSERT INTO `divvcard_cadastro` VALUES (2,1,'Neo Figueiredo','Neo Figueiredo',1,'','neo@div.tec.br','930e3c83d838d1361f7d7a3610f8f1fc','','','(85) 98851-0555','','','','','','','','','profile-neofigueiredo.png','','neofigueiredo','DIV Soluções em Tecnologia','Chief Technology Officer','https://div.tec.br',NULL,NULL,NULL,NULL,'Sou sócio diretor na DIV Soluções em Tecnologia, empresa focada no desenvolvimento de aplicações  web e mobile, que também atua na análise de novos produtos e Big Data para diversas empresas do mercado.',0,'2024-10-03 19:13:09');
/*!40000 ALTER TABLE `divvcard_cadastro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_config`
--

DROP TABLE IF EXISTS `divvcard_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_config` (
  `config_idx` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `nome` longtext,
  `valor` longtext,
  `descricao` longtext,
  `nivel` int DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`config_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_config`
--

LOCK TABLES `divvcard_config` WRITE;
/*!40000 ALTER TABLE `divvcard_config` DISABLE KEYS */;
INSERT INTO `divvcard_config` VALUES (1,1,'SIS_NOME','DirectIn',NULL,0,'2014-02-17 20:05:33'),(2,1,'SIS_VERSAO','1.0',NULL,0,'2014-02-17 20:05:33'),(3,1,'SIS_COLOR','#5c87b2','Cor tema do sistema.',0,'2014-02-17 20:06:19'),(4,1,'CLI_COTA','1024','Cota de armazenamento do cliente no servidor de hospedagem.',0,'2014-02-17 20:05:34'),(5,1,'SIS_NOME','DirectIn','Nome do Sistema',0,'2024-09-04 20:25:33'),(6,1,'SIS_VERSAO','1.0','Versão do sistema',0,'2024-09-04 20:25:33'),(7,1,'CLI_NOME','DIV - vCard',NULL,0,'2024-10-03 19:14:10'),(8,1,'CLI_TITULO','vCard',NULL,0,'2024-10-03 19:14:10'),(9,1,'CLI_URL','vcard.div.tec.br',NULL,0,'2024-10-03 19:14:10'),(10,1,'CLI_MAIL_CONTATO','desenvolvimento@being.com.br',NULL,0,'2024-09-04 20:41:22'),(11,1,'CLI_DESCRICAO','',NULL,0,'2024-09-04 20:39:34'),(12,1,'CLI_KEYWORDS','',NULL,0,'2024-09-04 20:39:34'),(13,1,'CLI_LOGO','logomarca_cliente.png',NULL,0,'2024-09-04 20:41:22'),(14,1,'CLI_SMTP_HOST','',NULL,0,'2024-09-04 20:39:34'),(15,1,'CLI_SMTP_PORTA','',NULL,0,'2024-09-04 20:39:34'),(16,1,'CLI_SMTP_CONEXAO','',NULL,0,'2024-09-04 20:39:34'),(17,1,'CLI_SMTP_MAIL','',NULL,0,'2024-09-04 20:39:34'),(18,1,'CLI_SMTP_PASS','',NULL,0,'2024-09-04 20:39:34');
/*!40000 ALTER TABLE `divvcard_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_conteudo_menu`
--

DROP TABLE IF EXISTS `divvcard_conteudo_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_conteudo_menu` (
  `menu_idx` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` longtext,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_conteudo_menu`
--

LOCK TABLES `divvcard_conteudo_menu` WRITE;
/*!40000 ALTER TABLE `divvcard_conteudo_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `divvcard_conteudo_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_conteudo_menu_paginas`
--

DROP TABLE IF EXISTS `divvcard_conteudo_menu_paginas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_conteudo_menu_paginas` (
  `menu_pagina_idx` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_idx` int unsigned DEFAULT NULL,
  `pagina_idx` int unsigned DEFAULT NULL,
  `nome` varchar(500) DEFAULT NULL,
  `ranking` int unsigned DEFAULT NULL,
  PRIMARY KEY (`menu_pagina_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_conteudo_menu_paginas`
--

LOCK TABLES `divvcard_conteudo_menu_paginas` WRITE;
/*!40000 ALTER TABLE `divvcard_conteudo_menu_paginas` DISABLE KEYS */;
/*!40000 ALTER TABLE `divvcard_conteudo_menu_paginas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_conteudo_pagina`
--

DROP TABLE IF EXISTS `divvcard_conteudo_pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_conteudo_pagina` (
  `pagina_idx` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(128) DEFAULT NULL,
  `titulo_seo` varchar(250) DEFAULT NULL,
  `palavra_chave` longtext,
  `descricao` longtext,
  `conteudo` longtext,
  `status` tinyint unsigned DEFAULT NULL,
  `indice` int DEFAULT NULL,
  `menu` int DEFAULT NULL,
  `pagina_mae` int DEFAULT NULL,
  `link_externo` varchar(128) DEFAULT NULL,
  `alvo_link` varchar(128) DEFAULT NULL,
  `url_rewrite` longtext,
  `url_pagina` longtext,
  `extra` longtext,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pagina_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_conteudo_pagina`
--

LOCK TABLES `divvcard_conteudo_pagina` WRITE;
/*!40000 ALTER TABLE `divvcard_conteudo_pagina` DISABLE KEYS */;
INSERT INTO `divvcard_conteudo_pagina` VALUES (2,'Empreendimentos','','','','',1,10,NULL,0,'','0','empreendimentos','0','','2024-09-12 17:15:07'),(3,'Empreendimento','','','','',1,20,NULL,0,'','0','empreendimento','0','','2024-09-12 17:15:17'),(4,'vCard','','','','',1,30,NULL,0,'','0','vcard','0','','2024-10-03 19:33:47');
/*!40000 ALTER TABLE `divvcard_conteudo_pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_ev_empreendimento_unidades`
--

DROP TABLE IF EXISTS `divvcard_ev_empreendimento_unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_ev_empreendimento_unidades` (
  `unidade_idx` int unsigned NOT NULL AUTO_INCREMENT,
  `empreendimento_idx` int unsigned DEFAULT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `situacao_venda` varchar(250) DEFAULT NULL,
  `mapa_posicao_y` varchar(500) DEFAULT NULL,
  `mapa_posicao_X` int unsigned DEFAULT NULL,
  `element_points_square` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`unidade_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_ev_empreendimento_unidades`
--

LOCK TABLES `divvcard_ev_empreendimento_unidades` WRITE;
/*!40000 ALTER TABLE `divvcard_ev_empreendimento_unidades` DISABLE KEYS */;
INSERT INTO `divvcard_ev_empreendimento_unidades` VALUES (3,2,'QD3-LT5','hipotecado_vendido','0',0,'3127,213 3173,226 3087,379 3049,361'),(4,2,'QD4-LT1','vendido','0',0,'3025,590 3158,667 3120,740 3038,694 3029,667 3018,644 3006,626'),(5,2,'QD3-LT13','reserva_tecnica','0',0,'2676,72 2741,92 2704,187 2682,178 2663,179 2646,186 2629,204'),(6,2,'QD10-LT17','livre','0',0,'711,640 742,671 648,775 608,739'),(7,2,'QD1-LT1','cliente_parceiro','0',0,'3211,841 3333,910 3309,955 3184,884');
/*!40000 ALTER TABLE `divvcard_ev_empreendimento_unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_log`
--

DROP TABLE IF EXISTS `divvcard_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_log` (
  `log_idx` int NOT NULL AUTO_INCREMENT,
  `usuario_idx` int DEFAULT NULL,
  `modulo_codigo` int DEFAULT NULL,
  `modulo_area` varchar(255) DEFAULT NULL,
  `registro_codigo` int DEFAULT NULL,
  `registro_nome` varchar(255) DEFAULT NULL,
  `acao` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `ip_usuario` varchar(100) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_log`
--

LOCK TABLES `divvcard_log` WRITE;
/*!40000 ALTER TABLE `divvcard_log` DISABLE KEYS */;
INSERT INTO `divvcard_log` VALUES (23,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-04 20:25:42'),(24,2,0,'Módulo',0,'Conteúdo','INSERT','','::1','2024-09-04 20:27:30'),(25,2,0,'Módulo',0,'Cadastro','INSERT','','::1','2024-09-04 20:27:31'),(26,2,10013,'Cadastro',1,'neo','INSERT','','::1','2024-09-04 20:32:25'),(27,2,10013,'Cadastro',2,'neo','INSERT','','::1','2024-09-04 20:32:34'),(28,2,10013,'Cadastro',0,'neo','DELETE','','::1','2024-09-04 20:36:56'),(29,2,10013,'Cadastro',0,'neo 222','UPDATE','','::1','2024-09-04 20:37:00'),(30,2,0,'Módulo',0,'Cadastro','DELETE','','::1','2024-09-04 20:37:54'),(31,2,0,'Módulo',0,'Cadastro','INSERT','','::1','2024-09-04 20:37:55'),(32,2,10013,'Cadastro',1,'neo','INSERT','','::1','2024-09-04 20:38:07'),(33,2,10013,'Cadastro',0,'neo222','UPDATE','','::1','2024-09-04 20:38:14'),(34,2,10001,'Página',1,'asd','INSERT','','::1','2024-09-04 20:38:51'),(35,2,10001,'Página',1,'asd222','UPDATE','','::1','2024-09-04 20:38:56'),(36,2,10001,'Menu',1,'asd','INSERT','','::1','2024-09-04 20:39:03'),(37,2,10001,'Menu',1,'asd','UPDATE','','::1','2024-09-04 20:39:07'),(38,2,10001,'Menu',1,'asd222','UPDATE','','::1','2024-09-04 20:39:09'),(39,2,10001,'Menu',1,'asd222','DELETE','','::1','2024-09-04 20:39:11'),(40,2,10001,'Página',1,'asd222','DELETE','','::1','2024-09-04 20:39:17'),(41,2,0,'Configuração do sistema',0,'','INSERT','','::1','2024-09-04 20:39:34'),(42,2,0,'Configuração do sistema',0,'','UPDATE','','::1','2024-09-04 20:41:22'),(43,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-09 19:54:33'),(44,2,0,'Módulo',0,'Espelho de Vendas','INSERT','','::1','2024-09-09 20:14:11'),(45,2,0,'Módulo',0,'Espelho de Vendas','DELETE','','::1','2024-09-09 20:15:29'),(46,2,0,'Módulo',0,'Espelho de Vendas','INSERT','','::1','2024-09-09 20:15:32'),(47,2,0,'Módulo',0,'Espelho de Vendas','DELETE','','::1','2024-09-09 20:26:15'),(48,2,0,'Módulo',0,'Espelho de Vendas','INSERT','','::1','2024-09-09 20:26:16'),(49,2,12003,'Espelho de Vendas - Empreendimento',1,'asd','INSERT','','::1','2024-09-09 20:27:12'),(50,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:16:45'),(51,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:16:50'),(52,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:16:55'),(53,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:18:37'),(54,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:18:45'),(55,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:18:57'),(56,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:19:05'),(57,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:23:08'),(58,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:23:20'),(59,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:23:54'),(60,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:24:00'),(61,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:24:10'),(62,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-09 21:24:17'),(63,2,12003,'Espelho de Vendas - Empreendimento',0,'asd2223333','DELETE','','::1','2024-09-09 21:25:31'),(64,2,12003,'Espelho de Vendas - Empreendimento',0,'asd2223333','DELETE','','::1','2024-09-09 21:26:54'),(65,2,12003,'Espelho de Vendas - Empreendimento',0,'asd2223333','DELETE','','::1','2024-09-09 21:28:58'),(66,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-10 14:23:17'),(67,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-11 13:01:06'),(68,2,12003,'Espelho de Vendas - Empreendimento',2,'Moradas Maranguape','INSERT','','::1','2024-09-11 13:23:48'),(69,2,12003,'Espelho de Vendas - Unidades',1,'unidade: ','INSERT','','::1','2024-09-11 17:34:13'),(70,2,12003,'Espelho de Vendas - Unidades',2,'unidade: unidadeLTZ64','INSERT','','::1','2024-09-11 18:01:19'),(71,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-11 18:14:20'),(72,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-11 18:14:44'),(73,2,12003,'Espelho de Vendas - Unidades',0,'','DELETE','','::1','2024-09-11 18:24:21'),(74,2,12003,'Espelho de Vendas - Unidades',3,'unidade: asd123','INSERT','','::1','2024-09-11 18:30:32'),(75,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-11 18:30:54'),(76,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-11 18:30:58'),(77,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-12 13:15:57'),(78,2,12003,'Espelho de Vendas - Unidades',4,'unidade: Ponto Alpha','INSERT','','::1','2024-09-12 15:01:49'),(79,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:04:38'),(80,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:05:24'),(81,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:06:37'),(82,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:06:42'),(83,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:06:58'),(84,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:07:28'),(85,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:08:51'),(86,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 15:09:34'),(87,2,10013,'Cadastro',0,'Neo Figueiredo','UPDATE','','::1','2024-09-12 17:14:45'),(88,2,10001,'Página',2,'Empreendimentos','INSERT','','::1','2024-09-12 17:15:07'),(89,2,10001,'Página',3,'Empreendimento','INSERT','','::1','2024-09-12 17:15:17'),(90,2,0,'Ecommerce - Login',0,'','','Tentativa de Login utilizando o e-mail  neo@being.com.br','::1','2024-09-12 18:38:47'),(91,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-12 20:08:28'),(92,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-12 20:08:52'),(93,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 20:09:30'),(94,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 20:09:55'),(95,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 20:59:11'),(96,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-12 20:59:39'),(97,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-13 16:21:54'),(98,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-13 16:22:36'),(99,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-13 16:37:28'),(100,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-13 17:20:08'),(101,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-13 18:10:14'),(102,2,12003,'Espelho de Vendas - Unidades',5,'unidade: LOTE-BL03-UN13','INSERT','','::1','2024-09-13 18:14:28'),(103,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-13 18:19:04'),(104,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-13 18:24:34'),(105,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-13 18:33:45'),(106,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-13 18:46:43'),(107,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-16 20:33:19'),(108,2,12003,'Espelho de Vendas - Unidades',6,'unidade: QD10-LT17','INSERT','','::1','2024-09-16 20:40:05'),(109,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-16 20:44:00'),(110,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-16 20:44:27'),(111,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-16 20:44:44'),(112,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-16 20:44:51'),(113,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-16 20:46:16'),(114,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-09-18 14:19:46'),(115,2,12003,'Espelho de Vendas - Empreendimento',3,'asd45','INSERT','','::1','2024-09-18 15:11:55'),(116,2,12003,'Espelho de Vendas - Empreendimento',0,'asd45','DELETE','','::1','2024-09-18 15:15:02'),(117,2,12003,'Espelho de Vendas - Empreendimento',4,'123www','INSERT','','::1','2024-09-18 15:15:15'),(118,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-18 15:15:29'),(119,2,12003,'Espelho de Vendas - Empreendimento',0,'123wwwasd','DELETE','','::1','2024-09-18 17:00:03'),(120,2,12003,'Espelho de Vendas - Empreendimento',0,'','UPDATE','','::1','2024-09-18 17:01:01'),(121,2,12003,'Espelho de Vendas - Unidades',7,'unidade: QD1-LT1','INSERT','','::1','2024-09-18 17:31:40'),(122,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-18 17:58:21'),(123,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-18 17:58:26'),(124,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-18 17:58:33'),(125,2,12003,'Espelho de Vendas - Unidades',0,'','UPDATE','','::1','2024-09-18 18:13:03'),(126,2,0,'Login',2,'Admin','efetuado','Sucesso','::1','2024-10-03 19:04:22'),(127,2,0,'Módulo',0,'Espelho de Vendas','DELETE','','::1','2024-10-03 19:04:40'),(128,2,0,'Módulo',0,'Cadastro','UPDATE','Exclusão de backup','::1','2024-10-03 19:04:45'),(129,2,0,'Módulo',0,'Banner','INSERT','','::1','2024-10-03 19:05:34'),(130,2,0,'Módulo',0,'FAQ','INSERT','','::1','2024-10-03 19:05:35'),(131,2,10013,'Cadastro',0,'Neo Figueiredo','DELETE','','::1','2024-10-03 19:05:43'),(132,2,10013,'Cadastro',2,'Neo Figueiredo','INSERT','','::1','2024-10-03 19:13:09'),(133,2,0,'Configuração do sistema',0,'','UPDATE','','::1','2024-10-03 19:14:10'),(134,2,0,'Configuração do sistema',0,'','UPDATE','','::1','2024-10-03 19:20:31'),(135,2,0,'Módulo',0,'FAQ','DELETE','','::1','2024-10-03 19:20:55'),(136,2,10001,'Página',4,'vCard','INSERT','','::1','2024-10-03 19:33:47');
/*!40000 ALTER TABLE `divvcard_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_login`
--

DROP TABLE IF EXISTS `divvcard_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_login` (
  `usuario_idx` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `nivel` int DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(500) DEFAULT NULL,
  `set_validade` int DEFAULT NULL,
  `validade` datetime DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuario_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_login`
--

LOCK TABLES `divvcard_login` WRITE;
/*!40000 ALTER TABLE `divvcard_login` DISABLE KEYS */;
INSERT INTO `divvcard_login` VALUES (2,1,1,'Admin','desenvolvimento@being.com.br','being','88ec364bb524d9c4c78eba81ff98bf63',1,'2024-09-04 17:26:22','2024-09-04 20:25:32');
/*!40000 ALTER TABLE `divvcard_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_login_permissao`
--

DROP TABLE IF EXISTS `divvcard_login_permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_login_permissao` (
  `login_permissao_idx` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario_idx` int unsigned DEFAULT NULL,
  `modulo_codigo` int unsigned DEFAULT NULL,
  `permissao_codigo` int unsigned DEFAULT NULL,
  PRIMARY KEY (`login_permissao_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_login_permissao`
--

LOCK TABLES `divvcard_login_permissao` WRITE;
/*!40000 ALTER TABLE `divvcard_login_permissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `divvcard_login_permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_modulo`
--

DROP TABLE IF EXISTS `divvcard_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_modulo` (
  `modulo_idx` int unsigned NOT NULL AUTO_INCREMENT,
  `codigo` int unsigned DEFAULT NULL,
  `ranking` int unsigned DEFAULT NULL,
  `nome` varchar(455) DEFAULT NULL,
  `versao` varchar(45) DEFAULT NULL,
  `descricao` varchar(455) DEFAULT NULL,
  `dados` longtext,
  `pasta` varchar(455) DEFAULT NULL,
  PRIMARY KEY (`modulo_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_modulo`
--

LOCK TABLES `divvcard_modulo` WRITE;
/*!40000 ALTER TABLE `divvcard_modulo` DISABLE KEYS */;
INSERT INTO `divvcard_modulo` VALUES (1,10001,NULL,'Conteúdo','1.0','Faz o gerenciamento de todas as páginas de conteúdo do site.<br> Opçoes para criação de menus personalizados e páginas filho.','{\"codigo\":\"10001\",\"nome\":\"Conteúdo\",\"versao\":\"1.0\",\"pasta\":\"conteudo\",\"icone\":\"fa-file-o\",\"descricao\":\"Faz o gerenciamento de todas as páginas de conteúdo do site.<br> Opçoes para criação de menus personalizados e páginas filho.\",\"menu\":[{\"link\":\"Páginas\",\"url\":\"/admin/?mod=conteudo&pag=pagina\",\"permissao\":\"\"},{\"link\":\"Menus\",\"url\":\"/admin/?mod=conteudo&pag=menu\",\"permissao\":\"4\"}],\"permissao\":[{\"codigo\":\"1\",\"descricao\":\"Acessa o módulo\",\"nome\":\"Acesso\"},{\"codigo\":\"2\",\"descricao\":\"Controle total do módulo\",\"nome\":\"Geral\"},{\"codigo\":\"3\",\"descricao\":\"Insere, Edita e Exclui as páginas do site\",\"nome\":\"Páginas de contéudo\"},{\"codigo\":\"4\",\"descricao\":\"Insere, Edita e Exclui os menus do site\",\"nome\":\"Menus\"},{\"codigo\":\"5\",\"descricao\":\"Gerenciar o filemanager do Editor\",\"nome\":\"CKEditor\"}]}','conteudo'),(3,10003,NULL,'Cadastro','1.0','Faz o cadastro dos usuários do site','{\"codigo\":\"10003\",\"nome\":\"Cadastro\",\"versao\":\"1.0\",\"pasta\":\"cadastro\",\"icone\":\"fa-users\",\"descricao\":\"Faz o cadastro dos usuários do site\",\"menu\":[{\"link\":\"Cadastros\",\"url\":\"/admin/?mod=cadastro&pag=cadastro\",\"permissao\":\"\"},{\"link\":\"Novo Cadastro\",\"url\":\"/admin/?mod=cadastro&pag=cadastro&act=add\",\"permissao\":\"\"}],\"permissao\":[{\"codigo\":\"1\",\"nome\":\"Acesso ao módulo\",\"descricao\":\"Dá acesso simples de consulta ao dados do módulo\"}]}','cadastro'),(7,10002,NULL,'Banner','1.0','Faz o gerenciamento de todos os banners do site.','{\"codigo\":\"10002\",\"nome\":\"Banner\",\"versao\":\"1.0\",\"pasta\":\"banner\",\"icone\":\"fa-image\",\"descricao\":\"Faz o gerenciamento de todos os banners do site.\",\"menu\":\"/admin/?mod=banner&pag=banner&act=tipo-list\",\"permissao\":[{\"codigo\":\"1\",\"descricao\":\"Acessa o módulo\",\"nome\":\"Acesso\"},{\"codigo\":\"2\",\"descricao\":\"Controle total do módulo\",\"nome\":\"Geral\"},{\"codigo\":\"3\",\"descricao\":\"Gerenciar banners\",\"nome\":\"Banners\"},{\"codigo\":\"4\",\"descricao\":\"Gerenciar tipos do banner\",\"nome\":\"Tipos de banner\"},{\"codigo\":\"5\",\"descricao\":\"Consulta às estatísticas do banner\",\"nome\":\"Estatísticas\"}]}','banner');
/*!40000 ALTER TABLE `divvcard_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_modulo_permissao`
--

DROP TABLE IF EXISTS `divvcard_modulo_permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_modulo_permissao` (
  `modulo_permissao_idx` int unsigned NOT NULL AUTO_INCREMENT,
  `modulo_codigo` int unsigned DEFAULT NULL,
  `permissao_codigo` int unsigned DEFAULT NULL,
  `nome` varchar(450) DEFAULT NULL,
  `descricao` longtext,
  PRIMARY KEY (`modulo_permissao_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_modulo_permissao`
--

LOCK TABLES `divvcard_modulo_permissao` WRITE;
/*!40000 ALTER TABLE `divvcard_modulo_permissao` DISABLE KEYS */;
INSERT INTO `divvcard_modulo_permissao` VALUES (1,10001,1,'Acesso','Acessa o módulo'),(2,10001,2,'Geral','Controle total do módulo'),(3,10001,3,'Páginas de contéudo','Insere, Edita e Exclui as páginas do site'),(4,10001,4,'Menus','Insere, Edita e Exclui os menus do site'),(5,10001,5,'CKEditor','Gerenciar o filemanager do Editor'),(7,10003,1,'Acesso ao módulo','Dá acesso simples de consulta ao dados do módulo'),(11,10002,1,'Acesso','Acessa o módulo'),(12,10002,2,'Geral','Controle total do módulo'),(13,10002,3,'Banners','Gerenciar banners'),(14,10002,4,'Tipos de banner','Gerenciar tipos do banner'),(15,10002,5,'Estatísticas','Consulta às estatísticas do banner');
/*!40000 ALTER TABLE `divvcard_modulo_permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divvcard_urlrewrite_rule`
--

DROP TABLE IF EXISTS `divvcard_urlrewrite_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divvcard_urlrewrite_rule` (
  `rule_idx` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `perfil` int DEFAULT NULL COMMENT 'definir se a regra foi criada automaticamente ou através do sistema',
  `codigo_modulo` int DEFAULT NULL,
  `nome` longtext,
  `changefreq` varchar(50) DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `lastmod` varchar(20) DEFAULT NULL,
  `combinar` longtext,
  `acao` longtext,
  `descricao` longtext,
  PRIMARY KEY (`rule_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divvcard_urlrewrite_rule`
--

LOCK TABLES `divvcard_urlrewrite_rule` WRITE;
/*!40000 ALTER TABLE `divvcard_urlrewrite_rule` DISABLE KEYS */;
INSERT INTO `divvcard_urlrewrite_rule` VALUES (7,1,1,10003,'Perfil Neo Figueiredo','monthly','1.0','2024-09-12','vcard/neofigueiredo','?pagina=4&cadastroId=2',NULL),(8,1,1,10001,'Empreendimento','monthly','1.0','2024-10-03','empreendimento','?pagina=3',NULL),(9,1,1,10001,'Empreendimentos','monthly','1.0','2024-10-03','empreendimentos','?pagina=2',NULL),(10,1,1,10001,'vCard','monthly','1.0','2024-10-03','vcard','?pagina=4',NULL);
/*!40000 ALTER TABLE `divvcard_urlrewrite_rule` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-03 17:54:30
