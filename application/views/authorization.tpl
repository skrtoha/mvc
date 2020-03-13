<h2><?=$pageTitle?></h2>
<div id="message"><?=$message?></div>
<form method="post">
	<table>
		<tr>
			<td>Ваше имя</td>
			<td><input type="text" name="name" value="<?=$params['name']?>"></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Отправить"></td>
		</tr>
	</table>
</form>
<?if ($pageTitle == 'Авторизация пользователя'){?>
	<a href="/page/registration">Регистрация</a>
<?}?>