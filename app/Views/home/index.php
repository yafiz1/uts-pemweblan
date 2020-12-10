<?php 
	$session = \Config\Services::session();
	if ($session->has("insertData")) {
		if ($session->get("insertData") == "success") {
			echo "<script>alert('Tambah Catatan Berhasil');</script>";
		}else{
			echo "<script>alert('Tambah Catatan Gagal');</script>";
		}
	}else if ($session->has("deleteData")) {
		if ($session->get("deleteData") == "success") {
			echo "<script>alert('Hapus Catatan Berhasil');</script>";
		}else{
			echo "<script>alert('Hapus Catatan Gagal');</script>";
		}
	}

 ?>
<style>
	div.nav-link {
		cursor: pointer;
	}
</style>
<div class="container-fluid mt-5 text-center d-flex flex-column">
	<!-- <div class="w-50 align-self-center">
		<?php 

			$title =  [
			       'name' => 'title',
			       'id'   => 'title',
			       'placeholder' => 'Title',
			       'class' => 'form-control',
			       'autocomplete' => 'off',
			       'required' => ''
			];

			$isi =  [
			       'name' => 'isi',
			       'id'   => 'isi',
			       'type' => 'password',
			       'class' => 'form-control',
			       'required' => '',
			       'autocomplete' => 'off'
			];

			$button = [
				   'name' => 'tambah',
			       'id'   => 'tambah',
			       'type' => 'submit',
			       'class' => 'btn btn-primary',
			       'content' => 'TAMBAH'
			]

		?>
		<?= form_open(base_url().'/public/Home/addNote') ?>
			<div class="form-group">
			   	<?= form_input($title); ?>
			</div>
			<div class="form-group">
				<?= form_textarea($isi); ?>
			</div>
			<?= form_button($button); ?>
		<?= form_close(); ?>
	</div> -->

	<div class="card text-center mt-2">
		<div id="card-header" class="card-header bg-dark">
			<ul class="nav nav-tabs card-header-tabs"> <!-- parent -->
				<li class="nav-item"> <!-- parent -->
					<div class="nav-link text-dark active">All Note</div> <!-- child -->
				</li>
				<?php $jenisArr = []; ?>
				<?php foreach ($jenis as $j): ?>
					<li class="nav-item" style="/* border-color: red!important; */">
						<div class="nav-link text-white"><?= $j->jenis; ?></div>
					</li>
					<?php $jenisArr[] = [$j->id => $j->jenis]; ?>
				<?php endforeach; ?>
				<?php foreach ($jenisArr as $jA): ?>
					<?php 
						if ($jA[key($jA)] == 'Work') {
							$jenisArr[key($jA)] = "bg-danger";
						} else if ($jA[key($jA)] == 'Life') {
							$jenisArr[key($jA)] = "bg-success";
						} else if ($jA[key($jA)] == 'Personal') {
							$jenisArr[key($jA)] = "bg-info";
						} else if ($jA[key($jA)] == 'Travel') {
							$jenisArr[key($jA)] = "bg-warning";
						}
					 ?>
				<?php endforeach; ?>
				
				
<!-- 				<li class="nav-item">
					<div class="nav-link disabled" data-type="#" tabindex="-1" aria-disabled="true">Life</div>
				</li> -->
			</ul>
		</div>
		<div id="isinya" class="card-body d-flex flex-wrap">
			<?php foreach ($data as $datum):?>
				<div class="p-1 theParent" style="position: relative;">
					<div class="card text-white <?= $jenisArr[$datum->id_jenis] ?> note" style="width: 18rem; height: 18rem;">
						<div class="card-header text-center"><?= $datum->title; ?></div>
						<div class="card-body">
					    	<p class="card-text"><?= $datum->isi; ?></p>
						</div>
					</div>
					<div class="card edit" style="position: absolute; z-index: 0; top: .25rem; width: 18rem; height: 18rem; background-color: rgba(0,0,0,.5); display: none;">
						<div class="card-body d-flex justify-content-around align-items-center">
							<a href="" class="text-primary"><i class="far fa-edit fa-3x"></i></a>
							<a href="" class="text-danger"><i class="fas fa-trash fa-3x"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="POST">
					<input type="hidden" class="form-control" name="id" id="edit-id" aria-describedby="id">
				<div class="form-group">
				<label for="edit-title">Title</label>
				<input type="text" class="form-control" name="edit-title" id="edit-title" aria-describedby="title">
				</div>
				<div class="form-group">
				<label for="edit-isi">Isi</label>
				<textarea class="form-control" name="edit-isi" id="edit-isi" rows="3"></textarea>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script>

	// $(document).on("mousemove", document, function() {
	// $(document).on("mousemove", function() {
		$(".nav-link").each(function() {
			// if (!$(this).hasClass("active")) {
				$(this).hover(
					function() {
						if ($(this).text() == "Work")  $(this).parent("li").addClass("bg-danger")
						else if ($(this).text() == "Life")  $(this).parent("li").addClass("bg-success")
						else if ($(this).text() == "Personal")  $(this).parent("li").addClass("bg-info")
						else if ($(this).text() == "Travel")  $(this).parent("li").addClass("bg-warning")
						else $(this).parent("li").addClass("bg-dark")

						$(this).css("border","1px solid transparent");
						$(this).parent("li").css("border-top-left-radius",".25rem");
						$(this).parent("li").css("border-top-right-radius",".25rem");
						
					}, function() {
						$(this).parent("li").removeClass("bg-danger")
						$(this).parent("li").removeClass("bg-success")
						$(this).parent("li").removeClass("bg-info")
						$(this).parent("li").removeClass("bg-warning")
						$(this).parent("li").removeClass("bg-dark")
					}
				);

				$(this).click(function() {
					$("#card-header").removeClass("bg-dark");
					$("#card-header").removeClass("bg-danger");
					$("#card-header").removeClass("bg-success");
					$("#card-header").removeClass("bg-info");
					$("#card-header").removeClass("bg-warning");
					$("#card-header").removeClass("bg-dark");
					if ($(this).text() == "Work") $("#card-header").addClass("bg-danger");
					else if ($(this).text() == "Life") $("#card-header").addClass("bg-success");
					else if ($(this).text() == "Personal") $("#card-header").addClass("bg-info");
					else if ($(this).text() == "Travel") $("#card-header").addClass("bg-warning");
					else $("#card-header").addClass("bg-dark");

					$(".nav-link").removeClass("active");
					$(".nav-link").removeClass("text-dark");
					$(".nav-link").addClass("text-white");

					$(this).addClass("active");
					$(this).addClass("text-dark");

					// $("#isinya").css("visibility","visible");
				});
			// }

		})
		
	// });

	$(".note").each(function() {
		$(this).parent().hover(
			function() {
				$(this).children('.edit').fadeIn()
				// $(this).children('.edit').css("z-index",0)
				// $(this).children('.edit').animate({
				// 	opacity: .5
				// });
			},
			function() {
				$(this).children('.edit').fadeOut()
				// $(this).children('.edit').animate({
				// 	opacity: 0
				// }, function() {
				// 	$(this).children('.edit').css("z-index",-1)
				// });
				
			}
		)
	})
	// $("a[href='#']").click(function() {
	// 	let id = $(this).attr("data-id");
	// 	console.log(id)
	// 	$("#edit-id").val(id);
	// 	$(".modal-body form").attr("action","<?= base_url().'/public/Home/updateNote' ?>")
	// 	$(".modal-body input#edit-title").val($(this).parent().prev().text());
	// 	$(".modal-body textarea").val($(this).parent().parent().next().children().text());
	// });
	
</script>
