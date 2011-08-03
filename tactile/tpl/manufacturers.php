<? if ( count( $manufacturers ) ) : ?>
	<div id="manufacturers">
		<ul>
			<? foreach ( $manufacturers as $item ) : $item = basename( $item, '.png' ); ?>
				<li class="<?= $item ?>">
					<a href="?page=cartouches&manufacturer=<?= $item ?>"><img src="<?= _IMG.'marques'.DS.$item.'.png' ?>" alt="<?= $item ?>" title="<?= $item ?>" /></a>
				</li>
			<? endforeach; ?>

			<div class="clear"></div>
		</ul>
	</div>
<? endif; ?>