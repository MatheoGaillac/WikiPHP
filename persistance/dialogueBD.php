<?php
require_once 'connexion.php';

class DialogueBD
{
    public function getContinent()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM continent ORDER BY idcontinent";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $LibContinent = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $LibContinent;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getPays()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT idpays, libpays, imgpays, descpays FROM pays ORDER BY idpays";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $LibPays = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $LibPays;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getPaysById($idPays)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM pays WHERE idpays=?";
            $sql = $sql . " ORDER BY idpays";
            $sth = $conn->prepare($sql);
            $sth->execute(array($idPays));
            $tabPays = $sth->fetchAll(PDO::FETCH_ASSOC);
            return ($tabPays);
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getLieuById($idLieu)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM lieutouristique WHERE idlieu=?";
            $sql = $sql . " ORDER BY idlieu";
            $sth = $conn->prepare($sql);
            $sth->execute(array($idLieu));
            $tabLieu = $sth->fetchAll(PDO::FETCH_ASSOC);
            return ($tabLieu);
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getPlatById($idPlat)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM gastronomie WHERE idplats=?";
            $sql = $sql . " ORDER BY idplats";
            $sth = $conn->prepare($sql);
            $sth->execute(array($idPlat));
            $tabPlat = $sth->fetchAll(PDO::FETCH_ASSOC);
            return ($tabPlat);
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getLieu()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT idlieu, liblieu, imglieu, desclieu FROM lieutouristique ORDER BY idlieu";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $LibLieu = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $LibLieu;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getGastronomie()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT idplats, libplat, imgplat, descplat FROM gastronomie ORDER BY idplats";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $LibPlat = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $LibPlat;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getInfosBySearch($search)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT idpays as id, libpays as lib, imgpays as img, descpays as description, 'pays' as type FROM pays WHERE libpays LIKE :search
            UNION
            SELECT idplats as id, libplat as lib, imgplat as img, descplat as description, 'plat' as type FROM gastronomie WHERE libplat LIKE :search
            UNION
            SELECT idlieu as id, liblieu as lib, imglieu as img, desclieu as description, 'lieu' as type FROM lieutouristique WHERE liblieu LIKE :search
            ORDER BY lib";
            $sth = $conn->prepare($sql);
            $sth->execute(array(':search' => $search . '%'));
            $mesInfos = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $mesInfos;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getDeplacementByID($idPays)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM deplacement WHERE idpays=?";
            $sql = $sql . " ORDER BY idpays";
            $sth = $conn->prepare($sql);
            $sth->execute(array($idPays));
            $tabTransports = $sth->fetchAll(PDO::FETCH_ASSOC);
            return ($tabTransports);
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getTransports()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM transports ORDER BY IDTRANSPORTS";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $LibTransports = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $LibTransports;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getAllergene()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM allergenes ORDER BY IDALLERGENE";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $LibAllergene = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $LibAllergene;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getAllergenesByPlat($id_plat)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT a.IDALLERGENE FROM PLATALLERGENES pa JOIN ALLERGENES a ON pa.IDALLERGENE = a.IDALLERGENE
                    WHERE pa.IDPLATS = ? ORDER BY a.IDALLERGENE";
            $sth = $conn->prepare($sql);
            $sth->execute(array($id_plat));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function getUnDrapeau($id)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT DRAPEAUPAYS FROM pays WHERE IDPAYS = ?";
            $sth = $conn->prepare($sql);
            $sth->execute(array($id));
            $MonDrapeau = $sth->fetchAll(PDO::FETCH_OBJ);
            return $MonDrapeau;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function addUnPays($titre, $continent, $capitale, $fuseau, $langue, $monnaie, $superficie, $nbHabitants, $image, $drapeau, $description, $histoire, $climat, $culture, $formalite)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO pays (LIBPAYS, IDCONTINENT, CAPITALEPAYS, FUSEAUHORAIRE, LANGUEPAYS, MONNAIEPAYS, SUPERFICIEPAYS, NBHABITANTS, IMGPAYS, DRAPEAUPAYS, DESCPAYS, HISTOIREPAYS, CLIMATPAYS, CULTUREPAYS, FORMATLITESPAYS) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sth = $conn->prepare($sql);
            $sth->execute(array($titre, $continent, $capitale, $fuseau, $langue, $monnaie, $superficie, $nbHabitants, $image, $drapeau, $description, $histoire, $climat, $culture, $formalite));
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function addUnLieu($titre, $pays, $image, $description)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO lieutouristique (LIBLIEU, IDPAYS, IMGLIEU, DESCLIEU) VALUES (?, ?, ?, ?)";
            $sth = $conn->prepare($sql);
            $sth->execute(array($titre, $pays, $image, $description));
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function addUnPlat($titre, $pays, $image, $description)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO gastronomie (LIBPLAT, IDPAYS, IMGPLAT, DESCPLAT) VALUES (?, ?, ?, ?)";
            $sth = $conn->prepare($sql);
            $sth->execute(array($titre, $pays, $image, $description));
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function addUnDeplacement($pays, $transport, $securite, $rapidite, $fiabilite)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO deplacement (IDPAYS, IDTRANSPORTS, LVSECURITE, LVRAPIDITE, LVFIABILITE) VALUES (?, ?, ?, ?, ?)";
            $sth = $conn->prepare($sql);
            $sth->execute(array($pays, $transport, $securite, $rapidite, $fiabilite));
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function addUnAllergene($plat, $allergene)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO platallergenes (IDPLATS, IDALLERGENE) VALUES (?, ?)";
            $sth = $conn->prepare($sql);
            $sth->execute(array($plat, $allergene));
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
        }
    }

    public function delPays($idPays)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "DELETE FROM pays WHERE idpays = ?";
            $sth = $conn->prepare($sql);
            $success = $sth->execute(array($idPays));
            if ($success) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
        }
    }

    public function delLieu($idLieu)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "DELETE FROM lieutouristique WHERE idlieu = ?";
            $sth = $conn->prepare($sql);
            $success = $sth->execute(array($idLieu));
            if ($success) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
        }
    }

    public function delPlat($idPlat)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "DELETE FROM gastronomie WHERE idplats = ?";
            $sth = $conn->prepare($sql);
            $success = $sth->execute(array($idPlat));
            if ($success) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
        }
    }
    public function modifPays($nom, $capitale, $fuseau, $langue, $monnaie, $superficie, $nbHabitants, $image, $drapeau, $description, $histoire, $climat, $culture, $formalite, $idpays)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE pays SET LIBPAYS= ?, CAPITALEPAYS= ?, FUSEAUHORAIRE = ?, LANGUEPAYS = ?, MONNAIEPAYS = ?, SUPERFICIEPAYS = ?, NBHABITANTS = ?, IMGPAYS = ?, DRAPEAUPAYS = ?, DESCPAYS = ?, HISTOIREPAYS = ?, CLIMATPAYS = ?, CULTUREPAYS = ?, FORMATLITESPAYS = ? WHERE IDPAYS = ?";
            $sth = $conn->prepare($sql);
            $sth->execute(array($nom, $capitale, $fuseau, $langue, $monnaie, $superficie, $nbHabitants, $image, $drapeau, $description, $histoire, $climat, $culture, $formalite, $idpays));
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            echo "Une erreur s'est produite lors de la mise à jour du pays : " . $msgErreur;
        }
    }

    public function modifLieu($nom, $pays, $image, $description, $idlieu)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE lieutouristique SET LIBLIEU = ?, IDPAYS = ?, IMGLIEU = ?, DESCLIEU = ? WHERE IDLIEU = ?";
            $sth = $conn->prepare($sql);
            $sth->execute(array($nom, $pays, $image, $description, $idlieu));
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            echo "Une erreur s'est produite lors de la mise à jour du lieu : " . $msgErreur;
        }
    }

    public function modifPlat($intitule, $pays, $image, $description, $idPlat)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE gastronomie SET LIBPLAT = ?, IDPAYS = ?, IMGPLAT = ?, DESCPLAT = ? WHERE IDPLATS = ?";
            $sth = $conn->prepare($sql);
            $sth->execute(array($intitule, $pays, $image, $description, $idPlat));
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            echo "Une erreur s'est produite lors de la mise à jour du plat : " . $msgErreur;
        }
    }

}