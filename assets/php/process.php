<?php 
require_once 'session.php';

//Handle add new notas Ajax request...
if (isset($_POST['action']) && $_POST['action'] == 'add_note') {
	$title = $cuser->test_input($_POST['title']);
	$note = $cuser->test_input($_POST['note']);

	$cuser->add_new_note($cid, $title, $note);
}

//Handle Display All notes of an user...
if (isset($_POST['action']) && $_POST['action'] == 'display_notes'){
	$output = '';

	$notes = $cuser->get_notes($cid);

	if ($notes) {
		$output .= '<table class="table table-striped text-center">
						<thead>
							<tr>
								<th>#</th>
								<th>Titulo</th>
								<th>Operações Pendentes</th>
								<th>Funções</th>
							</tr>
						</thead>
						<tbody>';
			foreach ($notes as $row) {
				$output .= '<tr>
								<td>'.$row['id'].'</td>
								<td>'.$row['title'].'</td>
								<td>'.substr($row['note'],0, 75).'...</td>
								<td>
									<a href="#" id="'.$row['id'].'" title="View Details" class="text-success infoBtn">
									<i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#addNoteModal"></i></a>&nbsp;

									<a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn">
									<i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i></a>&nbsp;

									<a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn">
									<i class="fas fa-trash-alt fa-lg"></i></a>
								</td>
							</tr>';
				}
			$output .= '</tbody>
					</table>';
			echo $output;
		}
		else {
			echo '<h1 class="text-center text-secondary">:( you have not written note yet! write your firdst note now</h1>';
		}
	}

	//Handle Edit Note of an user ajax request...
	if (isset($_POST['edit_id'])) {
		//print_r($_POST);
		$id = $_POST['edit_id'];

		$row = $cuser->edit_note($id);
		echo json_encode($row);
	}

	//Handle Update note of an user ajax request...
	if (isset($_POST['action']) && $_POST['action'] == 'update_note') {
		//print_r ($_POST);
		$id = $cuser->test_input($_POST['id']);
		$title = $cuser->test_input($_POST['title']);
		$note = $cuser->test_input($_POST['note']);

		$cuser->update_note($id, $title, $note);
	}

	//Handle Delete a not of User Ajax request...
	if (isset($_POST['del_id'])) {
		$id = $_POST['del_id'];

		$cuser->delete_note($id);
		// echo json_encode();
	}

?>