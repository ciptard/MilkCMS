<?php 

include('includes/header.php');
	
	foreach ($articles as $article) {
		
		?>
		
		<section>
			<h3><a href="<?php echo $article['link'] ?>"><?php echo SmartyPants($article['title']); ?></a></h3>
			<article>
				<?php echo SmartyPants(Markdown($article['text'])); ?>
			</article>
		</section>
		<div style="clear:both;"></div>
		
	<?php } ?>
	
	<nav>
		<p>
		<?php 
			if (pagination::get('prev')) echo '<a href="' . pagination::get('prev') . '" class="prev">&larr; Previous Page</a>';
			if (pagination::get('next')) echo '<a href="' . pagination::get('next') . '" class="next">Next Page &rarr;</a>';
		?>
		</p>
	</nav>
	
<?php include('includes/footer.php'); ?>