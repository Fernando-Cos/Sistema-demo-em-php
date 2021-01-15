<?php
require_once 'assets/php/header.php';
?>
	<div class="container">

		
		<div class="row">
			<div class="circlo"></div>

			<div class="col-lg-12">
				
				<?php if ($verified == 'Not Verified!'): ?>
					<div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
						<button class="close" type="button" data-dismiss="alert">&times;</button>
						<b>Seu E-mail is not verified! we've sent you email verification link on tour email, check & verificy now.</b>
					</div>
				<?php endif; ?>
				<h2 class="text-center text-primary mt-2">Escrevam suas observações em destaques aqui a qual quer momento.</h2>
				<p class="text-primary bg-dark mt-2">Algumas observações estarão disponineis atraves de regalias dos administradores do sistema principal, qual quer duvia entrar em contato com o mesmo. portanto entre em contato atraves do</p>
			</div>
		</div>
		<div class="card border-primary">
			<h5 class="card-header bg-primary d-flex justify-content-between">
				<span class="text-light lead align-self-center">Todas Observações!</span>

				<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add observações.</a>
			</h5>
			<div class="card-body">
				<div class="table-responsive" id="showNote">
	
				</div>
			</div>
		</div>
	</div>

	<!--Start Add new notas model -->
	<div class="modal fade" id="addNoteModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Adicionar Novas Observações!</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post" id="add-note-form" class="px-3">
						<div class="form-group">
							<input type="text" name="title" class="form-control form-control-lg" placeholder="Entre com o Titulo" required>
						</div>
						<div class="form-group">
							<textarea name="note" class="form-control form-control-lg" placeholder="Escrevam suas observações aqui..." rows="6" required></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="addNote" id="addNoteBtn" value="Adicionar Observação" class="btn btn-success btn-block btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--End Add new notas model -->

		<!--Start Add new notas model -->
	<div class="modal fade" id="editNoteModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<h4 class="modal-title text-light"> Editar observações</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post" id="edit-note-form" class="px-3">
						<input type="hidden" name="id" id="id">
						<div class="form-group">
							<input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Entre com o Titulo" required>
						</div>
						<div class="form-group">
							<textarea name="note"  id="note" class="form-control form-control-lg" placeholder="Escrevam suas observações aqui..." rows="6" required></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="editNote" id="editNoteBtn" value="Atualizar!" class="btn btn-info btn-block btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--End Add new notas model -->
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> 
  	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
  	<script type="text/javascript" src="js/script.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  	<script type="text/javascript">
  		$(document).ready(function(){

  			// Add new nota Ajax Request...
  			$("#addNoteBtn").click(function(e) {
  				if ($("#add-note-form")[0].checkValidity()){
  					e.preventDefault();
  					
  					$("#addNoteBtn").val('Aguarde...');

  					$.ajax({
	  					url:'assets/php/process.php',
	  					method:'post',
	  					data:$("#add-note-form").serialize()+'&action=add_note',
	  					success:function(response) {
	  					$("#addNoteBtn").val('Adicionar Observação');
	  						$("#add-note-form")[0].reset();
	  						$("#addNoteModal").modal('hide');
	  						Swal.fire({
	  						  title: 'Sucesso!!!',
							  showClass: {
							    popup: 'animate__animated animate__fadeInDown'
							  },
							  hideClass: {
							    popup: 'animate__animated animate__fadeOutUp'
							  }
	  						});
	  					}
  					});

  				}
  			}); 
  			//Edit Notas of an User Ajax resquest...
  			$("body").on("click", ".editBtn", function(e) {
  				e.preventDefault();

  				edit_id = $(this).attr('id');
  				// console.log(edit_id);

  				$.ajax({
  					url:'assets/php/process.php',
  					method:'post',
  					data: { edit_id: edit_id },
  					success:function(response){
  						//console.log(response);
  						data = JSON.parse(response);
  						//console.log(data);
  						$("#id").val(data.id);
  						$("#title").val(data.title);
  						$("#note").val(data.note);
  					}
  				});
  			});

  			//Update Not of an user ajax request...
  			$("#editNoteBtn").click(function(e){
  				if($("#edit-note-form")[0].checkValidity()){
  					e.preventDefault();

  					$.ajax({
  						url:'assets/php/process.php',
  						method:'post',
  						data: $("#edit-note-form").serialize()+"&action=update_note",
  						success:function(response){
  							//console.log(response);
  							Swal.fire({
  								title: 'Observação Atualizada!!!',
  								type: 'success'
  							});
  							$("#edit-note-form")[0].reset();
  							$("#editNoteModal").modal('hide');
  							displayAllNotes(); 	
  						}
  					});
  				}
  			});

  			//Delete a note pf an user ajax request...
  			$("body").on("click", ".deleteBtn", function(e){
  				e.preventDefault();
  				del_id = $(this).attr('id');

  				const swalWithBootstrapButtons = Swal.mixin({
				  customClass: {
				    confirmButton: 'btn btn-success',
				    cancelButton: 'btn btn-danger'
				  },
				  buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				  title: 'Deseja Apagar?',
				  text: "Voce não poderar reverteer isso!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonText: 'Yes, delete it!',
				  cancelButtonText: 'No, cancel!',
				  reverseButtons: true
				}).then((result) => {
				  if (result.isConfirmed) {

				  	$.ajax({
				  		url: 'assets/php/process.php',
				  		method:'post',
				  		data: { del_id: del_id },
				  		success:function(response) {
				  			swalWithBootstrapButtons.fire(
						      'Deleted!',
						      'Note Deleted success.',
						      'success'
				    		)
				    			displayAllNotes(); 
				  		}
				  	});
				  } else if (
				    /* Read more about handling dismissals below */
				    result.dismiss === Swal.DismissReason.cancel
				  ) {
				    swalWithBootstrapButtons.fire(
				      'Cancelled',
				      'Your imaginary file is safe :)',
				      'error'
				    )
				  }
				})
  			});

  			displayAllNotes(); 			

  			//Display All of an User...
  			function displayAllNotes() {
  				$.ajax({
  					url:'assets/php/process.php',
  					method:'post',
  					data: { action: 'display_notes' },
  					success:function(response){
  						$("#showNote").html(response);
  						$("table").DataTable({
  							order: [0, 	'desc']
  						});
  					}
  				});
  			}
  		});
  	</script>
  </body>
</html>
