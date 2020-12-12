<?php if (isset($_POST['data'])): ?>
	<?php 
		$data = $_POST['data'];
		foreach ($data as $key => $datum) {
			if ($datum['warna'] == 'Red') $data[$key]['warna'] = 'bg-danger';
			else if ($datum['warna'] == 'Green') $data[$key]['warna'] = 'bg-success';
			else if ($datum['warna'] == 'light-blue') $data[$key]['warna'] = 'bg-info';
			else if ($datum['warna'] == 'yellow') $data[$key]['warna'] = 'bg-warning';
		}
	?>
	<?php foreach ($data as $datum):?>

	<div class="p-1 note" style="position: relative;">
		<div class="card text-white <?= $datum['warna'] ?>">
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
				<a href="#" data-id="<?= $datum['id'] ?>" class="text-primary edit-btn"><i class="far fa-edit fa-3x"></i></a>
				<a href="<?= $_POST['base_url']."/Home/deleteNote/".$datum['id'] ?>" class="text-danger"><i class="fas fa-trash fa-3x"></i></a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
<?php endif ?>
	<div class="p-1 add">
		<div class="card text-white bg-dark">
			<div class="card-body d-flex justify-content-around align-items-center">
		    	<a href="#" class="text-white"><i class="fas fa-plus fa-5x"></i></a>
			</div>
		</div>
	</div>
<script>
	$(".add a").click(function() {
		$("#addModalLabel").text("Note Baru");

		$("#addModal").modal();
	})

	$(".edit-btn").click(function() {
		$("#editModalLabel").text("Edit Note");
		$("#editModal #id").val($(this).attr("data-id"));
		$("#editModal #judul").val($(this).parent().parent().parent().children().first().children('.card-header').text())
		$("#editModal #isi").val($(this).parent().parent().parent().children().first().children('.card-body').children().children("span").text())
		let jenis = $(this).parent().parent().parent().children().first().attr("class").split(' ');
		jenis = jenis[jenis.length-1];
		console.log(jenis)
		$("#editModal #option1").removeAttr("checked","");
		$("#editModal #option2").removeAttr("checked","");
		$("#editModal #option3").removeAttr("checked","");
		$("#editModal #option4").removeAttr("checked","");
		$("#editModal #option1").parent().removeClass("active");
		$("#editModal #option2").parent().removeClass("active");
		$("#editModal #option3").parent().removeClass("active");
		$("#editModal #option4").parent().removeClass("active");
		if (jenis == 'bg-danger') {
			$("#editModal #option1").attr("checked","");
			$("#editModal #option1").parent().addClass("active");
		}else if (jenis == 'bg-success') {
			$("#editModal #option2").attr("checked","");
			$("#editModal #option2").parent().addClass("active");
		}else if (jenis == 'bg-info') {
			$("#editModal #option3").attr("checked","");
			$("#editModal #option3").parent().addClass("active");
		}else if (jenis == 'bg-warning') {
			$("#editModal #option4").attr("checked","");
			$("#editModal #option4").parent().addClass("active");
		}
		$("#editModal").modal();
		$("#editModal").addClass("active");
	})

	$("#editModal").on("hide.bs.modal", function() {
		$("#editModal").removeClass("active");
	})

	$(".note").each(function() {
		$(this).hover(
			function() {$(this).children('.edit').fadeIn()},
			function() {$(this).children('.edit').fadeOut()}
		)

		if ($(this).children().first().children('.card-body').children().children().text().length > 265) {
			$(this).css('cursor','pointer');
			$(this).click(function() {
				if ((!$("#editModal").hasClass('active'))) {
					$("#detailNoteModal .modal-header").removeClass(['bg-danger','bg-info','bg-success','bg-warning']);

					$("#detailNoteModal .modal-title").text($(this).children().children('.card-header').text());
					$("#detailNoteModal .modal-body").text($(this).children().children('.card-body').children().children().text());

					let jenis = $(this).children().attr('class').split(' ');
					$("#detailNoteModal .modal-header").addClass(jenis[jenis.length-1]);
					$("#detailNoteModal").modal('show');	
				}
				
			});
		}
	});
</script>
