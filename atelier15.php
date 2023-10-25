<?php

interface MethodeProfesseur
{
    public function EvaluerEtudiant($dateEvaluation);
}

class Etudiant
{
    protected $matricule;
    protected $nom;
    protected $prenom;
    protected $dateNaissance;

    public function __construct($matricule, $nom, $prenom, $dateNaissance)
    {
        $this->setMatricule($matricule);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setDateNaissance($dateNaissance);
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMatricule()
    {
        return $this->matricule;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function setNom($newNom)
    {
        if (!preg_match("/^[a-zA-Z]+$/", $newNom)) {
            throw new Exception("Attention ! Entrez un nom correct");
        } else {
            $this->nom = $newNom;
        }
    }

    public function setPrenom($newPrenom)
    {
        if (!preg_match("/^[a-zA-Z ]+$/", $newPrenom)) {
            throw new Exception("Attention ! Entrez un prénom correct");
        } else {
            $this->prenom = $newPrenom;
        }
    }

    public function setMatricule($newMatricule)
    {
        if (!preg_match("/^[a-zA-Z0-9]+$/", $newMatricule) || strlen($newMatricule) != 8) {
            throw new Exception("Attention ! Le matricule doit avoir 8 caractères composés de lettres et de chiffres, commençant par une lettre.");
        } else {
            $this->matricule = $newMatricule;
        }
    }

    public function setDateNaissance($newDateNaissance)
    {
        if (!DateTime::createFromFormat('d/m/Y', $newDateNaissance)) {
            throw new Exception("Attention ! Entrez une date de naissance correcte (format : jj/mm/aaaa)");
        } else {
            $this->dateNaissance = $newDateNaissance;
        }
    }


 

    public function Presenter()
    {
        return "Bonjour, je suis étudiant.e, je m'appelle {$this->prenom} {$this->nom}, je suis né(e) le : {$this->dateNaissance}, mon matricule est : {$this->matricule}";
    }
}
        
        



class Professeur extends Etudiant implements MethodeProfesseur
{
    private $salaire;
    private $voiture;

    public function __construct($matricule, $nom, $prenom, $salaire, $voiture)
    {
        parent::__construct($matricule, $nom, $prenom, '');
        $this->setSalaire($salaire);
        $this->setVoiture($voiture);
    }

    public function setSalaire($newSalaire)
    {
        if (!is_numeric($newSalaire) || $newSalaire < 0) {
            throw new Exception("Attention ! Le salaire doit être un nombre positif.");
        } else {
            $this->salaire = $newSalaire;
        }
    }

    public function setVoiture($newVoiture)
    {
        if (!is_bool($newVoiture)) {
            throw new Exception("Attention ! La valeur de la voiture doit être 'true' ou 'false'.");
        } else {
            $this->voiture = $newVoiture;
        }
    }

    public function Presenter()
    {
        $message = $this->voiture ? "j'ai une voiture" : "je n'ai pas de voiture";
        return "Salut, je suis professeur, je m'appelle {$this->prenom} {$this->nom}, je suis spécialisé dans le domaine de l'informatique et de la programmation, j'ai un salaire de {$this->salaire} FCFA, et $message";
    }

    public function EvaluerEtudiant($dateEvaluation)
    {
        if (!DateTime::createFromFormat('d/m/Y', $dateEvaluation)) {
            throw new Exception("La date n'est pas correcte (format : jj/mm/aaaa)");
        } else {
            return "Je vais évaluer les étudiants le $dateEvaluation";
        }
    }
}

try {
    $professeur = new Professeur("S1234567", "SEYDOU", "DIALLO", 3000000, true);
    echo $professeur->Presenter() . "\n";
    echo $professeur->EvaluerEtudiant("01/11/2023") . "\n";
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    $etudiant = new Etudiant("A7654321", "MOMAR", "TALL", "22/10/2000");
    echo $etudiant->Presenter() . "\n";
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    $professeur = new Professeur("S9815377", "SOULEYMANE", "DIOP", 3000000, true);
    echo $professeur->Presenter() . "\n";
    echo $professeur->EvaluerEtudiant("01/11/2023") . "\n";
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
