<?php
class Broker
{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new Mysqli('localhost','root','','studentskasluzba');
        $this->konekcija->set_charset("utf8");
    }

    public function login($username, $password)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM student where username = ? AND password = ?");
        $pStatement->bind_param("ss",$username,$password);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            $_SESSION['student'] = $rez;
            return true;
        }

        $pStatement = $this->konekcija->prepare("SELECT * FROM korisnik where username = ? AND password = ?");
        $pStatement->bind_param("ss",$username,$password);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            $_SESSION['korisnik'] = $rez;
            return true;
        }

        return false;

    }

    public function promeniSifru($novaSifra, $brojIndeksa)
    {
        $pStatement = $this->konekcija->prepare("UPDATE student SET password = ? WHERE brojIndeksa = ?");
        $pStatement->bind_param("ss",$novaSifra,$brojIndeksa);
        $uspesno =  $pStatement->execute();

        $pStatement = $this->konekcija->prepare("SELECT * FROM student where brojIndeksa = ?");
        $pStatement->bind_param("s",$brojIndeksa);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            $_SESSION['student'] = $rez;
            return $uspesno;
        }
    }

    public function promeniSliku($slika,$brojIndeksa)
    {
        $pStatement = $this->konekcija->prepare("UPDATE student SET slika = ? WHERE brojIndeksa = ?");
        $pStatement->bind_param("ss",$slika,$brojIndeksa);
        $uspesno =  $pStatement->execute();

        $pStatement = $this->konekcija->prepare("SELECT * FROM student where brojIndeksa = ?");
        $pStatement->bind_param("s",$brojIndeksa);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            $_SESSION['student'] = $rez;
            return $uspesno;
        }
    }

    public function vratiRokove()
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM rok ");
        $pStatement->execute();
        $result = $pStatement->get_result();

        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function vratiPrijavePretraga($brojIndeksa, $rokID)
    {

        $pStatement = $this->konekcija->prepare("SELECT * FROM prijava p join rok r on p.rokID = r.rokID join student s on p.brojIndeksa = s.brojIndeksa join predmet pr on p.predmetID = pr.predmetID");
        $pStatement->execute();
        $result = $pStatement->get_result();

        $niz = [];

        while($rez = $result->fetch_object()){
            if($rez->brojIndeksa == $brojIndeksa && ($rokID == -1 || $rokID == $rez->rokID)){
                $niz[] = $rez;
            }
        }

        return $niz;
    }

    public function vratiPredmete()
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM predmet ");
        $pStatement->execute();
        $result = $pStatement->get_result();

        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function unesiPrijavu($brojIndeksa, $rokID, $predmetID)
    {
        $pStatement = $this->konekcija->prepare("INSERT INTO prijava(brojIndeksa,rokID,predmetID) VALUES (?,?,?)");
        $pStatement->bind_param("sii",$brojIndeksa,$rokID,$predmetID);
        return $pStatement->execute();
    }

    public function vratiPrijaveNi()
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM prijava p join rok r on p.rokID = r.rokID join student s on p.brojIndeksa = s.brojIndeksa join predmet pr on p.predmetID = pr.predmetID WHERE p.ocena = 'NI' ");
        $pStatement->execute();
        $result = $pStatement->get_result();

        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function unesiKorisnika($niz)
    {
        $imePrezimeKorisnika = $niz['imePrezimeKorisnika'];
        $username = $niz['username'];
        $password = $niz['password'];

        $pStatement = $this->konekcija->prepare("INSERT INTO korisnik VALUES (null,?,?,?)");
        $pStatement->bind_param("sss",$imePrezimeKorisnika,$username,$password);
        return $pStatement->execute();
    }

    public function vratiKorisnike()
    {
        $pStatement = $this->konekcija->prepare("SELECT korisnikID,imePrezimeKorisnika FROM korisnik");
        $pStatement->execute();
        $result = $pStatement->get_result();

        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function vratiPodatkeZaGrafik()
    {
        $pStatement = $this->konekcija->prepare("SELECT p.ocena,count(p.id) as brojPrijava FROM prijava p GROUP BY p.ocena ");
        $pStatement->execute();
        $result = $pStatement->get_result();

        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function promeniOcenu($prijava, $ocena)
    {
        $pStatement = $this->konekcija->prepare("UPDATE prijava SET ocena = ? WHERE id = ?");
        $pStatement->bind_param("si",$ocena,$prijava);
        return $pStatement->execute();
    }

    public function unseiStudenta($brojIndeksa, $imePrezime, $godina, $grad, $username, $password)
    {
        $pStatement = $this->konekcija->prepare("INSERT INTO student VALUES (?,?,?,?,'',?,?)");
        $pStatement->bind_param("ssisss",$brojIndeksa,$imePrezime,$godina,$grad,$username,$password);
        return $pStatement->execute();
    }
}