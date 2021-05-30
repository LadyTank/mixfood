<?php 


if (!empty($_POST)) {

    $_POST[ 'reference' ] = htmlspecialchars($_POST[ 'reference' ]);
    $_POST[ 'categorie' ] = htmlspecialchars($_POST[ 'categorie' ]);
    $_POST[ 'titre' ] = htmlspecialchars($_POST[ 'titre' ]);
    $_POST[ 'description' ] = htmlspecialchars($_POST[ 'description' ]);
    $_POST[ 'couleur' ] = htmlspecialchars($_POST[ 'couleur' ]);
    $_POST[ 'taille' ] = htmlspecialchars($_POST[ 'taille' ]);
    $_POST[ 'public' ] = htmlspecialchars($_POST[ 'public' ]);
    // $_POST[ 'photo' ] = htmlspecialchars($_POST[ 'photo' ]);
    $_POST[ 'prix' ] = htmlspecialchars($_POST[ 'prix' ]);
    $_POST[ 'stock' ] = htmlspecialchars($_POST[ 'stock' ]);
    // Ici il faudrait faire 9 conditions pour vérifier que les 9 champs du formulaire sont bien remplis.
    // Traitement de la photo
    $photo_bdd = '';  // par défaut le champ photo sera vide en BDD
    jeprint_r($_FILES); // la superglobale $_FILES a un indice "photo" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.
    if (!empty($_FILES['photo']['name'])) { // si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est en train de télécharger une photo
    $photo_bdd = 'photos/' . $_FILES['photo']['name'];  // $photo_bdd contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.
    copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // on enregistre le fichier photo qui se trouve à l'adresse contenue dans $_FILES['photo']['tmp_name'] vers la destination qui est le dossier "photos" à l'adresse "../photos/nom_du_fichier.jpg".
      } //fin traitement de l'image
    // Requête d'insertion en BDD :
      $requete = executeRequete("INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)", array(
      ':reference'    => $_POST['reference'],	
      ':categorie'    => $_POST['categorie'],	
      ':titre'        => $_POST['titre'],	
      ':description'  => $_POST['description'],	
      ':couleur'      => $_POST['couleur'],	
      ':taille'       => $_POST['taille'],	
      ':public'       => $_POST['public'],	
      ':photo'        => $photo_bdd,  // attention la photo ne vient pas de $_POST mais de $_FILES	
      ':prix'         => $_POST['prix'],	
      ':stock'        => $_POST['stock'],	
      ));
      if ($requete) { // si executeRequete retourne un objet PDOStatement (donc évalué à true implicitement), alors c'est la requête a marché
        $contenu .= '<div class="alert alert-success">Le produit a été enregistré.</div>';
      } else { // sinon c'est qu'on a reçu false parce que la requête n'a pas marché
        $contenu .= '<div class="alert alert-danger">Erreur lors de l\'enregistrement...</div>';
      }
  } // fin du if (!empty($_POST))

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
Patrick Isola  10 h 15
<form method="post" action="" enctype="multipart/form-data">
				<!-- l'attribut enctype spécifie que le formulaire envoie des fichiers en plus des données "text" : permet de télécharger un fichier (photo). -->
				<div class="row">
						<div class="mb-3 col">
							<label for="reference" class="form-label">Référence</label>
							<input  class="form-control" type="text" name="reference" id="reference">
					</div>
						<div class="mb-3 col">
							<label for="categorie" class="form-label">Catégorie</label>
							<input class="form-control" type="text" name="categorie" id="categorie">
					</div>
					<div class="mb-3 col">
						<label for="titre" class="form-label">Titre</label>
						<input class="form-control" type="text" name="titre" id="titre">
					</div>
				</div>
				<!-- fin row  -->
				<div class="row">
				<div class="mb-3 col">
					<label for="description" class="form-label">Description</label>
					<textarea class="form-control" name="description" id="description"></textarea>
				</div>
				<div class="mb-3 col">
							<label for="couleur" class="form-label">Couleur</label>
							<input class="form-control" type="text" name="couleur" id="couleur">	
					</div>
					<div class="mb-3 col">
						<label for="taille" class="form-label">Taille</label>
						<select class="form-select form-select mb-3" name="taille">
							<option>S</option> <!-- en l'absence d'attribut value, on envoie la valeur entre les <option> dans $_POST -->
							<option>M</option>
							<option>L</option>
							<option>XL</option>
						</select>
					</div>
				</div>
				<!-- fin row  -->
				<div class="row border border-success p-1">
					<div class="col-1 mb-3 form-check">
						<input class="form-check-input" type="radio" name="public" value="m" checked> 
						<label for="public" class="form-check-label">Masculin</label>
					</div>
					<div class="col-1 mb-3 form-check">
						<input class="form-check-input" type="radio" name="public" value="f">
						<label for="public" class="form-check-label">Féminin</label>
						<!-- attention les valeurs des attributs "value" sont les mêmes que celles des enum() du champ correspondant en BDD. -->
						</div>
					<div class="col-1 mb-3 form-check">
						<input class="form-check-input" type="radio" name="public" value="mixte"> 
						<label for="public" class="form-check-label">Mixte</label>
					</div>
				</div>
				<!-- fin row  -->
				<div class="row">
					<div class="col mb-3">
					<label for="photo" class="form-label">Photo</label>
					<input class="form-control" type="file" name="photo" id="photo"><!-- attention pour pouvoir utiliser le type="file" il ne faut pas oublier l'attribut enctype="multipart/form-data" sur la balise <form>. -->
					</div>
					<div class="col mb-3">
						<label for="prix" class="form-label">Prix</label>
						<input class="form-control" type="text" name="prix" id="prix">
					</div>
				<div class="col mb-3">
					<label for="stock" class="form-label">Stock</label>
					<input class="form-control" type="text" name="stock" id="stock">
				</div>
				</div>
				<!-- fin row  -->
				<div class="col-6 mb-3">
					<button class="btn btn-outline-success" type="submit" class="btn btn-info mt-4">Ajouter un nouveau produit</button>
				</div>
			</form>  
</head>
<body>
    
</body>
</html>