		TRUNCATE `membcontrolor`;
		TRUNCATE `buyproduct`;
		DELETE FROM `order` WHERE `orderid`>0;
		ALTER TABLE `order` AUTO_INCREMENT =1;
		ALTER TABLE `buyproduct` DROP FOREIGN KEY `prodORFK` ;
		ALTER TABLE `buyproduct` DROP FOREIGN KEY `prodIDFK` ;
		ALTER TABLE `order` AUTO_INCREMENT = 1;
		ALTER TABLE `membcontrolor` DROP FOREIGN KEY `memodIDFK` ;
		ALTER TABLE `membcontrolor` DROP FOREIGN KEY `membIDFK` ;
		TRUNCATE `order`;


		ALTER TABLE `buyproduct`
		ADD CONSTRAINT `prodIDFK` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE,
		ADD CONSTRAINT `prodORFK` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE;

		ALTER TABLE `membcontrolor`
		ADD CONSTRAINT `membIDFK` FOREIGN KEY (`memberid`) REFERENCES `member_staff` (`memberid`),
		ADD CONSTRAINT `memodIDFK` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE