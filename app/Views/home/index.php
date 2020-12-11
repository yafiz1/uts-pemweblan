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
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<div class="nav-link text-dark active" id-jenis='All'>All Note</div>
				</li>
				<?php $namaJenis = []; ?>
				<?php foreach ($jenis as $j): ?>
					<li class="nav-item" style="/* border-color: red!important; */">
						<div class="nav-link text-white" id-jenis='<?= $j->id; ?>'><?= $j->jenis; ?></div>
					</li>
					<?php $namaJenis[] = [$j->id => $j->jenis]; ?>
				<?php endforeach; ?>
				<?php foreach ($namaJenis as $nama): ?>
					<?php 
						if ($nama[key($nama)] == 'Work') $namaJenis[key($nama)] = "bg-danger";
						else if ($nama[key($nama)] == 'Life') $namaJenis[key($nama)] = "bg-success";
						else if ($nama[key($nama)] == 'Personal') $namaJenis[key($nama)] = "bg-info";
						else if ($nama[key($nama)] == 'Travel') $namaJenis[key($nama)] = "bg-warning";				 
					?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div id="container" class="card-body d-flex flex-wrap">
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
			<?php foreach ($data as $datum):?>
				<div class="p-1 note" style="position: relative;">
					<div class="card text-white <?= $namaJenis[$datum->id_jenis];?>">
						<div class="card-header text-center"><?= $datum->title; ?></div>
						<div class="card-body">
					    	<p class="card-text">
					    		<?= substr($datum->isi,0,265); ?>
					    		<?= strlen($datum->isi) > 265 ? '...' : '' ?>
					    		<span hidden=""><?= $datum->isi; ?></span>
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
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailNoteModal" tabindex="-1" role="dialog" aria-labelledby="detailNoteModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title" id="detailNoteModalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
<script>


	$(".nav-link").each(function() {
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
				
			}, function() {$(this).parent("li").removeClass(["bg-danger","bg-success","bg-info","bg-warning","bg-dark"])}
		);

		$(this).click(function() {
			let method = "";
			if ($(this).attr('id-jenis') == 'All') {
				method = 'selectData';
			}else{
				method = 'selectDataWhere';
			}
			$.ajax({
				method: "POST",
				url: "<?= base_url()?>/Home/"+method+"/"+$(this).attr('id-jenis'),
				data: { jenis: $(this).text()},
				dataType: 'json',
				success: function(result) {
					console.log(result);
					$.ajax({
						method: "POST",
						url: "ajax.php",
						data: { 
							data: result,
							namaJenis: <?= json_encode($namaJenis); ?>
						},
						// dataType: 'json',
						success: function(data) {
							// console.log(data);
							
							$("#container").html(data);
						}
					})
				}
			})

			$("#card-header").removeClass(["bg-danger","bg-success","bg-info","bg-warning","bg-dark"]);
			if ($(this).text() == "Work") $("#card-header").addClass("bg-danger");
			else if ($(this).text() == "Life") $("#card-header").addClass("bg-success");
			else if ($(this).text() == "Personal") $("#card-header").addClass("bg-info");
			else if ($(this).text() == "Travel") $("#card-header").addClass("bg-warning");
			else $("#card-header").addClass("bg-dark");

			$(".nav-link").removeClass(["active","text-dark"]);
			$(".nav-link").addClass("text-white");
			$(this).addClass(["active","text-dark"]);

		});
	})

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
