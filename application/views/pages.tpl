<table>
	<tr>
		<th>Title</th>
	</tr>
	<?foreach($pages as $value){?>
		<tr>
			<td><a href="/pages/page/?id=<?=$value['id']?>"><?=$value['title']?></a></td>
		</tr>
	<?}?>
</table>