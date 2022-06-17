-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Jun-2022 às 02:20
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ci4`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `active` varchar(50) NOT NULL,
  `recovery_hash` text DEFAULT NULL,
  `recovery_expires` datetime DEFAULT current_timestamp(),
  `photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `active`, `recovery_hash`, `recovery_expires`, `photo`, `created_at`, `updated_at`) VALUES
(72, 'Admin', 'admin@gmail.com', '$2y$10$huMksxZzBVClrFZaebTmnOJu9oYD1pTlaGOPLjgUJ8VA2pn8E.kGa', '1', '$2y$10$Lh31dSK6Z1PaJ8gwhc/yiOyQhBzyKxcRcGyfQlS20RCSlRwb9A5B6', '2022-06-17 20:54:47', 'uploads/1655260510_9c6f50443a8d1ca7876e.png', '2022-06-08 18:39:27', '2022-06-16 21:12:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name_key` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `name_key`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(557, 'company_name', 'company_name', 'Deploy Code', 'mail', '2022-06-16 20:51:07', '2022-06-16 20:51:07'),
(558, 'mail_method', 'mail_method', '0', 'mail', '2022-06-16 21:14:15', '2022-06-16 21:14:15'),
(559, 'phpmailer_host', 'phpmailer_host', 'smtp.xxxx.com', 'mail', '2022-06-16 21:14:15', '2022-06-16 21:14:15'),
(560, 'phpmailer_username', 'phpmailer_username', 'seuemail@dominio.com', 'mail', '2022-06-16 21:14:15', '2022-06-16 21:14:15'),
(561, 'phpmailer_password', 'phpmailer_password', 'suasenha', 'mail', '2022-06-16 21:14:15', '2022-06-16 21:14:15'),
(562, 'phpmailer_secure', 'phpmailer_secure', 'ssl', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(563, 'phpmailer_port', 'phpmailer_port', '465', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(564, 'phpmailer_charset', 'phpmailer_charset', 'UTF-8', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(565, 'email_host', 'email_host', 'smtp.xxxx.com', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(566, 'email_username', 'email_username', 'seuemail@dominio.com', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(567, 'email_password', 'email_password', 'suasenha', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(568, 'email_secure', 'email_secure', 'ssl', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(569, 'email_port', 'email_port', '465', 'mail', '2022-06-16 21:14:16', '2022-06-16 21:14:16'),
(570, 'email_charset', 'email_charset', 'UTF-8', 'mail', '2022-06-16 21:14:17', '2022-06-16 21:14:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=571;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
