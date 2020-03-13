<h2>Пользователь: <?=$user['name']?></h2>
<p><b><?=$pageTitle?>:</b></p>
<table>
	<tr>
		<th>Имя</th>
		<th></th>
	</tr>
	<?if (count($contacts)){
		foreach($contacts as $c){?>
			<tr>
				<td><?=$c['name']?></td>
				<td>
					<?if ($pageTitle == 'Контакты'){
						if ($c['favorite']){?>
							<a href="/page/favorite/?action=remove&contact_id=<?=$c['id']?>">Удалить</a>
						<?}
						else{?>
							<a href="/page/favorite/?action=add&contact_id=<?=$c['id']?>">В избранное</a>
						<?}?>
					<?}?>
				</td>
			</tr>
		<?}?>
	<?}?>
</table>
<?if ($pageTitle == 'Контакты'){?>
	<p><a href="/page/favorite">Перейти в избранное</a></p>
<?}
else{?>
	<p><a href="/page/contacts">Перейти в контакты</a></p>
<?}?>
<p><a href="/page/exit">Выйти</a></p>