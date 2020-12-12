<div class="container-fluid mt-5 text-center d-flex flex-column">
	<div class="card text-center mt-2">
		<div id="card-header" class="card-header bg-dark">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<div class="nav-link text-dark active" id-jenis='All'>All Note</div>
				</li>
				<?php foreach ($categories as $category): ?>
					<li class="nav-item">
						<div class="nav-link text-white" id-jenis='<?= $category->id; ?>'><?= $category->jenis; ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div id="container" class="card-body d-flex flex-wrap">
			<?php 
				foreach ($data as $datum) {
					if ($datum->warna == 'Red') $datum->warna = 'bg-danger';
					else if ($datum->warna == 'Green') $datum->warna = 'bg-success';
					else if ($datum->warna == 'light-blue') $datum->warna = 'bg-info';
					else if ($datum->warna == 'yellow') $datum->warna = 'bg-warning';
				}
			?>
			<?php foreach ($data as $datum):?>

				<div class="p-1 note" style="position: relative;">
					<div class="card text-white <?= $datum->warna ?>">
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
							<a href="#" data-id="<?= $datum->id ?>" class="text-primary edit-btn"><i class="far fa-edit fa-3x"></i></a>
							<a href="<?= base_url()."/Home/deleteNote/".$datum->id ?>" class="text-danger"><i class="fas fa-trash fa-3x"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
				<div class="p-1 add">
					<div class="card text-white bg-dark">
						<div class="card-body d-flex justify-content-around align-items-center">
					    	<a href="#" class="text-white"><i class="fas fa-plus fa-5x"></i></a>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="addModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open(base_url()."/Home/addNote") ?>
      <div class="modal-body ">
		
			<div class="form-group">
				<label for="judul">Judul</label>
				<input type="text" class="form-control" id="judul" name="judul">
			</div>
			<div class="form-group">
			    <label for="isi">Catatan</label>
			    <textarea class="form-control" id="isi" rows="3" name="isi"></textarea>
			 </div>
			 <div class="form-group">
			    <label for="isi">Kategori</label>
			    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons" style="width: 100%;">
				  <label class="btn btn-danger">
				    <input type="radio" name="jenis" id="option1" autocomplete="off" value="1"> Work
				  </label>
				  <label class="btn btn-success">
				    <input type="radio" name="jenis" id="option2" autocomplete="off" value="2"> Life
				  </label>
				  <label class="btn btn-info">
				    <input type="radio" name="jenis" id="option3" autocomplete="off" value="3"> Personal
				  </label>
				  <label class="btn btn-warning">
				    <input type="radio" name="jenis" id="option3" autocomplete="off" value="4"> Travel
				  </label>
				</div>
			 </div>
			 
		
      </div>
      <div class="modal-footer ">
        <button type="submit" class="btn btn-dark w-100">Tambah</button>
        
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open(base_url()."/Home/updateNote") ?>
      <div class="modal-body ">
			<input type="number" hidden="" class="form-control" id="id" name="id">
			<div class="form-group">
				<label for="judul">Judul</label>
				<input type="text" class="form-control" id="judul" name="judul">
			</div>
			<div class="form-group">
			    <label for="isi">Catatan</label>
			    <textarea class="form-control" id="isi" rows="3" name="isi"></textarea>
			 </div>
			 <div class="form-group">
			    <label for="isi">Kategori</label>
			    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%;">
				  <label class="btn btn-danger" style="width: 25%;">
				    <input type="radio" name="jenis" id="option1" autocomplete="off" value="1"> Work
				  </label>
				  <label class="btn btn-success" style="width: 25%;">
				    <input type="radio" name="jenis" id="option2" autocomplete="off" value="2"> Life
				  </label>
				  <label class="btn btn-info" style="width: 25%;">
				    <input type="radio" name="jenis" id="option3" autocomplete="off" value="3"> Personal
				  </label>
				  <label class="btn btn-warning" style="width: 25%;">
				    <input type="radio" name="jenis" id="option4" autocomplete="off" value="4"> Travel
				  </label>
				</div>
			 </div>
			 
		
      </div>
      <div class="modal-footer ">
        <button type="submit" class="btn btn-dark w-100">Edit</button>
      </div>
      </form>
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
			if ($(this).attr('id-jenis') == 'All') method = 'selectData';
			else method = 'selectDataWhere';
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
							base_url : '<?= base_url(); ?>'
						},
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
