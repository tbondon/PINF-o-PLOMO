<!-- <form action="controleur.php" method="POST">
<h1 style="text-align:center">Ajouter une question</h1>
	<div>
		<?php
		$id_quizz=valider("variable","GET");
		echo "<input type='hidden' name='id_quizz' value='".$id_quizz."'/>";
		?>
		<label for="name">
			<span class="required">Question :</span>
			<input type="text" id="nom_quizz" name="question" value=""/>
		</label> 		
		<h1 style="text-align:center">Bonne(s) réponse(s)</h1>   
		<label for="name">
			<span class="required">Réponse 1 :</span>
			<input type="text" id="nom_quizz" name="rep1_v" value=""/>
			<span class="required">Réponse 2 :</span>
			<input type="text" id="nom_quizz" name="rep2_v" value=""/>
			<span class="required">Réponse 3 :</span>
			<input type="text" id="nom_quizz" name="rep3_v" value=""/>
		</label>    
		<h1 style="text-align:center">Mauvaise(s) réponse(s)</h1>   
		<label for="name">
			<span class="required">Réponse 1 :</span>
			<input type="text" id="nom_quizz" name="rep1_f" value=""/>
			<span class="required">Réponse 2 :</span>
			<input type="text" id="nom_quizz" name="rep2_f" value=""/>
			<span class="required">Réponse 3 :</span>
			<input type="text" id="nom_quizz" name="rep3_f" value=""/>
		</label>   
	<button name="action" type="submit" id="submit" value="soumettre_question">Valider</button> 
</form>

<h1 style="text-align:center">Modifier mon quizz</h1>

	<div>		          
		<label for="subject">
			<span>Quizz :</span>
			<?php
				$id_quizz=valider("variable","GET");
				$questions = selectquestions($id_quizz);
				$max = count($questions);
				for ($i=0; $i < $max; $i++)
					{
						$id_quest=$questions[$i]['id_quest'];
			
						echo "<form action='controleur.php' method='POST'>";
						echo "<input type='hidden' name='id_quizz' value='".$id_quizz."'/>";
						echo "<input type='hidden' name='id_question' value='".$id_quest."'/>";
						echo "<br><br><button name='action' type='submit' id='submit' value='supp_question'>Supprimer toute la question (avec ses réponses)</button>"; 
						echo "</form>";
					
						
						echo "<form action='controleur.php' method='POST'>";
						echo "<br><input style='width : 414px;'  name='question' value='".$questions[$i]['question']."'/>";
						echo "<input type='hidden' name='id_quizz' value='".$id_quizz."'/>";
						echo "<input type='hidden' name='id_question' value='".$id_quest."'/>";
						echo "<button name='action' type='submit' id='submit' value='modif_question'>Modifier cette question</button>"; 
						echo "</form>";


						$reponses = selectreponses($id_quest);
						$max_2 = count($reponses);
						for ($j=0; $j < $max_2; $j++)
							{ 
								$id_rep=$reponses[$j]['id_rep'];

								echo "<form action='controleur.php' method='POST'>";
								echo "<input name='reponse' value='".$reponses[$j]['reponse']."'/>";
								echo "<input type='hidden' name='id_quizz' value='".$id_quizz."'/>";
								echo "<input type='hidden' name='id_reponse' value='".$id_rep."'/>";
								echo "<button name='action' type='submit' id='submit' value='modif_reponse'>Modifier cette reponse</button>";
								echo "</form>";

								echo "<form action='controleur.php' method='POST'>";
								echo "<input type='hidden' name='id_quizz' value='".$id_quizz."'/>";
								echo "<input type='hidden' name='id_reponse' value='".$id_rep."'/>";
								echo "<button name='action' type='submit' id='submit' value='supp_reponse'>Supprimer cette reponse</button>";	
								echo "</form>";


								
						/*echo "<form action='controleur.php' method='POST'>";
						echo "<input type='hidden' name='id_quizz' value='".$id_quizz."'/>";
						echo "<br><input type='hidden' name='id_question' value='".$id."'/>";
						echo "<button name='action' type='submit' id='submit' value='modif_reponse'>Modifier cette reponse</button>";
						echo "</form>";*/
							}
					}
					// On affiche les différentes catégories suivant lesquelles sont classés les vdm2i
				?>


		</label>
	</div> -->