<?php
require_once "DatabaseObject.php";

class Produkt implements DatabaseObject
{

    private $produkt_id = "";
    private $produkt_bez = "";
    private $produkt_menge = "";
    private $produkt_preis = "";
    private $produkt_bild ="";
    private $produkt_datum ="";
    private $produkt_beschreibung ="";
    private $produkt_link ="";
    private $produkt_mindest_menge ="";

    public static function getAll()
    {
        $db = Database::connect();
        $sql = 'SELECT * FROM produkt ORDER BY produkt_id ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Produkt');
        Database::disconnect();

        return $items;
    }

    public function create(){
        $db = Database::connect();
        $sql = "INSERT INTO produkt (produkt_id, produkt_bez, produkt_menge, produkt_preis, produkt_bild, produkt_datum, produkt_beschreibung, produkt_link, produkt_mindest_menge) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->produkt_id, $this->produkt_bez, $this->produkt_menge, $this->produkt_preis, $this->produkt_bild, $this->produkt_datum, $this->produkt_beschreibung, $this->produkt_link, $this->produkt_mindest_menge));
        Database::disconnect();
    }

    public function update(){
        $db = Database::connect();
        $sql = "UPDATE produkt set produkt_bez = ?, produkt_menge = ?, produkt_preis = ?, produkt_bild = ?, produkt_datum = ?, produkt_beschreibung = ?, produkt_link = ?, produkt_mindest_menge = ? WHERE produkt_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->produkt_bez, $this->produkt_menge, $this->produkt_preis, $this->produkt_bild, $this->produkt_datum, $this->produkt_beschreibung, $this->produkt_link, $this->produkt_mindest_menge, $this->produkt_id));
        Database::disconnect();
    }

    public static function get($id){
        $db = Database::connect();
        $sql = "SELECT * FROM produkt WHERE produkt_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        $item = $stmt->fetchObject('Produkt');
        Database::disconnect();

        return $item !== false ? $item : null;
    }


    public static function delete($id){
        $db = Database::connect();
        $sql = "DELETE FROM produkt WHERE produkt_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }


    public function getProduktId()
    {
        return $this->produkt_id;
    }

    public function setProduktId($produkt_id)
    {
        $this->produkt_id = $produkt_id;
    }

    public function getProduktBez()
    {
        return $this->produkt_bez;
    }

    public function setProduktBez($produkt_bez)
    {
        $this->produkt_bez = $produkt_bez;
    }

    public function getProduktMenge()
    {
        return $this->produkt_menge;
    }

    public function setProduktMenge($produkt_menge)
    {
        $this->produkt_menge = $produkt_menge;
    }

    public function getProduktPreis()
    {
        return $this->produkt_preis;
    }

    public function setProduktPreis($produkt_preis)
    {
        $this->produkt_preis = $produkt_preis;
    }

    public function getProduktBild()
    {
        return $this->produkt_bild;
    }

    public function setProduktBild($produkt_bild)
    {
        $this->produkt_bild = $produkt_bild;
    }

    public function getProduktDatum()
    {
        return $this->produkt_datum;
    }

    public function setProduktDatum($produkt_datum)
    {
        $this->produkt_datum = $produkt_datum;
    }

    public function getProduktBeschreibung()
    {
        return $this->produkt_beschreibung;
    }

    public function setProduktBeschreibung($produkt_beschreibung)
    {
        $this->produkt_beschreibung = $produkt_beschreibung;
    }

    public function getProduktLink()
    {
        return $this->produkt_link;
    }

    public function setProduktLink($produkt_link)
    {
        $this->produkt_link = $produkt_link;
    }

    public function getProduktMinMenge()
    {
        return $this->produkt_mindest_menge;
    }

    public function setProduktMinMenge($produkt_mindest_menge)
    {
        $this->produkt_mindest_menge = $produkt_mindest_menge;
    }


}