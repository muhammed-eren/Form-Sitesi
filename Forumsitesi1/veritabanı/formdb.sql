/*
Navicat MySQL Data Transfer

Source Server         : KURS
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : formdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-04-05 14:40:59
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `begeni`
-- ----------------------------
DROP TABLE IF EXISTS `begeni`;
CREATE TABLE `begeni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `k_id` int(11) DEFAULT NULL,
  `makale_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of begeni
-- ----------------------------
INSERT INTO `begeni` VALUES ('9', '34', '124');
INSERT INTO `begeni` VALUES ('14', '34', '119');
INSERT INTO `begeni` VALUES ('15', '34', '122');
INSERT INTO `begeni` VALUES ('16', '46', '125');
INSERT INTO `begeni` VALUES ('17', '47', '126');
INSERT INTO `begeni` VALUES ('18', '34', '126');
INSERT INTO `begeni` VALUES ('19', '48', '126');
INSERT INTO `begeni` VALUES ('20', '49', '126');
INSERT INTO `begeni` VALUES ('22', '49', '127');
INSERT INTO `begeni` VALUES ('23', '50', '128');
INSERT INTO `begeni` VALUES ('30', '46', '129');
INSERT INTO `begeni` VALUES ('32', '36', '130');
INSERT INTO `begeni` VALUES ('36', '0', '0');
INSERT INTO `begeni` VALUES ('37', '0', '0');
INSERT INTO `begeni` VALUES ('38', '0', '0');
INSERT INTO `begeni` VALUES ('39', '0', '0');
INSERT INTO `begeni` VALUES ('40', '0', '0');
INSERT INTO `begeni` VALUES ('41', '0', '0');
INSERT INTO `begeni` VALUES ('42', '0', '0');
INSERT INTO `begeni` VALUES ('43', '0', '0');
INSERT INTO `begeni` VALUES ('44', '0', '0');
INSERT INTO `begeni` VALUES ('45', '0', '0');
INSERT INTO `begeni` VALUES ('46', '0', '0');
INSERT INTO `begeni` VALUES ('47', '0', '0');
INSERT INTO `begeni` VALUES ('82', '44', '96');
INSERT INTO `begeni` VALUES ('83', '44', '96');
INSERT INTO `begeni` VALUES ('92', '0', '129');
INSERT INTO `begeni` VALUES ('93', '0', '129');
INSERT INTO `begeni` VALUES ('94', '0', '129');
INSERT INTO `begeni` VALUES ('95', '0', '129');
INSERT INTO `begeni` VALUES ('96', '0', '129');
INSERT INTO `begeni` VALUES ('97', '0', '129');
INSERT INTO `begeni` VALUES ('98', '0', '129');
INSERT INTO `begeni` VALUES ('99', '0', '129');
INSERT INTO `begeni` VALUES ('100', '0', '129');
INSERT INTO `begeni` VALUES ('205', '44', '135');

-- ----------------------------
-- Table structure for `follows`
-- ----------------------------
DROP TABLE IF EXISTS `follows`;
CREATE TABLE `follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `following_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of follows
-- ----------------------------
INSERT INTO `follows` VALUES ('9', '34', '41');
INSERT INTO `follows` VALUES ('10', '46', '34');
INSERT INTO `follows` VALUES ('34', '46', '50');
INSERT INTO `follows` VALUES ('39', '46', '46');
INSERT INTO `follows` VALUES ('43', '34', '44');

-- ----------------------------
-- Table structure for `kategoriler`
-- ----------------------------
DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE `kategoriler` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `kad` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kategoriler
-- ----------------------------
INSERT INTO `kategoriler` VALUES ('16', 'Gündem');
INSERT INTO `kategoriler` VALUES ('62', 'Sorularınız');
INSERT INTO `kategoriler` VALUES ('63', 'Tartışma');
INSERT INTO `kategoriler` VALUES ('66', 'Futbol');
INSERT INTO `kategoriler` VALUES ('67', 'Süper lig');
INSERT INTO `kategoriler` VALUES ('76', 'flood');
INSERT INTO `kategoriler` VALUES ('77', 'Konu dışı');
INSERT INTO `kategoriler` VALUES ('78', 'Neden olmasın');

-- ----------------------------
-- Table structure for `kayitbilgi`
-- ----------------------------
DROP TABLE IF EXISTS `kayitbilgi`;
CREATE TABLE `kayitbilgi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullaniciadi` varchar(45) DEFAULT '',
  `isim` varchar(50) DEFAULT NULL,
  `soyisim` varchar(50) DEFAULT NULL,
  `eposta` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT '',
  `pp` varchar(500) DEFAULT NULL,
  `biyo` varchar(500) DEFAULT NULL,
  `takipci` int(100) DEFAULT 0,
  `begeni` int(100) DEFAULT 0,
  `gonderi` int(100) DEFAULT 0,
  `afis` varchar(500) DEFAULT 'img/tree-736885_1280.jpg',
  `yetki` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`eposta`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kayitbilgi
-- ----------------------------
INSERT INTO `kayitbilgi` VALUES ('34', 'er', 'Muhammed eren', 'Bilici', 'er@gmail.com', '12eccbdd9b32918131341f38907cbbb5', 'img/dararipng.png', 'Oldu cano', '1', '1', '11', 'img/images (1).jpg', '(Üye)');
INSERT INTO `kayitbilgi` VALUES ('35', 're', 'sd', 'asd', 're@gmail.com', '818f9c45cfa30eeff277ef38bcbe9910', 'img/pngwing.com.png', null, '0', '0', '2', 'img/tree-736885_1280.jpg', '');
INSERT INTO `kayitbilgi` VALUES ('37', 'as', 'asd', 'df', 'as@dsf', '818f9c45cfa30eeff277ef38bcbe9910', 'img/bwm.jpg', 'Merhaba', '0', '0', '2', 'img/tree-736885_1280.jpg', '');
INSERT INTO `kayitbilgi` VALUES ('41', 'X_kralTR', 'X_kralTR.jpg', '', 'KralOyun@gmail.com', '818f9c45cfa30eeff277ef38bcbe9910', 'img/indir (2).jpg', 'Hekırım ben ona göre.????????', '1', '0', '8', 'img/indir (1).jpg', '');
INSERT INTO `kayitbilgi` VALUES ('42', 'Slazer_XQ', 'şeyh said', 'kürdo', 'modulatorhotmailozryandex@gmail.com', '818f9c45cfa30eeff277ef38bcbe9910', 'img/indir (1).jpg', 'bremın', '0', '0', '0', 'img/indir (1).jpg', '');
INSERT INTO `kayitbilgi` VALUES ('44', 'admin', null, null, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'img/blank-profile-picture-973460_1280.png', 'Merhaba', '1', '0', '4', 'img/tree-736885_1280', '(Admin)');
INSERT INTO `kayitbilgi` VALUES ('46', 'HZKedilfs', 'Eşşek', 'kan', 'kedi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'img/blank-profile-picture-973460_1280.png', 'Merhaba', '10', '22', '2', 'img/indir (2).jpg', '');
INSERT INTO `kayitbilgi` VALUES ('47', 'Legande', null, null, 'legande@gmail.com', 'f9434e5988828d08592128e1fb5d02ec', 'img/blank-profile-picture-973460_1280.png', 'Merhaba', '0', '0', '1', 'img/tree-736885_1280.jpg', '(Üst Yetkili)');
INSERT INTO `kayitbilgi` VALUES ('49', 'ENES', null, null, 'hsajdhsa@gmail.com', 'ad57484016654da87125db86f4227ea3', 'img/blank-profile-picture-973460_1280.png', 'Merhaba', '0', '0', '1', 'img/tree-736885_1280.jpg', '(Üye)');
INSERT INTO `kayitbilgi` VALUES ('51', 'Taner', null, null, 'taner@gmail.com', '796591871866f242684c65ed5a57c04d', 'img/blank-profile-picture-973460_1280.png', 'Merhaba', '0', '0', '0', 'img/tree-736885_1280.jpg', '(Admin)');

-- ----------------------------
-- Table structure for `raporoneri`
-- ----------------------------
DROP TABLE IF EXISTS `raporoneri`;
CREATE TABLE `raporoneri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mesaj` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of raporoneri
-- ----------------------------

-- ----------------------------
-- Table structure for `roller`
-- ----------------------------
DROP TABLE IF EXISTS `roller`;
CREATE TABLE `roller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of roller
-- ----------------------------
INSERT INTO `roller` VALUES ('1', 'Admin');
INSERT INTO `roller` VALUES ('4', 'Üst yetkili');
INSERT INTO `roller` VALUES ('5', 'Üye');

-- ----------------------------
-- Table structure for `sohbet`
-- ----------------------------
DROP TABLE IF EXISTS `sohbet`;
CREATE TABLE `sohbet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alici_id` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `gonderici_id` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `mesaj` text CHARACTER SET utf8 DEFAULT NULL,
  `tarih` varchar(5) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sohbet
-- ----------------------------
INSERT INTO `sohbet` VALUES ('231', 'HZKedilfs', 'er', 'opoo', '20:59');
INSERT INTO `sohbet` VALUES ('232', 'HZKedilfs', 'er', 'yaaa', '20:59');
INSERT INTO `sohbet` VALUES ('233', 'HZKedilfs', 'er', 'yapama ya', '20:59');
INSERT INTO `sohbet` VALUES ('234', 'xxbabapıro69xxx', 'er', 'olamz ', '20:59');
INSERT INTO `sohbet` VALUES ('235', 'xxbabapıro69xxx', 'er', 'olamaz', '21:00');
INSERT INTO `sohbet` VALUES ('236', 'sa', 'er', 'Merhaba', '21:54');
INSERT INTO `sohbet` VALUES ('237', 'sa', 'er', 'Merhaba', '21:54');
INSERT INTO `sohbet` VALUES ('238', 'sa', 'er', 'Merhaba', '21:56');
INSERT INTO `sohbet` VALUES ('239', 'sa', 'er', 'Napıyon kral', '21:58');
INSERT INTO `sohbet` VALUES ('240', 'sa', 'er', 'iyi', '22:00');
INSERT INTO `sohbet` VALUES ('241', 'sa', 'er', 'dsf', '22:01');
INSERT INTO `sohbet` VALUES ('242', 'sa', 'er', 'Deneme', '22:03');
INSERT INTO `sohbet` VALUES ('243', 'sa', 'er', 'Demene 2', '22:03');
INSERT INTO `sohbet` VALUES ('244', 'sa', 'er', 'Demene 3', '22:04');
INSERT INTO `sohbet` VALUES ('245', 'sa', 'er', 'Deneme 4', '22:42');
INSERT INTO `sohbet` VALUES ('246', 'er', 'sa', 'sd', '22:46');
INSERT INTO `sohbet` VALUES ('247', 'sa', 'er', 'sad', '22:46');
INSERT INTO `sohbet` VALUES ('248', 'sa', 'er', 'sdf', '22:46');
INSERT INTO `sohbet` VALUES ('249', 'sa', 'er', 'fgd', '22:46');
INSERT INTO `sohbet` VALUES ('250', 'sa', 'er', 'ret', '22:47');
INSERT INTO `sohbet` VALUES ('251', 'sa', 'er', 'ergdfgd', '22:47');
INSERT INTO `sohbet` VALUES ('252', 'sa', 'er', 'gfh', '22:47');
INSERT INTO `sohbet` VALUES ('253', 'sa', 'er', 'sdf', '22:48');
INSERT INTO `sohbet` VALUES ('254', 'er', 'Legande', 'olm adam ol seni banlarım', '23:04');
INSERT INTO `sohbet` VALUES ('255', 'Legande', 'er', 'niye la naptım', '23:05');
INSERT INTO `sohbet` VALUES ('256', 'er', 'Legande', 'şaka la ağlama hemen', '23:05');
INSERT INTO `sohbet` VALUES ('257', 'Legande', 'er', 'sg yavşak', '23:06');
INSERT INTO `sohbet` VALUES ('258', 'er', 'Legande', 'Banlandın', '23:06');
INSERT INTO `sohbet` VALUES ('259', 'HZKedilfs', 'er', 'ben bir sana yanarım', '23:07');
INSERT INTO `sohbet` VALUES ('260', 'HZKedilfs', 'admin', 'sa', '15:12');
INSERT INTO `sohbet` VALUES ('261', 'admin', 'HZKedilfs', 'as bro kimsin aq', '15:15');
INSERT INTO `sohbet` VALUES ('262', 'HZKedilfs', 'admin', 'olm aqlu maqlum konuşma ismime bak yerim seni', '15:15');
INSERT INTO `sohbet` VALUES ('263', 'admin', 'HZKedilfs', 'hÖÖÖ tam ne istiyon ', '15:15');
INSERT INTO `sohbet` VALUES ('264', 'HZKedilfs', 'admin', 'he şöle adam ol dicektim', '15:16');
INSERT INTO `sohbet` VALUES ('265', 'admin', 'HZKedilfs', 'ığğğğ', '15:16');
INSERT INTO `sohbet` VALUES ('266', 'HZKedilfs', 'admin', 'şimdi sg yoksa banlarım', '15:16');
INSERT INTO `sohbet` VALUES ('267', 'admin', 'HZKedilfs', 'tam ?', '15:16');
INSERT INTO `sohbet` VALUES ('268', 'admin', 'HZKedilfs', 'tam ?', '15:17');
INSERT INTO `sohbet` VALUES ('269', 'admin', 'HZKedilfs', 'tm ?', '15:17');
INSERT INTO `sohbet` VALUES ('270', 'admin', 'HZKedilfs', 'lan göt', '16:59');
INSERT INTO `sohbet` VALUES ('271', 'admin', 'HZKedilfs', 'bak bi hele bişey dicem', '17:04');
INSERT INTO `sohbet` VALUES ('272', 'admin', 'HZKedilfs', 'sayın admin bey bir dakikanızı ayırıp yazdığım mesajlara bakabilirmisiniz acaba beni çok mutlu edersiniz❤️ ', '17:08');
INSERT INTO `sohbet` VALUES ('273', 'HZKedilfs', 'admin', 'Buyrun efendim sizi dinliyorum', '17:16');
INSERT INTO `sohbet` VALUES ('274', 'HZKedilfs', 'er', 'sad', '21:46');
INSERT INTO `sohbet` VALUES ('275', 'HZKedilfs', 'er', 'sdf', '21:46');
INSERT INTO `sohbet` VALUES ('276', 'HZKedilfs', 'er', 'dfgdfg', '21:46');

-- ----------------------------
-- Table structure for `tartisma`
-- ----------------------------
DROP TABLE IF EXISTS `tartisma`;
CREATE TABLE `tartisma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` varchar(50) DEFAULT NULL,
  `img` varchar(1500) DEFAULT NULL,
  `yazi` varchar(10000) DEFAULT '',
  `baslik` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `begeni` int(10) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tartisma
-- ----------------------------
INSERT INTO `tartisma` VALUES ('96', 'Legande', 'img/', 'FKO çok gizli bir örgüttür ve hakkında bildiklerimiz oldukça kısıtlıdır ama kısaca amaçlarının antik ve unutulmuş bir dini tekrar dünyaya egemen kılmak ve Afrika boynuzu ülkelerini birleştirmek olduğunu söyleyebiliriz. Kendilerine yapılan operasyonlarda ele geçirilen el yazmaları ve tablolardan kendilerinin kadim bir Fil tanrısına taptıklarını söyleyebiliriz ismininde “Necati” olduğunu tahmin ediyoruz anlamını tam olarak bilemesekte antik shiva dilinden geldiği düşünülmekte. Nasıl ve ne zaman kurulduğuda gene bir gizem konusudur bazıları 2.dünya savaşından hemen sonra Uganda da bağımsızlık için mücadele veren gruplardan biri olarak kurulduğu düşünülüyor ama bazıları kuruluşlarını 17.yy la kadar dayandırıyor ama kesin olan bir şey varsa kendilerinin 20.yy da birleşmiş milletler ve abd hükümeti ile pek çok sıcak çatışmaya girdiğidir bu çatışmaların en kanlısı ise somalideki necatist FKO gerillarına karşı yapılan mogadişu operasyonudur operasyon FKO gerillalarının yoğun direnişi sayesinde kesin FKO zaferi ile sonuçlanmıştır ve abd ye pek çok kayıp verdirtmişlerdir ama kayıp sayıları medyadan gizlenmiştir. FKO ile ilgili araştırmalarımız hala sürmektedir', 'FKO floodu', 'Flood', '2');
INSERT INTO `tartisma` VALUES ('97', 're', 'img/', 'cennete gittin uzattin ayaklari yatiyon Hz.Ebubekir geldi mecbur ayaga kalkip saygi göstericen bir daha yattin Hz.Ali geldi yine kalkican ama cehennem oyle mi uzattın ayaklari ohhh sıcacık yatiyon Ebu Cehil geldi Ebu Cehilin aq yat asagi devam et', 'Ben cennete gittmek istemiyorum ya', 'Flood', '0');
INSERT INTO `tartisma` VALUES ('99', 'as', 'img/', 'Başlığı gördüm ve üzerinde çok düşündüm… ???? Acaba bu uzun yazıyı mı okusam yoksa 31 mi çeksem diye…????Sonra karar verdim ki önce hiphizli bir otuzbir çekeceğim kronometre ile…⏱️ Sonra yazıyı okuyacağım yine kronometre tutup… Şuan bu yazıyı yazarken cinsel pipimi kaldırdım ve speedrun ı birazdan başlayacağım…????????????', 'Okusam mı okumasam mı ikilemi', 'Flood', '0');
INSERT INTO `tartisma` VALUES ('100', 'as', 'img/KAAN.jpg', 'Milli muharip uçağı KAAN\'ın 21 Şubat\'ta başarıyla gerçekleştirdiği ilk uçuşun ardından dünya basınında Türkiye\'nin savunma sanayisindeki atılımlara olan ilgi ve övgü devam ediyor.\r\n\r\nİspanya\'da savunma alanında haber yapan internet siteleri, KAAN ile ilgili haberlerini sürdürdü.\r\n\r\n\"Defensa.com\" adlı internet sitesi, \"Türk Hava Kuvvetlerinin gelecekteki muharip uçağı ilk uçuşunu yaptı\" başlığıyla verdiği haberde, \"Bu, Türk sanayisinin, Türk Havacılık ve Uzay Sanayii AŞ\'nin liderliğinde, uluslararası alanda (hayalet) olarak tanımlanan 5\'inci nesil savaş uçağı ve radar görünmezlik yeteneklerini geliştirmeye yönelik iddialı projesi kapsamında çok önemli bir adımdır\" yorumu yapıldı.\r\n\r\nKAAN\'ın üretim aşamalarının ve gelecek projelerinin aktarıldığı haberde, \"Uçağın nihai hedefi, Türkiye\'yi 5\'inci nesil savaş uçağı üretebilecek altyapı ve teknolojiye sahip sayılı ülkelerden biri haline getirmek.\" ifadesi kullanıldı.\r\n\r\n\"Aviacionline.com\" sitesi de \"KAAN, 5. nesil Türk savaş uçağı ilk uçuşunu yaptı\" başlığıyla verdiği haberde, \"KAAN\'ın F-35 gibi 5. nesil uçaklar arasında 1. blokta yer alacağını, uluslararası pazarlarda büyük ilgi göreceğini, rakip modellerin üstün özelliklere sahip olacağını, milli tasarımlı motorun üretime girdiğinde ABD\'li modellerden arındırılacağını ve Pakistan gibi bazı ülkelerin şimdiden büyük ilgi gösterdiğini\" yazdı.', 'Dünya basınında milli muharip uçağı KAAN\'a ilgi ve övgü devam ediyor', 'Gündem', '0');
INSERT INTO `tartisma` VALUES ('101', 'Legande', 'img/tramvay-kaza-vk3g_cover.jpg.webp', 'Bağcılar\'dan Kabataş istikametine seyir halindeki tramvay, Topkapı mevkisinde bir kişiye çarptı.\r\n\r\nÇevredekilerin ihbarı üzerine olay yerine polis, sağlık ve itfaiye ekipleri sevk edildi.\r\n\r\nSağlık ekiplerince yapılan incelemede, tramvayın çarptığı kişinin hayatını kaybettiği belirlendi.\r\n\r\nKaza nedeniyle tramvay seferleri Kabataş-Çapa ve Cevizlibağ-Bağcılar istasyonları arasında yapılıyor.', 'İstanbul\'da tramvayın altında kalan kişi hayatını kaybetti', 'Gündem', '0');
INSERT INTO `tartisma` VALUES ('102', 'Legande', 'img/', 'Ben Muhammed eren namı diğer Legande.', 'Merhaba', 'Tanışma', '0');
INSERT INTO `tartisma` VALUES ('129', 'HZKedilfs', 'img/', 's ve j’nin kadim dostluğu çok eskiye dayanır. bir gün uzak dünyada eski zamanlarda birbirine rakip iki köy varmış. bir köyde s ve ailesi, diğer köyde j ve dostları varmış. bir gün iki köy arasındaki gerginlik giderek artmış. öyle ki bu iki köy arasında ev, bahçe yakmalara kadar uzamış. ilk köyden yani s nin yaşadığı köyden bir kişi j’nin yaşadığı köye gelmiş. bu duruma bir son vermeye çalışmış. fakat j’nin yaşadığı köydeki halk s’den gelen kişiyi idam etmiş. bunun üzerine j’nin yaşadığı köy savaşa hazırlanmış. iki tarafta birbirlerinin köyüne ajanlar yollamış. savaş günü gelip çattığında ise s ailesinin adına savaşa gitmeye karar vermiş. j ise dostlarıyla çarpışmaya karar vermiş. ilk saldırıyı s’nin yaşadığı köy yapmış. j’nin dostlarından bir tanesi ise bu saldırıda ölmüş. j ve arkadaşları onun için bir cenaze bile hazırlayamamışken saldırıya geçmeye başlamış. savaş 1 hafta sürmüş. iki köy de fazlasıyla zararda çıkmış. kazanılanlar ve kaybedilenlerin arasında açık bir ara olduğu bu savaşın son damlaları gelmiş. j bir arkadaşı ile kalmış. s ise ailesini korumak adına hala hayattaymış. iki tarafta dinlenirken j arkadaşıyla konuşmaya başlamış. arkadaşı ” bu savaşı saldırarak veya savunarak kazanamayız. iki tarafın da anlaşması gerekiyor.” demiş. s ise ailesiyle konuşmuş ve j’nin arkadaşının önerisinde bulunmuşlar. ertesi gün savaşın bitmesi gereken gündü. bir taraf galip olacaktı. fakat j öne çıkarak iki köy arasındaki savaşta yüksek seslerle bağırmaya çalışmış. “savaşı bitirelim dostluk kuralım!” fakat kimse onu duymak istememiş. s ise j’nin çığlıklarına karşılık vererek ona katılmış. savaşta iki köy de farklı köylerden iki kişinin beraber olduğunu görünce savaşı durdurmuş. onların seslerine kulak vermişler. iki köy de verilen kayıplardan muzdarip olup savaşı bitirme kararı almış. j dostları anısına s’nin olduğu köye bir anıt yaptırmış. bu anıt bu savaşın unutulmaması için zaman boyunca orada kalmış. işte böylelikle s ve j’nin kadim dostluğu başlamış.', 's ve j’nin kadim dostluğu ', 'Gündem', '22');
INSERT INTO `tartisma` VALUES ('135', 'er', 'img/', 'sdf', 'df', 'Gündem', '1');

-- ----------------------------
-- Table structure for `yanit`
-- ----------------------------
DROP TABLE IF EXISTS `yanit`;
CREATE TABLE `yanit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mesaj` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `sohbetisim` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of yanit
-- ----------------------------
INSERT INTO `yanit` VALUES ('56', 'HZKedilfs', 'dfs', null);

-- ----------------------------
-- Table structure for `yorumlar`
-- ----------------------------
DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` varchar(100) DEFAULT NULL,
  `yorum` varchar(500) DEFAULT NULL,
  `makaleid` varchar(100) DEFAULT '',
  `ust_yorum` varchar(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of yorumlar
-- ----------------------------
INSERT INTO `yorumlar` VALUES ('143', 'sa', 'sdf', '130', '0');
INSERT INTO `yorumlar` VALUES ('144', 'sa', 'as', '130', '143');
INSERT INTO `yorumlar` VALUES ('145', 'er', 'sdf', '130', '143');
INSERT INTO `yorumlar` VALUES ('146', 'er', 'sa', '130', '143');
INSERT INTO `yorumlar` VALUES ('147', 'er', 'sa', '130', '143');
INSERT INTO `yorumlar` VALUES ('148', 'sa', 'sa', '130', '143');
INSERT INTO `yorumlar` VALUES ('149', 'sa', 'amk', '130', '0');
INSERT INTO `yorumlar` VALUES ('150', 'sa', 'bende senin', '130', '149');
INSERT INTO `yorumlar` VALUES ('151', 'sa', 'Kes lan', '130', '149');
INSERT INTO `yorumlar` VALUES ('152', 'sa', 'as', '130', '143');
INSERT INTO `yorumlar` VALUES ('153', 'sa', 'ahaa', '130', '149');
INSERT INTO `yorumlar` VALUES ('154', 'sa', 'evvet', '130', '0');
INSERT INTO `yorumlar` VALUES ('156', 'er', 'Hadi lan ordan neresi kral', '129', '155');
INSERT INTO `yorumlar` VALUES ('158', 'er', 'şaka', '128', '157');
INSERT INTO `yorumlar` VALUES ('159', 'er', 'yok', '130', '154');
INSERT INTO `yorumlar` VALUES ('160', 'HZKedilfs', 'Aynene(Yankılı)', '102', '0');
INSERT INTO `yorumlar` VALUES ('161', 'admin', 'fg', '129', '0');
INSERT INTO `yorumlar` VALUES ('165', 'admin', 'bay bay', '129', '0');
INSERT INTO `yorumlar` VALUES ('168', 'admin', 'öm', '129', '0');
