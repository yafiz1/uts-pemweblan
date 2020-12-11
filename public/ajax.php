<?php if (isset($_POST['data'])) :?>
	<style>
		.note .card,
		.note .edit {
			width: 18rem;
			height: 18rem;
		}

		.edit {
			background-color: rgba(0,0,0,.5);
		}

	</style>
	<?php foreach ($_POST['data'] as $datum):?>
	<div class="p-1 note" style="position: relative;">
		<div class="card text-white <?= $_POST['namaJenis'][$datum['id_jenis']];?>">
			<div class="card-header text-center"><?= $datum['title']; ?></div>
			<div class="card-body">
		    	<p class="card-text">
		    		<?= substr($datum['isi'],0,265); ?>
		    		<?= strlen($datum['isi']) > 265 ? '...' : '' ?>
		    		<span hidden=""><?= $datum['isi']; ?></span>
		    	</p>
			</div>
		</div>
		<div class="card edit" style="position: absolute; top: .25rem; display: none;">
			<div class="card-body d-flex justify-content-around align-items-center">
				<a href="" class="text-primary"><i class="far fa-edit fa-3x"></i></a>
				<a href="" class="text-danger"><i class="fas fa-trash fa-3x"></i></a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="p-1 note" style="position: relative;">
		<div class="card text-white bg-dark">
			<!-- <div class="card-header text-center">Tambah Data</div> -->
			<style>
				.fa-plus:hover {
					opacity: .5;
				}
			</style>
			<div class="card-body d-flex justify-content-around align-items-center">
		    	<a href="" class="text-white"><i class="fas fa-plus fa-5x"></i></a>
			</div>
		</div>
	</div>

	<script>
		$(".note").each(function() {
			$(this).hover(
				function() {$(this).children('.edit').fadeIn()},
				function() {$(this).children('.edit').fadeOut()}
			)

			if ($(this).children().first().children('.card-body').children().children().text().length > 265) {
				$(this).css('cursor','pointer');
				$(this).click(function() {
					$(".modal-header").removeClass(['bg-danger','bg-info','bg-success','bg-warning']);

					$(".modal-title").text($(this).children().children('.card-header').text());
					$(".modal-body").text($(this).children().children('.card-body').children().children().text());

					let jenis = $(this).children().attr('class').split(' ');
					$(".modal-header").addClass(jenis[jenis.length-1]);
					$("#detailNoteModal").modal('show');
				});
			}
		});
	</script>	
<?php endif; ?>
