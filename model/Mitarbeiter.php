<?php

require_once "DatabaseObject.php";

class Mitarbeiter implements DatabaseObject
{

    private $mitarbeiter_id = '';
    private $mitarbeiter_vorname = '';
    private $mitarbeiter_nachname = '';
    private $mitarbeiter_benutzername = '';
    private $mitarbeiter_passwort = '';
    private $mitarbeiter_datum = '';
    private $mitarbeiter_role = '';


    public static function getAll()
    {

        $db = Database::connect();
        $sql = 'SELECT * FROM mitarbeiter WHERE mitarbeiter_role="admin" OR mitarbeiter_role="mitarbeiter" ORDER BY mitarbeiter_role ASC, mitarbeiter_nachname, mitarbeiter_vorname';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
        Database::disconnect();

        return $items;
    }

    public static function getAllAdmins()
    {

        $db = Database::connect();
        $sql = 'SELECT * FROM mitarbeiter WHERE mitarbeiter_role="admin" ORDER BY mitarbeiter_role ASC, mitarbeiter_nachname, mitarbeiter_vorname';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
        Database::disconnect();

        return $items;
    }

    public static function getAllMitarbeiter()
    {

        $db = Database::connect();
        $sql = 'SELECT * FROM mitarbeiter WHERE mitarbeiter_role="mitarbeiter" ORDER BY mitarbeiter_role ASC, mitarbeiter_nachname, mitarbeiter_vorname';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
        Database::disconnect();

        return $items;
    }

    public static function getUnterschiedlicheMitarbeiterRollen($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM mitarbeiter WHERE mitarbeiter_role = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        $item = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
        Database::disconnect();

        return $item !== false ? $item : null;
    }

    public static function getAllWithViewer()
    {

        $db = Database::connect();
        $sql = 'SELECT * FROM mitarbeiter ORDER BY mitarbeiter_role ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
        Database::disconnect();

        return $items;
    }


    public function update(){
        $db = Database::connect();
        $sql = "UPDATE mitarbeiter set mitarbeiter_vorname = ?, mitarbeiter_nachname = ?, mitarbeiter_benutzername = ?,                             mitarbeiter_passwort = ?, mitarbeiter_role = ? WHERE mitarbeiter_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->mitarbeiter_vorname, $this->mitarbeiter_nachname, $this->mitarbeiter_benutzername,                              $this->mitarbeiter_passwort, $this->mitarbeiter_role, $this->mitarbeiter_id));
        Database::disconnect();
    }

    public function create()
    {
        $db = Database::connect();
        $sql = "INSERT INTO mitarbeiter (mitarbeiter_vorname, mitarbeiter_nachname, mitarbeiter_benutzername, mitarbeiter_passwort, mitarbeiter_datum, mitarbeiter_role) values(?, ?, ?, ?, ?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->mitarbeiter_vorname, $this->mitarbeiter_nachname, $this->mitarbeiter_benutzername, $this->mitarbeiter_passwort, $this->mitarbeiter_datum, $this->mitarbeiter_role));
        Database::disconnect();
    }

    public static function get($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM mitarbeiter WHERE mitarbeiter_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        $item = $stmt->fetchObject('Mitarbeiter');
        Database::disconnect();

        return $item !== false ? $item : null;
    }

    public static function delete($id){
        $db = Database::connect();
        $sql = "DELETE FROM mitarbeiter WHERE mitarbeiter_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }


    /**
     * @return string
     */
    public function getMitarbeiterId()
    {
        return $this->mitarbeiter_id;
    }

    /**
     * @param string $mitarbeiter_id
     */
    public function setMitarbeiterId($mitarbeiter_id)
    {
        $this->mitarbeiter_id = $mitarbeiter_id;
    }

    /**
     * @return string
     */
    public function getMitarbeiterVorname()
    {
        return $this->mitarbeiter_vorname;
    }

    /**
     * @param string $mitarbeiter_vorname
     */
    public function setMitarbeiterVorname($mitarbeiter_vorname)
    {
        $this->mitarbeiter_vorname = $mitarbeiter_vorname;
    }

    /**
     * @return string
     */
    public function getMitarbeiterNachname()
    {
        return $this->mitarbeiter_nachname;
    }

    /**
     * @param string $mitarbeiter_nachname
     */
    public function setMitarbeiterNachname($mitarbeiter_nachname)
    {
        $this->mitarbeiter_nachname = $mitarbeiter_nachname;
    }

    /**
     * @return string
     */
    public function getMitarbeiterBenutzername()
    {
        return $this->mitarbeiter_benutzername;
    }

    /**
     * @param string $mitarbeiter_benutzername
     */
    public function setMitarbeiterBenutzername($mitarbeiter_benutzername)
    {
        $this->mitarbeiter_benutzername = $mitarbeiter_benutzername;
    }

    /**
     * @return string
     */
    public function getMitarbeiterPasswort()
    {
        return $this->mitarbeiter_passwort;
    }

    /**
     * @param string $mitarbeiter_passwort
     */
    public function setMitarbeiterPasswort($mitarbeiter_passwort)
    {
        $this->mitarbeiter_passwort = $mitarbeiter_passwort;
    }

    public function getMitarbeiterDatum()
    {
        return $this->mitarbeiter_datum;
    }

    public function setMitarbeiterDatum($mitarbeiter_datum)
    {
        $this->mitarbeiter_datum = $mitarbeiter_datum;
    }
    /**
     * @return string
     */
    public function getMitarbeiterRole()
    {
        return $this->mitarbeiter_role;
    }

    /**
     * @param string $mitarbeiter_role
     */
    public function setMitarbeiterRole($mitarbeiter_role)
    {
        $this->mitarbeiter_role = $mitarbeiter_role;
    }



}