<?php
include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();
// MySQL query that selects all the images
$stmt = $pdo->query('CREATE TABLE IF NOT EXISTS images (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT NOT NULL, description TEXT NOT NULL, filepath TEXT NOT NULL, uploaded_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;');
$stmt = $pdo->query('SELECT * FROM images ORDER BY uploaded_date DESC');
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Gallery')?>

<div class="content home">
	<h2>Galeria</h2>
	<p>Bem-vindo! Você pode fazer o upload de imagens no botão abaixo.</p>
	<a href="upload.php" class="upload-image">Fazer upload de imagem</a>
	<div class="images">
		<?php foreach ($images as $image): ?>
		<?php if (file_exists($image['filepath'])): ?>
		<a href="#">
			<img src="<?=$image['filepath']?>" alt="<?=$image['description']?>" data-id="<?=$image['id']?>" data-title="<?=$image['title']?>" width="300" height="200">
			<span><?=$image['description']?></span>
		</a>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="image-popup"></div>

<script>
// Container we'll use to output the image
let image_popup = document.querySelector('.image-popup');
// Iterate the images and apply the onclick event to each individual image
document.querySelectorAll('.images a').forEach(img_link => {
	img_link.onclick = e => {
		e.preventDefault();
		let img_meta = img_link.querySelector('img');
		let img = new Image();
		img.onload = () => {
			// Create the pop out image
			image_popup.innerHTML = `
				<div class="con">
					<h3>${img_meta.dataset.title}</h3>
					<p>${img_meta.alt}</p>
					<img src="${img.src}" width="${img.width}" height="${img.height}">
					<a href="delete.php?id=${img_meta.dataset.id}" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i></a>
				</div>
			`;
			image_popup.style.display = 'flex';
		};
		img.src = img_meta.src;
	};
});
// Hide the image popup container, but only if the user clicks outside the image
image_popup.onclick = e => {
	if (e.target.className == 'image-popup') {
		image_popup.style.display = "none";
	}
};
</script>
<?=template_footer()?>