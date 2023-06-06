<?php
    class Donnees{
        private $conn;
        private $table_name;

        public $id;
        public $identifiant;
        public $grandeur;
        public $donnees;
        public $donnees2;
        public $type;
        public $date_recept;

        public function __construct($db, $id, $identifiant, $grandeur, $donnees, $donnees2, $date_recept){
            $this->conn = $db;
            $this->id = $id;
            $this->identifiant = $identifiant;
            $this->grandeur = $grandeur;
            $this->donnees = $donnees;
            $this->donnees2 = $donnees2;
            $this->date_recept = $date_recept;
            if($this->grandeur == "temp")
            {
                $this->table_name = "DonneesTemp";
                //$this->jour = "TempJour";
            }else if($this->grandeur == "gaz") {
                $this->table_name = "DonneesGaz";
                $this->jour = "GazJour";
                $this->heure = "GazHeure";
                $this->semaine = "GazSemaine";
                $this->mois = "GazMois";
                $this->annee = "GazAnnee";
            }else if($this->grandeur == "elec") {
                $this->table_name = "DonneesElec";
                $this->jour = "ElecJour";
                $this->heure = "ElecHeure";
                $this->semaine = "ElecSemaine";
                $this->mois = "ElecMois";
                $this->annee = "ElecAnnee";
            }else if($this->grandeur == "eau") {
                $this->table_name = "DonneesEau";
                $this->jour = "EauJour";
                $this->heure = "EauHeure";
                $this->semaine = "EauSemaine";
                $this->mois = "EauMois";
                $this->annee = "EauAnnee";
            }else if($this->grandeur == "chauff") {
                $this->table_name = "DonneesChauff";
                $this->jour = "ChauffJour";
                $this->heure = "ChauffHeure";
                $this->semaine = "ChauffSemaine";
                $this->mois = "ChauffMois";
                $this->annee = "ChauffAnnee";
            }else{
                print("Erreur de grandeur");
            }
        }

        function readOne(){

            $query = "SELECT
                        identifiant, donnees, donnees2, date_recept
                      FROM
                        " . $this->table_name . "
                      WHERE
                          id = {$this->id}
                      LIMIT
                        0,1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row)
                return false;
            return true;
        }

        function delete(){
            $query = "DELETE FROM "
                        .$this->table_name.
                      " WHERE id="
                        .$this->id. ";";
            $this->id=intval($this->id);
            $stmt = $this->conn->prepare($query);
            print($query);
            return $stmt->execute();
        }

        function deleteTime(){
            $query = "DELETE FROM"
                        .$this->table_name.
                      "WHERE
                        date_recept = :date_recept";
            $this->date_recept = date('Y-m-d H:i:s', strtotime($this->date_recept));
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':date_recept', $this->date_recept);

            return $stmt->execute();
        }

        function readAll(){
            $query = "SELECT * FROM " . $this->table_name . "";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        function countAll(){
            $query = "SELECT id FROM ".$this->table_name;

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
            return $stmt->rowCount();
        }

        function maxID($table)
        {
            $query = "SELECT MAX(id) AS max FROM ". $table;

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        function update(){
            $query = "UPDATE "
                         .$this->table_name.
                      " SET 
                          id = :id,
                          identifiant=:identifiant, 
                          donnees=:donnees, 
                          donnees2=:donnees2, 
                          date_recept=:date_recept
                      WHERE
                          id = :id";

            $this->id = intval($this->id);
            $this->identifiant = intval($this->identifiant);
            $this->donnees = floatval($this->donnees);
            $this->donnees2 = floatval($this->donnees2);

            $this->grandeur = htmlspecialchars(strip_tags($this->grandeur));
            $this->date_recept = date('Y-m-d H:i:s', strtotime($this->date_recept));

            $stmt = $this->conn->prepare($query);
            echo $query;
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":identifiant", $this->identifiant);
            $stmt->bindParam(":donnees", $this->donnees);
            $stmt->bindParam(":donnees2", $this->donnees2);
            $stmt->bindParam(":date_recept", $this->date_recept);

            if($stmt->execute()){
                return true;
            }else {
                return false;
            }
    }

        function create(){
            print($this->id);

            $query = "INSERT INTO "
                    .$this->table_name.
                " SET
                    identifiant=:identifiant, donnees=:donnees, donnees2=:donnees2, date_recept=:date_recept";
            print($query);

            $this->identifiant = intval($this->identifiant);
            $this->donnees = floatval($this->donnees);
            $this->donnees2 = floatval($this->donnees2);

            $this->grandeur=htmlspecialchars(strip_tags($this->grandeur));
            $this->date_recept=date('Y-m-d H:i:s', strtotime($this->date_recept));

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":identifiant", $this->identifiant);
            $stmt->bindParam(":donnees", $this->donnees);
            $stmt->bindParam(":donnees2", $this->donnees2);
            $stmt->bindParam(":date_recept", $this->date_recept);

            if($stmt->execute()){
                return true;
            }else {
                return false;
            }
        }

        function repart($table, $data){
            $query = "INSERT IGNORE INTO ".$data."Jour (dateJour, conso)
            SELECT DATE(date_recept), SUM(diff) AS total_diff
                FROM (
                SELECT identifiant, DATE(date_recept), (MAX(donnees) - MIN(donnees)) + (MAX(donnees2) - MIN(donnees2)) AS diff, date_recept
                FROM ".$table." 
                GROUP BY identifiant, DATE(date_recept)
                ) AS subquery
            GROUP BY DATE(date_recept)
            ORDER BY DATE(date_recept)";

            $query2 = "UPDATE ".$data."Jour
INNER JOIN (
  SELECT date_recept AS date_recept, SUM(diff) AS total_diff
  FROM (
    SELECT identifiant, date_recept, (MAX(donnees) - MIN(donnees)) + (MAX(donnees2) - MIN(donnees2)) AS diff 
    FROM ".$table." 
    GROUP BY identifiant, DATE(date_recept)
  ) AS subquery
  GROUP BY DATE(date_recept)
) AS subquery ON ".$data."Jour.dateJour = DATE(subquery.date_recept)
SET ".$data."Jour.conso = subquery.total_diff;";
            print($query);

            $querySemaine = "INSERT IGNORE INTO ".$data."Semaine (conso, dateSemaine)
            SELECT SUM(conso), DATE_ADD(dateJour, INTERVAL(1-DAYOFWEEK(dateJour)) DAY) AS dateDebutSemaine
            FROM ".$data."Jour
            GROUP BY YEAR(dateJour), WEEK(dateJour);";
            $querySemaine2 = "UPDATE ".$data."Semaine es
            INNER JOIN (
                SELECT YEAR(dateJour) AS annee, WEEK(dateJour) AS semaine, SUM(conso) AS totalConso
                FROM ".$data."Jour
                GROUP BY YEAR(dateJour), WEEK(dateJour)
            ) ej ON YEAR(es.dateSemaine) = ej.annee AND WEEK(es.dateSemaine) = ej.semaine
            SET es.conso = ej.totalConso;";

            $queryMois = "INSERT IGNORE INTO ".$data."Mois (conso, dateMois)
            SELECT SUM(conso), DATE_FORMAT(dateJour, '%Y-%m-01') AS dateDebutMois
            FROM ".$data."Jour
            GROUP BY YEAR(dateJour), MONTH(dateJour);";
            $queryMois2 = "UPDATE ".$data."Mois
            JOIN (
                SELECT SUM(conso) AS sommeConso, DATE_FORMAT(dateJour, '%Y-%m-01') AS dateDebutMois
                FROM ".$data."Jour
                GROUP BY YEAR(dateJour), MONTH(dateJour)
            ) AS ".$data."JourMensuel
            ON ".$data."JourMensuel.dateDebutMois = ".$data."Mois.dateMois
            SET ".$data."Mois.conso = ".$data."JourMensuel.sommeConso;";

            $queryAnnee = "INSERT IGNORE INTO ".$data."Annee (conso, dateAnnee)
            SELECT SUM(conso), DATE_FORMAT(dateMois, '%Y-01-01') AS dateDebutAnnee
            FROM ".$data."Mois
            GROUP BY YEAR(dateMois);";
            $queryAnnee2 = "UPDATE ".$data."Annee
            JOIN (
                SELECT SUM(conso) AS sommeConso, DATE_FORMAT(dateMois, '%Y-01-01') AS dateDebutAnnee
                FROM ".$data."Mois
                GROUP BY YEAR(dateMois)
            ) AS ".$data."MoisAnnuel
            ON ".$data."MoisAnnuel.dateDebutAnnee = ".$data."Annee.dateAnnee
            SET ".$data."Annee.conso = ".$data."MoisAnnuel.sommeConso;";

            $stmt = $this->conn->prepare($query);
            $stmt2 = $this->conn->prepare($query2);
            $stmtSemaine = $this->conn->prepare($querySemaine);
            $stmtSemaine2 = $this->conn->prepare($querySemaine2);
            $stmtMois = $this->conn->prepare($queryMois);
            $stmtMois2 = $this->conn->prepare($queryMois2);
            $stmtAnnee = $this->conn->prepare($queryAnnee);
            $stmtAnnee2 = $this->conn->prepare($queryAnnee2);

            if($stmt->execute() && $stmt2->execute() && $stmtSemaine->execute() && $stmtSemaine2->execute()
            && $stmtMois->execute() && $stmtMois2->execute() && $stmtAnnee->execute() && $stmtAnnee2->execute()){
                return true;
            }
            return false;
        }
    }