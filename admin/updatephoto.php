<?php 



/* =================================== */
/* Mise à jour d'un produit */
/* =================================== */
 // as-t-on reçu des informations par $_GET ? 
    // jeprint_r( $_GET ); // pour vérifier que l'on reçoit une info par l'URL.
    if ( isset( $_GET[ 'id_produit' ] ) ) { // si existe l'indice
        // jeprint_r( $_GET );
        $resultat = $pdoBOU->prepare( " SELECT * FROM produit WHERE id_produit = :id_produit " );
        $resultat->execute(array(
            ':id_produit' => $_GET['id_produit']// on associe le marqueur vide à l'id_employes qui provient de l'url
        ));  
      //   jeprint_r($resultat); 
      //   jeprint_r($resultat->rowCount());
        if ( $resultat->rowCount() == 0) {// si il y a 0 lignes dans $resultat c'est que l'id n'existe pas
            header( 'location:index.php');// on redirige vers une autre page
            exit();// on arrête le script
        }
        $fiche_produit = $resultat->fetch( PDO::FETCH_ASSOC );
        // jeprint_r($fiche);
      // } else {// sinon c'est que l'on a pas demandé un employé en particulier en arrivant sur cette page
      //     header( 'location:index.php');
      //     exit();
      }
      // traitement de mise à jour d'employé
      if ( !empty( $_POST ) ) {
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
          // Traitement de la photo
    $photo_bdd = '';  // par défaut le champ photo sera vide en BDD
    jeprint_r($_FILES); // la superglobale $_FILES a un indice "photo" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.
    if (!empty($_FILES['photo']['name'])) { // si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est en train de télécharger une photo
    $photo_bdd = 'photos/' . $_FILES['photo']['name'];  // $photo_bdd contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.
    copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // on enregistre le fichier photo qui se trouve à l'adresse contenue dans $_FILES['photo']['tmp_name'] vers la destination qui est le dossier "photos" à l'adresse "../photos/nom_du_fichier.jpg".
      } //fin traitement de la photo
          jeprint_r($_POST);
          $resultat = $pdoBOU->prepare(" UPDATE produit SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, public = :public, photo = :photo, prix = :prix, stock = :stock WHERE id_produit = :id_produit ");
          $resultat->execute( array(
              ':reference' => $_POST[ 'reference' ],
              ':categorie' => $_POST[ 'categorie' ],
              ':titre' => $_POST[ 'titre' ],
              ':description' => $_POST[ 'description' ],
              ':couleur' => $_POST[ 'couleur' ],
              ':taille' => $_POST[ 'taille' ],
              ':public' => $_POST[ 'public' ],
              ':photo' => $photo_bdd,
              ':prix' => $_POST[ 'prix' ],
              ':stock' => $_POST[ 'stock' ],
              ':id_produit' => $_GET[ 'id_produit' ], 
          ) );
          header( 'location:index.php');
          exit();
  }// fin du if (!empty($_POST)) 










?>