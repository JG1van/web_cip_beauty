/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - web_cip_data
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`web_cip_data` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `web_cip_data`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`email`,`activation_code`) values 
(1,'JONATHAN','190304','gian123ivan@gmail.com','664602b3dbf73'),
(2,'GIAN','123456','gian@gmail.com','665c0410c8a8b');

/*Table structure for table `accounts_admin` */

DROP TABLE IF EXISTS `accounts_admin`;

CREATE TABLE `accounts_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `accounts_admin` */

insert  into `accounts_admin`(`id`,`username`,`password`,`email`) values 
(1,'admin','admincip','admin@gmail.com');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` varchar(50) NOT NULL,
  `ID_USERS` varchar(50) DEFAULT NULL,
  `ID_PRODUK` varchar(50) DEFAULT NULL,
  `TANGGAL` datetime DEFAULT NULL,
  `ALAMAT` text DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `TOTAL` decimal(10,2) DEFAULT NULL,
  `TELEPON` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PEMBAYARAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembayaran` */

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_PRODUK` varchar(255) NOT NULL,
  `HARGA_PRODUK` double NOT NULL,
  `GAMBAR` varchar(255) DEFAULT NULL,
  `DESKRIPSI` text DEFAULT NULL,
  `SLIDE-GAMBAR` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`ID`,`NAMA_PRODUK`,`HARGA_PRODUK`,`GAMBAR`,`DESKRIPSI`,`SLIDE-GAMBAR`) values 
(1,'Beauty Toner',1000,'2N2G3HzE9CDhL8R2npjI.jpg','<p>Beauty Toner adalah toner wajah yang diformulasikan khusus untuk menyegarkan dan membersihkan kulit wajah. Dibuat dengan bahan-bahan alami terbaik, toner ini aman untuk semua jenis kulit dan membantu:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Menyegarkan kulit: Toner ini mengandung bahan-bahan seperti witch hazel dan cucumber extract yang membantu menyegarkan dan mendinginkan kulit.</p>\r\n\r\n<p>Membersihkan sisa kotoran: Toner ini membantu membersihkan sisa kotoran, makeup, dan minyak berlebih yang mungkin masih menempel di wajah setelah mencuci muka.</p>\r\n\r\n<p>Menyeimbangkan pH kulit: Toner ini membantu menyeimbangkan pH kulit, sehingga kulit tetap sehat dan terawat.</p>\r\n\r\n<p>Menyiapkan kulit untuk produk skincare selanjutnya: Toner membantu menyiapkan kulit untuk produk skincare selanjutnya, sehingga produk skincare dapat lebih mudah diserap oleh kulit.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Kulit lebih segar dan bersih</p>\r\n\r\n<p>Sisa kotoran, makeup, dan minyak berlebih terangkat</p>\r\n\r\n<p>pH kulit seimbang</p>\r\n\r\n<p>Kulit siap untuk produk skincare selanjutnya</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cara penggunaan:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bersihkan wajah dengan sabun cuci muka yang lembut.</p>\r\n\r\n<p>Tuangkan toner ke kapas atau telapak tangan.</p>\r\n\r\n<p>Usapkan toner pada wajah dan leher dengan gerakan memutar.</p>\r\n\r\n<p>Tepuk-tepuk wajah dengan lembut untuk membantu toner meresap.</p>\r\n\r\n<p>Gunakan pelembab.</p>\r\n','XlM5MOf2is3uOo0hFipL.png'),
(2,'Beauty Milk Cleanser',2000,'3KC7qPtzwqo5qoxRdRzK.jpg','<p>Beauty Milk Cleanser adalah pembersih wajah lembut yang diformulasikan khusus untuk kulit sensitif. Dibuat dengan bahan-bahan alami yang ringan, pembersih ini membantu membersihkan wajah dari kotoran, minyak, dan makeup tanpa membuat kulit iritasi.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Membersihkan wajah dari kotoran, minyak, dan makeup<br />\r\nLembut untuk kulit sensitif<br />\r\nMenjaga kelembaban alami kulit</p>\r\n\r\n<p><br />\r\nBasahi wajah dengan air hangat.<br />\r\nPompa sedikit Beauty Milk Cleanser ke telapak tangan Anda.<br />\r\nPijat lembut pembersih ke wajah Anda dengan gerakan memutar.<br />\r\nBilas wajah Anda dengan air bersih.<br />\r\nTepuk-tepuk wajah Anda dengan lembut hingga kering.</p>\r\n','50G1Fgi2iIpR2j3hYu7Y.png'),
(3,'Beauty Facial Wash',3000,'5GuBgYDwv7WyLispWdYs.jpg','<p>Beauty Facial Wash adalah sabun cuci muka yang diformulasikan untuk membersihkan wajah secara menyeluruh dan membantu mencerahkan kulit. &nbsp;Dengan bahan-bahan yang lembut, facial wash ini cocok untuk semua jenis kulit, termasuk kulit sensitif.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Membersihkan wajah dari kotoran, minyak, dan makeup<br />\r\nMencerahkan kulit wajah<br />\r\nMembuat wajah tampak lebih segar<br />\r\nCocok untuk semua jenis kulit, termasuk kulit sensitif</p>\r\n\r\n<p>Cara penggunaan:</p>\r\n\r\n<p>Basahi wajah Anda dengan air hangat.<br />\r\nPompa sedikit Beauty Facial Wash ke telapak tangan Anda.<br />\r\nBusakan produk tersebut dengan tangan Anda.<br />\r\nPijat lembut busa tersebut ke wajah Anda dengan gerakan memutar.<br />\r\nBilas wajah Anda dengan air bersih.<br />\r\nTepuk-tepuk wajah Anda dengan lembut hingga kering.</p>\r\n','IW5nuk32MFmI0F2a3vL5.png'),
(4,' Beauty Glowing Serum Malam',4000,'GKiR57Qya1z3Cm0inMJ7.jpg','<p>Beauty Glowing Serum Malam adalah serum wajah yang diformulasikan khusus untuk digunakan pada malam hari. Serum ini mengandung bahan-bahan yang bekerja menutrisi kulit saat Anda tidur, sehingga Anda dapat bangun dengan kulit yang tampak lebih cerah dan bercahaya di pagi hari.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Mencerahkan kulit wajah<br />\r\nMembuat wajah tampak lebih bercahaya<br />\r\nMenutrisi kulit<br />\r\nMelembapkan kulit</p>\r\n\r\n<p>Cara penggunaan:</p>\r\n\r\n<p>Bersihkan wajah Anda dengan sabun cuci muka yang lembut.<br />\r\nAplikasikan beberapa tetes Beauty Glowing Serum Malam ke wajah dan leher Anda.<br />\r\nPijat serum dengan lembut ke wajah Anda hingga meresap.<br />\r\nGunakan pelembab khusus malam hari.</p>\r\n','5ZQfP2G5MzdsAYYpCKIW.png'),
(5,'Sunscreen Pink Astaxanthin',5000,'5jdI1iboTqO9mg5LnuEf.jpg','<p>Sunscreen Pink Astaxanthin by CIP Beauty adalah tabir surya berwarna pink yang diformulasikan untuk melindungi kulit Anda dari sinar matahari UVA dan UVB. &nbsp;Produk ini mengandung Astaxanthin, bahan alami yang dipercaya memiliki manfaat antioksidan untuk membantu melindungi kulit dari kerusakan akibat radikal bebas.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Melindungi kulit dari sinar UVA dan UVB<br />\r\nMembantu mencegah sunburn<br />\r\nMembantu mencegah kerusakan kulit akibat radikal bebas<br />\r\nMencerahkan kulit wajah (sesuai dengan beberapa klaim produk sunscreen berwarna pink)</p>\r\n\r\n<p>Cara penggunaan:</p>\r\n\r\n<p>Aplikasikan Sunscreen Pink Astaxanthin by CIP Beauty ke seluruh wajah dan leher Anda 15 menit sebelum beraktivitas di luar ruangan.<br />\r\nAplikasikan kembali setiap 2 jam sekali, terutama setelah berenang atau berkeringat.</p>\r\n','nYjtSfMfdHgLVjkcOBnX.png'),
(6,'Cip Beauty Loose Powder Natural',6000,'8uv4nuBRvAjmjo3GPgpg.jpg','<p>Cip Beauty Loose Powder Natural adalah bedak tabur yang diformulasikan untuk &nbsp;menahan minyak dan membuat wajah Anda terlihat matte sepanjang hari. &nbsp;Dengan formula yang ringan dan natural, bedak tabur ini cocok untuk semua jenis kulit.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Menahan minyak di wajah<br />\r\nMembuat wajah terlihat matte<br />\r\nMenyetting foundation dan makeup agar tahan lama<br />\r\nFormula ringan yang cocok untuk semua jenis kulit</p>\r\n\r\n<p>Cara Penggunaan:</p>\r\n\r\n<p>Aplikasikan foundation dan makeup seperti biasa.<br />\r\nBuka kemasan Cip Beauty Loose Powder Natural dan putar puff yang tersedia secukupnya untuk mengeluarkan bedak.<br />\r\nTepuk-tepukkan puff secara perlahan ke seluruh wajah Anda, terutama pada area yang berminyak, seperti zona T (dahi, hidung, dan dagu).<br />\r\nAnda bisa menggunakan aplikator brush untuk hasil yang lebih natural dan tepat di bagian bawah mata</p>\r\n','T7ZEKmTzEJ0IvzKSmnWb.png'),
(7,'Cip Beauty Moisturizer Cream ',7000,'5UWl4aJiDueIuscEG5He.jpg','<p>Cip Beauty Moisturizer Cream adalah krim pelembab wajah yang diformulasikan untuk menutrisi dan menghidrasi kulit Anda. Krim ini mengandung bahan-bahan yang membantu menjaga kelembaban kulit sepanjang hari, sehingga kulit Anda terasa halus, lembut, dan terawat.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Menjaga kelembaban kulit sepanjang hari<br />\r\nMenutrisi kulit<br />\r\nMembuat kulit wajah terasa halus dan lembut<br />\r\nCocok untuk semua jenis kulit</p>\r\n\r\n<p>Cara Penggunaan:</p>\r\n\r\n<p>Bersihkan wajah Anda dengan sabun cuci muka yang lembut.<br />\r\nAplikasikan sedikit Cip Beauty Moisturizer Cream ke seluruh wajah dan leher Anda.<br />\r\nPijat krim secara perlahan ke wajah Anda hingga meresap.<br />\r\nGunakan krim ini di pagi dan malam hari untuk hasil yang optimal.</p>\r\n','RwJmf9cj7r957SlbswgU.png'),
(8,'CIP Beauty Brightening Night Cream',8000,'epfDX4DDOZ8iV5lHE1vp.jpg','<p>CIP Beauty Brightening Night Cream adalah krim malam yang diformulasikan khusus untuk mencerahkan kulit wajah saat Anda tidur. Krim ini mengandung bahan-bahan yang bekerja menutrisi dan mencerahkan kulit wajah Anda, sehingga Anda dapat bangun dengan wajah yang tampak lebih cerah dan bercahaya di pagi hari.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Mencerahkan kulit wajah<br />\r\nMenyamarkan noda hitam dan bekas jerawat<br />\r\nMenutrisi kulit wajah<br />\r\nCocok untuk semua jenis kulit (sesuai dengan klaim produk)</p>\r\n\r\n<p>Cara Penggunaan:</p>\r\n\r\n<p>Bersihkan wajah Anda dengan sabun cuci muka yang lembut.<br />\r\nAplikasikan sedikit CIP Beauty Brightening Night Cream ke seluruh wajah dan leher Anda.<br />\r\nPijat krim secara perlahan ke wajah Anda hingga meresap.<br />\r\nGunakan krim ini sebelum tidur di malam hari.</p>\r\n','hIkOgqimRn52XJIjwAkI.png'),
(9,'Face moisturizer',9000,'L8igeJ4YnZmrTuau5t2J.jpg','<p>Face moisturizer&nbsp;adalah produk perawatan kulit yang penting untuk menjaga kelembaban dan kesehatan kulit Anda. &nbsp;Dengan menggunakan pelembab secara teratur, Anda dapat membantu menjaga kulit tetap terhidrasi, kenyal, dan awet muda.</p>\r\n\r\n<p>Manfaat:</p>\r\n\r\n<p>Menjaga kelembaban kulit<br />\r\nMencegah kulit kering<br />\r\nMembuat kulit tampak lebih sehat<br />\r\nMembuat kulit terasa lebih halus dan lembut<br />\r\nDapat membantu mengurangi tanda-tanda penuaan dini pada kulit</p>\r\n\r\n<p>Cara Penggunaan:</p>\r\n\r\n<p>Bersihkan wajah Anda dengan sabun cuci muka yang lembut.<br />\r\nAplikasikan sedikit pelembab wajah ke seluruh wajah dan leher Anda.<br />\r\nPijat krim secara perlahan ke wajah Anda hingga meresap.<br />\r\nGunakan pelembab wajah di pagi dan malam hari setelah mencuci muka.</p>\r\n','etV9qKztI0yxOCRPmCQT.png');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `ID_TRANSAKSI` char(10) NOT NULL,
  `ID_USERS` int(11) DEFAULT NULL,
  `ID_PRODUK` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_TRANSAKSI`),
  KEY `ID_USERS` (`ID_USERS`),
  KEY `ID_PRODUK` (`ID_PRODUK`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_USERS`) REFERENCES `accounts` (`id`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaksi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
