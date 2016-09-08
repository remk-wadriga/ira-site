<!-- ======= Роздрук листа-запрошення  ======= -->


<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<!-- ======= header ======= -->
	<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f3f4f6">
		<tr><td height="80" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
	</table>
<!-- ======= end header ======= -->


<!-- ======= main section ======= -->
	<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f3f4f6">
		<tr>
			<td align="center">
				<table border="0" align="center" width="590" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container590" style="border: solid 1px #e1e3e5;">

					<tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>

					<tr>
						<!-- ======= logo ======= -->
						<td align="left">
							<a href="" style="display: block; border-style: none !important; border: 0 !important;">
								<img src="img/logo.png" title="kasa.in.ua" width="374" height="43" style="display:block;margin:0;padding:0;border:0;
								vertical-align:baseline;margin-bottom:30px;width:374px" class="CToWUd">
							</a>
						</td>
					</tr>

					<tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 13px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Доброго дня,<?= $clientName ?>!
							</div>
							<div style="line-height: 20px;">
								Ваші квитки-запрошення було роздруковані.
							</div>
						</td>
					</tr>


					<tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								В замовленні №115147:
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								1 КВИТОК НА СУМУ 500 ГРН.
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #800706;">
                            	скасований
                            </div>

						</td>
					</tr>

					<tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Спосіб оплати
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								ПЛАТІЖНОЮ КАРТОЮ
							</div>

						</td>
					</tr>

					<tr><td height="10" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Статус оплати
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								НЕ ОПЛАЧЕНО
							</div>

						</td>
					</tr>

					<tr><td height="10" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Спосіб доставки
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								EMAIL
							</div>

						</td>
					</tr>

					<tr><td height="10" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Статус доставки
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								НЕ ВІДПРАВЛЯВСЯ
							</div>

						</td>
					</tr>

					<tr><td height="10" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Ваші квитки:
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								The Herbaliser Band (LIVE) Arsenal Open-Air (Мистецький Арсенал)
							</div>
							<div style="line-height: 20px;font-size: 13px;">
								23.08.2016|22:00|Київ «Національний культурно-мистецький та музейний комплекс «Мистецький арсенал»»
							</div>
							<tr>
								<td>
									<div style=" font-size: 13px; color: #3b3b3b;">
										VIP-3
									</div>

								</td>
								<td>
									<div style=" font-size: 13px; color: #3b3b3b;">
										ряд 0
									</div>
								</td>
								<td>
									<div style="font-size: 13px; color: #3b3b3b;">
										місце 0
									</div>
								</td>
								<td>
									<div style="line-height: 20px; font-size: 13px; color: #800706;">
										скасовано
									</div>
								</td>
							</tr>

						</td>
					</tr>

					<tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Дата оформлення замовлення:
							</div>
							<div style="line-height: 20px;font-size: 18px;color: #3b3b3b;">
								06.07.2016|14:48
							</div>

						</td>
					</tr>

					<tr><td height="10" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 13px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 10px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Залишена Вами контактна інформація:
							</div>
							<div style="line-height: 20px;">
								Ім'я:<?= $clientName ?>!
							</div>
							<div style="line-height: 20px;">
								Телефон:
							</div>
							<div style="line-height: 20px;">
								Що-небудь ще:
							</div>
						</td>
					</tr>
					<tr><td height="40" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>

					<tr>
						<td align="left" style="color: #808080; font-size: 14px;
						font-family: Montserrat, sans-serif; mso-line-height-rule: exactly;
						 line-height: 20px;" class="title_color main-header">
							<!-- ======= section header ======= -->
							<div style="line-height: 20px;">
								Дякуємо!
							</div>
							<div style="line-height: 20px;">
								Яскравих вражень!
							</div>
						</td>
					</tr>
					<tr><td height="25" style="font-size: 10px; line-height: 20px;">&nbsp;</td></tr>
				</table>
			</td>
		</tr>

	</table>
	<!-- ======= end main section ======= -->


	<!-- ======= footer ======= -->
	<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f3f4f6">
		<tr><td height="80" style="font-size: 40px; line-height: 80px;">&nbsp;</td></tr>
	</table>
	<!-- ======= end footer ======= -->
