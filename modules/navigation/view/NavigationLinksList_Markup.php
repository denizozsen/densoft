<ul>
	<?php foreach($this->model as $link) :
		if ($link->isActive()) : ?>
			<li class="activenavlink">
		<?php else : ?>
			<li>
		<?php endif; ?>
				<a href="<?php echo $link->getUrl(); ?>"><?php echo $link->getTitle(); ?></a>
			</li>
		<?php if ($link->hasChildren()) : ?>
		<ul>
			<?php foreach($link->getChildren() as $childLink) :
				if ($childLink->isActive()) : ?>
					<li class="activenavlink">
				<?php else : ?>
					<li>
				<?php endif; ?>
						<a href="<?php echo $childLink->getUrl(); ?>"><?php echo $childLink->getTitle(); ?></a>
					</li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
