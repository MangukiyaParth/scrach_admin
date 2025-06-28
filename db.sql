/*Table structure for table `account_delete_request` */

DROP TABLE IF EXISTS `account_delete_request`;

CREATE TABLE `account_delete_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `account_delete_request` */

/*Table structure for table `admin_setting` */

DROP TABLE IF EXISTS `admin_setting`;

CREATE TABLE `admin_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(255) DEFAULT NULL,
  `offer_secret_key` varchar(255) DEFAULT NULL,
  `cpx_postback` varchar(255) DEFAULT NULL,
  `onesignal_appid` varchar(255) DEFAULT NULL,
  `onesignal_restapi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `admin_setting` */

insert  into `admin_setting`(`id`,`api_key`,`offer_secret_key`,`cpx_postback`,`onesignal_appid`,`onesignal_restapi`) values (1,'dvkMceTkNUrVNLAWDldabvkBvEWtNf','Mrpe7bvGte1ExoW','status={status}&trans_id={trans_id}&user_id={user_id}&amount_local={amount_local}&amount_usd={amount_usd}&offer_id={offer_ID}&ip_click={ip_click}\n',NULL,NULL);

/*Table structure for table `app_setting` */

DROP TABLE IF EXISTS `app_setting`;

CREATE TABLE `app_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spinlimit` varchar(255) NOT NULL,
  `scratch_limit` int(11) NOT NULL DEFAULT 10,
  `scratch_coin` varchar(255) NOT NULL DEFAULT '10,30',
  `referral_points` varchar(255) NOT NULL,
  `rewardvideo_point` varchar(255) NOT NULL,
  `dailycheckin_point` varchar(10) NOT NULL,
  `firebase_key` varchar(255) NOT NULL,
  `bonus` varchar(255) DEFAULT NULL,
  `one_device` varchar(255) NOT NULL DEFAULT 'true',
  `one_ip` varchar(255) NOT NULL DEFAULT '3',
  `isVpn` varchar(255) DEFAULT 'false',
  `game_coin` varchar(255) NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_setting` */

insert  into `app_setting`(`id`,`spinlimit`,`scratch_limit`,`scratch_coin`,`referral_points`,`rewardvideo_point`,`dailycheckin_point`,`firebase_key`,`bonus`,`one_device`,`one_ip`,`isVpn`,`game_coin`) values (1,'30',10,'10,30','100','15','20','Hhhhbb','500','false','3','true','5');

/*Table structure for table `appsname` */

DROP TABLE IF EXISTS `appsname`;

CREATE TABLE `appsname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `points` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `url` varchar(255) NOT NULL,
  `appurl` varchar(255) NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `appsname` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `refferal_id` varchar(255) DEFAULT NULL,
  `from_refer` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'email',
  `profile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` varchar(255) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 0,
  `spn` int(11) NOT NULL DEFAULT 0,
  `dcheck` varchar(255) DEFAULT NULL,
  `web` int(11) DEFAULT 0,
  `td` varchar(255) NOT NULL DEFAULT '2022-17-08',
  `math` int(11) NOT NULL DEFAULT 0,
  `video` int(11) NOT NULL DEFAULT 0,
  `scratch` int(11) NOT NULL DEFAULT 0,
  `banned_time` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `emailVerified` varchar(255) DEFAULT 'false',
  `deletion_request` tinyint(4) DEFAULT 0,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `customer` */

/*Table structure for table `daily_points` */

DROP TABLE IF EXISTS `daily_points`;

CREATE TABLE `daily_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `daily_points` */

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `role_edit` varchar(255) NOT NULL DEFAULT 'false',
  `role_create` varchar(255) NOT NULL DEFAULT 'false',
  `role_delete` varchar(255) NOT NULL DEFAULT 'false',
  `role_user` varchar(255) NOT NULL DEFAULT 'false',
  `role_setting` varchar(255) NOT NULL DEFAULT 'false',
  `licence` varchar(255) DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `employees` */

insert  into `employees`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`status`,`role_edit`,`role_create`,`role_delete`,`role_user`,`role_setting`,`licence`,`package`) values (3,'sumer','admin@gmail.com','$2y$10$kfNf0kHBT0NbQr5RSu..TevofErcH0OH7kuEQPioOdzy0aNq.bmsa','2021-03-18 09:33:03','2024-08-05 10:58:01',NULL,'true','true','true','true','true','Njc1ODE4MTU=','Y29tLmFwcC5yZXdhcmRhcHA=');

/*Table structure for table `lang` */

DROP TABLE IF EXISTS `lang`;

CREATE TABLE `lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `lang` */

insert  into `lang`(`id`,`code`,`title`,`image`,`status`) values (1,'en','English','icusa_1705496076.png',0),(3,'es','Spanish','spain_1705496170.png',0),(4,'tr','Turkey','icturkey_1705496123.png',0),(5,'ar','Arabic','1200pxFlagoftheArabiclanguagesvg_1719912685.png',0);

/*Table structure for table `lang_text` */

DROP TABLE IF EXISTS `lang_text`;

CREATE TABLE `lang_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(255) NOT NULL DEFAULT 'en',
  `txt_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `txt_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=875 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `lang_text` */

insert  into `lang_text`(`id`,`lang`,`txt_key`,`txt_value`,`type`) values (659,'en','something_went_wrong','Something Went wrong.','server'),(660,'en','incorrect_password','Incorrent Password.','server'),(661,'en','email_not_found','Email Not Found.','server'),(662,'en','account_already_exist','Account Already Exist!','server'),(663,'en','account_already_exist_with','Account Already Exist with','server'),(664,'en','username_taken','Username has already taken !','server'),(665,'en','email_taken','Email has already taken !','server'),(666,'en','phone_taken','Phone Number has already taken !','server'),(667,'en','account_create_error','Error while create account!','server'),(668,'en','account_belong_to_other_login','Oops the account belong to normal email password.','server'),(669,'en','account_connected_with_google','Account Connected with google account please login using google','server'),(670,'en','otp_sent_to_mail','Otp Sended To Your Mail','server'),(671,'en','password_update_login_now','Password Updated Successfully Login Now','server'),(672,'en','error_to_update_pass','Error to Update Password','server'),(673,'en','profile_update_success','Profile Update successfully.','server'),(674,'en','password_update_succes','Password Update successfully.','server'),(675,'en','email_has_been_sent_check_inbox','Email has been sent. Please check your mail and also spam folder !!','server'),(676,'en','cant_use_self_refer','You Cant Use your own refer code!!','server'),(677,'en','coin_credit_from','Coin Credit From','server'),(678,'en','bonus_claim_success','Bonus Claimed Successfully!!','server'),(679,'en','bonus_already_claimed','Bonus Already Claimed!!','server'),(680,'en','bonus_received','Bonus Received','server'),(681,'en','today_daily_bonus_already_claimed','Today Daily Bonus Already Claimed','server'),(682,'en','today_task_limit_completed','Today Task Limit Completed','server'),(683,'en','today_no_task_left','Today No Task Left','server'),(684,'en','game_point_already_claimed','This Game Point Already Claimed Today','server'),(685,'en','redeem_successfully','Redeem Successfully !','server'),(686,'en','not_enough_coin','Not Enough Coin!!','server'),(687,'en','data_not_found','data not found!!','server'),(688,'en','enter_valid_refer_code','Please Enter Valid Refer Code!!','server'),(689,'en','old_password_not_correct','Old password is not correct.','server'),(690,'en','daily_bonus_remark','Daily checkin Bonus','server'),(691,'en','spin_bonus_remark','Lucky Spin Bonus','server'),(692,'en','scratch_bonus_remark','Scratch Card Bonus','server'),(693,'en','video_bonus_remark','Video Tutorial Watched','server'),(694,'en','article_bonus_remark','Article Read Bonus','server'),(695,'en','offer_bonus_remark','Offers Completed Bonus','server'),(696,'en','redeem_remark','Coin Withdrawal!!','server'),(697,'en','game_remark','Game Bonus!','server'),(698,'en','quiz_remark','Math Quiz Bonus!','server'),(739,'es','something_went_wrong','Algo salió mal.','server'),(740,'es','incorrect_password','Incorrect Password.','server'),(741,'es','email_not_found','El correo electrónico no encontrado.','server'),(742,'es','account_already_exist','¡La cuenta ya existe!','server'),(743,'es','account_already_exist_with','La cuenta ya existe con','server'),(744,'es','username_taken','¡El nombre de usuario ya está en uso!','server'),(745,'es','email_taken','¡El correo electrónico ya ha sido recibido!','server'),(746,'es','phone_taken','¡El número de teléfono ya ha sido ocupado!','server'),(747,'es','account_create_error','¡Error al crear la cuenta!','server'),(748,'es','account_belong_to_other_login','Vaya, la cuenta pertenece a la contraseña de correo electrónico normal.','server'),(749,'es','account_connected_with_google','Cuenta conectada con una cuenta de Google. Inicie sesión con Google.','server'),(750,'es','otp_sent_to_mail','Otp Enviar a tu correo','server'),(751,'es','password_update_login_now','Contraseña actualizada exitosamente Inicie sesión ahora','server'),(752,'es','error_to_update_pass','Error al actualizar la contraseña','server'),(753,'es','profile_update_success','Actualización de perfil exitosa.','server'),(754,'es','password_update_succes','Actualización de contraseña exitosa.','server'),(755,'es','email_has_been_sent_check_inbox','E-mail ha sido enviado. ¡¡Por favor revisa tu correo y también la carpeta de spam!!','server'),(756,'es','cant_use_self_refer','¡¡No puedes usar tu propio código de referencia!!','server'),(757,'es','coin_credit_from','Crédito de monedas desde','server'),(758,'es','bonus_claim_success','¡¡Bono reclamado con éxito!!','server'),(759,'es','bonus_already_claimed','Límite de tareas de hoy completado','server'),(760,'es','bonus_received','Bonificación recibida','server'),(761,'es','today_daily_bonus_already_claimed','Bono diario de hoy ya reclamado','server'),(762,'es','today_task_limit_completed','hahggggggggggggggg','server'),(763,'es','today_no_task_left','Hoy no queda ninguna tarea','server'),(764,'es','game_point_already_claimed','Este punto de juego ya se ha reclamado hoy','server'),(765,'es','redeem_successfully','¡Canjee con éxito!','server'),(766,'es','not_enough_coin','¡¡No hay suficientes monedas!!','server'),(767,'es','data_not_found','¡¡Datos no encontrados!!','server'),(768,'es','enter_valid_refer_code','¡Ingrese un código de referencia válido!','server'),(769,'es','old_password_not_correct','La contraseña anterior no es correcta.','server'),(770,'es','daily_bonus_remark','Bonificación por check-in diario','server'),(771,'es','spin_bonus_remark','Bono de giro de la suerte','server'),(772,'es','scratch_bonus_remark','Bono de tarjeta rasca y gana','server'),(773,'es','video_bonus_remark','Vídeo tutorial visto','server'),(774,'es','article_bonus_remark','Bono de lectura de artículo','server'),(775,'es','offer_bonus_remark','Ofertas de bonificación completadas','server'),(776,'es','redeem_remark','Retiro de monedas!!','server'),(777,'es','game_remark','¡Bono de juego!','server'),(778,'es','quiz_remark','¡Bono de prueba de matemáticas!','server'),(779,'tr','something_went_wrong','Bir şeyler yanlış gitti.','server'),(780,'tr','incorrect_password','Yanlış parola.','server'),(781,'tr','email_not_found','Email bulunamadı.','server'),(782,'tr','account_already_exist','Hesap Zaten Mevcut!','server'),(783,'tr','account_already_exist_with','Hesap Zaten Mevcut','server'),(784,'tr','username_taken','Kullanıcı adı zaten alınmış!','server'),(785,'tr','email_taken','E-posta zaten alınmış!','server'),(786,'tr','phone_taken','Telefon Numarası zaten alınmış!','server'),(787,'tr','account_create_error','Hesap oluştururken hata oluştu!','server'),(788,'tr','account_belong_to_other_login','Hata! Hesap normal e-posta şifresine ait.','server'),(789,'tr','account_connected_with_google','Hesap Google hesabına bağlı lütfen google\'ı kullanarak giriş yapın','server'),(790,'tr','otp_sent_to_mail','Otp Postanıza Gönderildi','server'),(791,'tr','password_update_login_now','Şifre Başarıyla Güncellendi Şimdi Giriş Yapın','server'),(792,'tr','error_to_update_pass','Şifre Güncelleme Hatası','server'),(793,'tr','profile_update_success','Profil Güncelleme başarıyla tamamlandı.','server'),(794,'tr','password_update_succes','Şifre Güncelleme başarıyla tamamlandı.','server'),(795,'tr','email_has_been_sent_check_inbox','Mail gönderildi. Lütfen e-postanızı ve spam klasörünüzü de kontrol edin!!','server'),(796,'tr','cant_use_self_refer','Kendi referans kodunuzu kullanamazsınız!!','server'),(797,'tr','coin_credit_from','Koin Kredisi','server'),(798,'tr','bonus_claim_success','Bonus Başarıyla Alındı!!','server'),(799,'tr','bonus_already_claimed','Bonus Zaten Talep Edildi!!','server'),(800,'tr','bonus_received','Alınan Bonus','server'),(801,'tr','today_daily_bonus_already_claimed','Bugünün Günlük Bonusu Zaten Talep Edildi','server'),(802,'tr','today_task_limit_completed','Bugün Görev Limiti Tamamlandı','server'),(803,'tr','today_no_task_left','Bugün Hiçbir Görev Kalmadı','server'),(804,'tr','game_point_already_claimed','Bu Oyun Noktası Bugün Zaten Hak Kazandı','server'),(805,'tr','redeem_successfully','Başarıyla Kullanın!','server'),(806,'tr','not_enough_coin','Yeterli Para Yok!!','server'),(807,'tr','data_not_found','veri bulunamadı!!','server'),(808,'tr','enter_valid_refer_code','Lütfen Geçerli Başvuru Kodunu Girin!!','server'),(809,'tr','old_password_not_correct','Eski şifre doğru değil.','server'),(810,'tr','daily_bonus_remark','Günlük check-in Bonusu','server'),(811,'tr','spin_bonus_remark','Şanslı Döndürme Bonusu','server'),(812,'tr','scratch_bonus_remark','Kazı Kazan Bonusu','server'),(813,'tr','video_bonus_remark','Video Eğitimi İzlendi','server'),(814,'tr','article_bonus_remark','Makale Okuma Bonusu','server'),(815,'tr','offer_bonus_remark','Tamamlanan Bonus Teklifleri','server'),(816,'tr','redeem_remark','Para Çekme!!','server'),(817,'tr','game_remark','Oyun Açıklama Bonusu','server'),(818,'tr','quiz_remark','Matematik Sınavı Bonusu!','server'),(819,'en','offer_Already_Submited','Offer Already Submitted','server'),(821,'es','offer_Already_Submited','Oferta ya enviada','server'),(822,'tr','offer_Already_Submited','Teklif Zaten Gönderildi','server'),(823,'en','Oops_you_are_late_offer_limit_has_been_completed','Oops you are late Offer limit has been completed','server'),(825,'es','Oops_you_are_late_offer_limit_has_been_completed','Vaya, llegas tarde. El límite de la oferta se ha completado.','server'),(826,'tr','Oops_you_are_late_offer_limit_has_been_completed','Hata! Geç kaldınız Teklif limiti tamamlandı','server'),(827,'en','Offer_Submit_Successfully_Bonus_will_be_receive_after_verification','Offer Submit Successfully Bonus will be receive after verification','server'),(829,'es','Offer_Submit_Successfully_Bonus_will_be_receive_after_verification','La oferta se envió correctamente. La bonificación se recibirá después de la verificación.','server'),(830,'tr','Offer_Submit_Successfully_Bonus_will_be_receive_after_verification','Teklif Başarıyla Gönderildi Bonus, doğrulamanın ardından alınacak','server'),(831,'en','hot_offer_approved','Your Offer has been approved and coin are credited','server'),(832,'ar','something_went_wrong','هناك خطأ ما.','server'),(833,'ar','incorrect_password','كلمة السر الحالية.','server'),(834,'ar','email_not_found','البريد الإلكتروني غير موجود.','server'),(835,'ar','account_already_exist','الحساب موجود مسبقا!','server'),(836,'ar','account_already_exist_with','الحساب موجود بالفعل مع','server'),(837,'ar','username_taken','لقد تم أخذ اسم المستخدم بالفعل!','server'),(838,'ar','email_taken','البريد الإلكتروني اتخذت بالفعل !','server'),(839,'ar','phone_taken','لقد تم أخذ رقم الهاتف بالفعل!','server'),(840,'ar','account_create_error','حدث خطأ أثناء إنشاء الحساب!','server'),(841,'ar','account_belong_to_other_login','عفوًا، الحساب ينتمي إلى كلمة مرور البريد الإلكتروني العادية.','server'),(842,'ar','account_connected_with_google','الحساب متصل بحساب جوجل يرجى تسجيل الدخول باستخدام جوجل','server'),(843,'ar','otp_sent_to_mail','تم إرسال Otp إلى بريدك','server'),(844,'ar','password_update_login_now','تم تحديث كلمة المرور بنجاح قم بتسجيل الدخول الآن','server'),(845,'ar','error_to_update_pass','خطأ في تحديث كلمة المرور','server'),(846,'ar','profile_update_success','تم تحديث الملف الشخصي بنجاح.','server'),(847,'ar','password_update_succes','تم تحديث كلمة المرور بنجاح.','server'),(848,'ar','email_has_been_sent_check_inbox','تم ارسال البريد الالكتروني. يرجى التحقق من البريد الخاص بك وأيضا مجلد البريد العشوائي !!','server'),(849,'ar','cant_use_self_refer','لا يمكنك استخدام رمز الإحالة الخاص بك!!','server'),(850,'ar','coin_credit_from','عملة الائتمان من ','server'),(851,'ar','bonus_claim_success','تم المطالبة بالمكافأة بنجاح!!','server'),(852,'ar','bonus_already_claimed','المكافأة تمت المطالبة بها بالفعل!!','server'),(853,'ar','bonus_received','تم استلام المكافأة','server'),(854,'ar','today_daily_bonus_already_claimed','اليوم تمت المطالبة بالمكافأة اليومية بالفعل','server'),(855,'ar','today_task_limit_completed','تم الانتهاء من حد المهمة اليوم','server'),(856,'ar','today_no_task_left','اليوم لم يتبق أي مهمة','server'),(857,'ar','game_point_already_claimed','تمت المطالبة بنقطة اللعبة هذه بالفعل اليوم','server'),(858,'ar','redeem_successfully','تم الاسترداد بنجاح!','server'),(859,'ar','not_enough_coin','لا تكفي العملة!!','server'),(860,'ar','data_not_found','لم يتم العثور على بيانات!!','server'),(861,'ar','enter_valid_refer_code','الرجاء إدخال رمز الإحالة صالح!!','server'),(862,'ar','old_password_not_correct','كلمة المرور القديمة غير صحيحة.','server'),(863,'ar','daily_bonus_remark','مكافأة الفحص اليومي','server'),(864,'ar','spin_bonus_remark','مكافأة لاكي سبين','server'),(865,'ar','scratch_bonus_remark','مكافأة بطاقة الصفر','server'),(866,'ar','video_bonus_remark','تمت مشاهدة الفيديو التعليمي','server'),(867,'ar','article_bonus_remark','مكافأة قراءة المقال','server'),(868,'ar','offer_bonus_remark','عروض المكافأة المكتملة','server'),(869,'ar','redeem_remark','سحب العملة!!','server'),(870,'ar','game_remark','مكافأة اللعبة!','server'),(871,'ar','quiz_remark','مكافأة مسابقة الرياضيات!','server'),(872,'ar','offer_Already_Submited','تم تقديم العرض بالفعل','server'),(873,'ar','Oops_you_are_late_offer_limit_has_been_completed','عفوًا، لقد تأخرت لقد اكتمل حد العرض','server'),(874,'ar','Offer_Submit_Successfully_Bonus_will_be_receive_after_verification','تم إرسال العرض بنجاح سيتم استلام المكافأة بعد التحقق','server');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `visible` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pages` */

insert  into `pages`(`id`,`slug`,`title`,`text`,`visible`) values (1,'privacy-policy','Privacy Policy','<p><strong>Privacy Policy</strong></p>\r\n\r\n<p>This privacy policy applies to the Reward App app (hereby referred to as &quot;Application&quot;) for mobile devices that was created by Developer Name (hereby referred to as &quot;Service Provider&quot;) as a Free service. This service is intended for use &quot;AS IS&quot;.</p>\r\n\r\n<p><br />\r\n<strong>Information Collection and Use</strong></p>\r\n\r\n<p>The Application collects information when you download and use it. This information may include information such as</p>\r\n\r\n<ul>\r\n	<li>Your device&#39;s Internet Protocol address (e.g. IP address)</li>\r\n	<li>The operating system you use on your mobile device</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Application does not gather precise information about the location of your mobile device.</p>\r\n\r\n<p>The Service Provider may use the information you provided to contact you from time to time to provide you with important information, required notices and marketing promotions.</p>\r\n\r\n<p>For a better experience, while using the Application, the Service Provider may require you to provide us with certain personally identifiable information, including but not limited to name,email,ip,device id,phone. The information that the Service Provider request will be retained by them and used as described in this privacy policy.</p>\r\n\r\n<p><br />\r\n<strong>Links to third party sites / services</strong></p>\r\n\r\n<p>Reward App Site/ App may include links to other websites or apps. Such sites are governed by their respective privacy policies, which are beyond our control. Once you click on those links, use of any information you provide is governed by the privacy policy of the operator of the site you are visiting. That policy may differ from ours. If you can&#39;t find the privacy policy of any of these sites via a link from the site&#39;s homepage, you should contact the site directly for more information. Any information you provide directly to a third party merchant; website or application is not covered by this privacy notice. We are not responsible for the privacy or security practices of merchants or other third parties with whom you choose to share your personal information directly. We encourage you to review the privacy policies of any third party to whom you choose to share your personal information directly.</p>\r\n\r\n<p><strong>Information Security</strong></p>\r\n\r\n<p>Reward App has security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. Once your information is in our possession we adhere to strict security guidelines, protecting it against unauthorized access.</p>\r\n\r\n<p><br />\r\n<strong>Data Retention Policy</strong></p>\r\n\r\n<p>The Service Provider will retain User Provided data for as long as you use the Application and for a reasonable time thereafter. If you&#39;d like them to delete User Provided Data that you have provided via the Application, please contact them at email@gmail.com and they will respond in a reasonable time.</p>\r\n\r\n<p><br />\r\n<strong>Security</strong></p>\r\n\r\n<p>The Service Provider is concerned about safeguarding the confidentiality of your information. The Service Provider provides physical, electronic, and procedural safeguards to protect information the Service Provider processes and maintains.</p>\r\n\r\n<p><br />\r\n<strong>Changes</strong></p>\r\n\r\n<p>This Privacy Policy may be updated from time to time for any reason. The Service Provider will notify you of any changes to the Privacy Policy by updating this page with the new Privacy Policy. You are advised to consult this Privacy Policy regularly for any changes, as continued use is deemed approval of all changes.</p>\r\n\r\n<p><br />\r\n<strong>Your Consent</strong></p>\r\n\r\n<p>By using the Application, you are consenting to the processing of your information as set forth in this Privacy Policy now and as amended by us.</p>\r\n\r\n<p><br />\r\n<strong>Contact Us</strong></p>\r\n\r\n<p>If you have any questions regarding privacy while using the Application, or have questions about the practices, please contact the Service Provider via email at email@gmail.com.<br />\r\n&nbsp;</p>\r\n\r\n<p>This privacy policy is effective as of 2024-12-09</p>',0),(2,'terms-conditions','Terms and Condition','<!DOCTYPE html>\r\n    <html>\r\n    <head>\r\n      <meta charset=\'utf-8\'>\r\n      <meta name=\'viewport\' content=\'width=device-width\'>\r\n      <title>Terms &amp; Conditions</title>\r\n      <style> body { font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; padding:1em; } </style>\r\n    </head>\r\n    <body>\r\n    <strong>Terms &amp; Conditions</strong><br><p>These terms and conditions applies to the Reward App app (hereby referred to as \"Application\") for mobile devices that was created by Developer Name (hereby referred to as \"Service Provider\") as a Free service.</p><br><p>Upon downloading or utilizing the Application, you are automatically agreeing to the following terms. It is strongly advised that you thoroughly read and understand these terms prior to using the Application. Unauthorized copying, modification of the Application, any part of the Application, or our trademarks is strictly prohibited. Any attempts to extract the source code of the Application, translate the Application into other languages, or create derivative versions are not permitted. All trademarks, copyrights, database rights, and other intellectual property rights related to the Application remain the property of the Service Provider.</p><br><p>The Service Provider is dedicated to ensuring that the Application is as beneficial and efficient as possible. As such, they reserve the right to modify the Application or charge for their services at any time and for any reason. The Service Provider assures you that any charges for the Application or its services will be clearly communicated to you.</p><br><p>The Application stores and processes personal data that you have provided to the Service Provider in order to provide the Service. It is your responsibility to maintain the security of your phone and access to the Application. The Service Provider strongly advise against jailbreaking or rooting your phone, which involves removing software restrictions and limitations imposed by the official operating system of your device. Such actions could expose your phone to malware, viruses, malicious programs, compromise your phone\'s security features, and may result in the Application not functioning correctly or at all.</p><div><p>Please note that the Application utilizes third-party services that have their own Terms and Conditions. Below are the links to the Terms and Conditions of the third-party service providers used by the Application:</p><ul><li><a href=\"https://policies.google.com/terms\" target=\"_blank\" rel=\"noopener noreferrer\">Google Play Services</a></li><li><a href=\"https://developers.google.com/admob/terms\" target=\"_blank\" rel=\"noopener noreferrer\">AdMob</a></li><li><a href=\"https://www.google.com/analytics/terms/\" target=\"_blank\" rel=\"noopener noreferrer\">Google Analytics for Firebase</a></li><li><a href=\"https://firebase.google.com/terms/crashlytics\" target=\"_blank\" rel=\"noopener noreferrer\">Firebase Crashlytics</a></li><li><a href=\"https://www.facebook.com/legal/terms/plain_text_terms\" target=\"_blank\" rel=\"noopener noreferrer\">Facebook</a></li><!----><!----><!----><!----><!----><!----><li><a href=\"https://unity3d.com/legal/terms-of-service\" target=\"_blank\" rel=\"noopener noreferrer\">Unity</a></li><!----><!----><li><a href=\"https://onesignal.com/tos\" target=\"_blank\" rel=\"noopener noreferrer\">One Signal</a></li><!----><!----><li><a href=\"https://www.applovin.com/terms/\" target=\"_blank\" rel=\"noopener noreferrer\">AppLovin</a></li><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----></ul></div><br><p>Please be aware that the Service Provider does not assume responsibility for certain aspects. Some functions of the Application require an active internet connection, which can be Wi-Fi or provided by your mobile network provider. The Service Provider cannot be held responsible if the Application does not function at full capacity due to lack of access to Wi-Fi or if you have exhausted your data allowance.</p><br><p>If you are using the application outside of a Wi-Fi area, please be aware that your mobile network provider\'s agreement terms still apply. Consequently, you may incur charges from your mobile provider for data usage during the connection to the application, or other third-party charges. By using the application, you accept responsibility for any such charges, including roaming data charges if you use the application outside of your home territory (i.e., region or country) without disabling data roaming. If you are not the bill payer for the device on which you are using the application, they assume that you have obtained permission from the bill payer.</p><br><p>Similarly, the Service Provider cannot always assume responsibility for your usage of the application. For instance, it is your responsibility to ensure that your device remains charged. If your device runs out of battery and you are unable to access the Service, the Service Provider cannot be held responsible.</p><br><p>In terms of the Service Provider\'s responsibility for your use of the application, it is important to note that while they strive to ensure that it is updated and accurate at all times, they do rely on third parties to provide information to them so that they can make it available to you. The Service Provider accepts no liability for any loss, direct or indirect, that you experience as a result of relying entirely on this functionality of the application.</p><br><p>The Service Provider may wish to update the application at some point. The application is currently available as per the requirements for the operating system (and for any additional systems they decide to extend the availability of the application to) may change, and you will need to download the updates if you want to continue using the application. The Service Provider does not guarantee that it will always update the application so that it is relevant to you and/or compatible with the particular operating system version installed on your device. However, you agree to always accept updates to the application when offered to you. The Service Provider may also wish to cease providing the application and may terminate its use at any time without providing termination notice to you. Unless they inform you otherwise, upon any termination, (a) the rights and licenses granted to you in these terms will end; (b) you must cease using the application, and (if necessary) delete it from your device.</p><br><strong>Changes to These Terms and Conditions</strong><p>The Service Provider may periodically update their Terms and Conditions. Therefore, you are advised to review this page regularly for any changes. The Service Provider will notify you of any changes by posting the new Terms and Conditions on this page.</p><br><p>These terms and conditions are effective as of 2024-12-09</p><br><strong>Contact Us</strong><p>If you have any questions or suggestions about the Terms and Conditions, please do not hesitate to contact the Service Provider at email@gmail.com.</p><hr><p>This Terms and Conditions page was generated by <a href=\"https://app-privacy-policy-generator.nisrulz.com/\" target=\"_blank\" rel=\"noopener noreferrer\">App Privacy Policy Generator</a></p>\r\n    </body>\r\n    </html>',0),(3,'account-data-deletion','Account Deletion','<h1><strong>Account Data&nbsp;Deletion</strong></h1>\r\n\r\n<p>for account data delete you need to provide us details realted to your account&nbsp;</p>\r\n\r\n<p><span class=\"marker\"><strong>Share your Name,Account Email on our support email : support@reward.com.</strong></span></p>\r\n\r\n<p>your data will be delete in 7 business days.</p>',0);

/*Table structure for table `password_reset` */

DROP TABLE IF EXISTS `password_reset`;

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `password_reset` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privacy_policy` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `app_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_version` varchar(255) DEFAULT NULL,
  `app_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_email` varchar(15) DEFAULT NULL,
  `app_icon` varchar(255) DEFAULT NULL,
  `app_website` varchar(15) DEFAULT NULL,
  `app_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `startappid` varchar(255) DEFAULT NULL,
  `banner_type` varchar(255) DEFAULT NULL,
  `bannerid` varchar(255) DEFAULT NULL,
  `interstital` varchar(255) DEFAULT NULL,
  `interstital_count` varchar(255) DEFAULT NULL,
  `interstital_ID` varchar(255) DEFAULT NULL,
  `interstital_type` varchar(255) DEFAULT NULL,
  `share_msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `up_msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `up_link` varchar(255) DEFAULT NULL,
  `up_mode` tinyint(2) DEFAULT 0,
  `up_status` varchar(255) DEFAULT NULL,
  `up_version` varchar(255) DEFAULT NULL,
  `up_btn` varchar(255) DEFAULT NULL,
  `nativeType` varchar(255) NOT NULL DEFAULT 'off',
  `nativeCount` int(11) NOT NULL DEFAULT 3,
  `nativeId` varchar(255) DEFAULT NULL,
  `homepage` int(10) NOT NULL DEFAULT 0,
  `ui_style` int(10) NOT NULL DEFAULT 1,
  `offerwall_style` int(11) NOT NULL DEFAULT 0,
  `offerwall_layout` int(10) NOT NULL DEFAULT 0,
  `survey_style` int(10) NOT NULL DEFAULT 0,
  `survey_layout` int(10) NOT NULL DEFAULT 0,
  `adConfig` text NOT NULL DEFAULT '',
  `active_ad` varchar(150) DEFAULT NULL,
  `deactive_ad` varchar(150) DEFAULT NULL,
  `banner` tinyint(1) NOT NULL DEFAULT 0,
  `banner_id` varchar(70) DEFAULT NULL,
  `inter` tinyint(1) NOT NULL DEFAULT 0,
  `inter_id` varchar(70) DEFAULT NULL,
  `native` tinyint(1) NOT NULL DEFAULT 0,
  `native_id` varchar(70) DEFAULT NULL,
  `ad_not_load_credit` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `setting` */

insert  into `setting`(`id`,`privacy_policy`,`app_name`,`app_version`,`app_author`,`app_email`,`app_icon`,`app_website`,`app_description`,`startappid`,`banner_type`,`bannerid`,`interstital`,`interstital_count`,`interstital_ID`,`interstital_type`,`share_msg`,`up_msg`,`up_link`,`up_mode`,`up_status`,`up_version`,`up_btn`,`nativeType`,`nativeCount`,`nativeId`,`homepage`,`ui_style`,`offerwall_style`,`offerwall_layout`,`survey_style`,`survey_layout`,`adConfig`,`active_ad`,`deactive_ad`,`banner`,`banner_id`,`inter`,`inter_id`,`native`,`native_id`,`ad_not_load_credit`) values (1,'https://www.google.com/','Scrach App','5.0','Scrach App','contactus@gmail','favicon.png','https://www.goo','<ol>\r\n	<li>Scrach App</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>','208341680','applovin','e8e7e4099f3e3592','true','2','Android_Interstitial','unity','<p>???? ✅ Earn Paypal Rewards, Pubg UC, Freefire Diamonds ✅ Invite your friend Earn ✅ Download Now&nbsp;</p>','New Update Available please update to latest version\r\nbug fixed**','https://drive.google.com/file/d/1aTRVowjeP5LSIKHbQBvKS1TjazxNUQsH/view?usp=sharing',0,'false','2','false','startapp',3,'ca-app-pub-3940256099942544/2247696110',7,0,0,0,0,0,'[{\"admob_app_id\":\"ca-app-pub-3940256099942544~3347511713\",\"admob_adtype\":\"off\",\"au_admob\":\"ca-app-pub-3940256099942544\\/5224354917\",\"fb_adtype\":\"off\",\"au_fb\":\"xxxx\",\"applovin_adtype\":\"inter\",\"au_applovin\":\"284a92e50287b90b\",\"unity_gameid\":\"3774315\",\"unity_adtype\":\"reward\",\"au_unity\":\"Android_Rewarded\",\"ironsource_key\":\"1d3745efd\",\"iron_adtype\":\"off\",\"startio_id\":\"208341680\",\"ad_startio\":\"on\",\"ad_not_load_credit\":\"on\"}]','[]','[]',0,NULL,0,NULL,0,NULL,0);

/*Table structure for table `task` */

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `task_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `task` */

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tran_type` varchar(50) NOT NULL DEFAULT 'credit',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `api_type` varchar(50) DEFAULT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `offer_id` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `remained_balance` varchar(255) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `admin_remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `transaction` */

/*Table structure for table `weblink` */

DROP TABLE IF EXISTS `weblink`;

CREATE TABLE `weblink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `point` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `timer` varchar(255) NOT NULL,
  `browser_type` int(255) NOT NULL DEFAULT 0 COMMENT '0=inapp | 1= customtab',
  `status` int(11) NOT NULL DEFAULT 0,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `weblink` */
