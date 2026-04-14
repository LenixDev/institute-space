<?php
  $table[0] = 'Lenix';
  echo $table[0] . "\n";
  echo "\n";
  
  $table = ['Dev', 'Lenix', 20];
  foreach($table as $i) {
    echo $i . "\n";
  }
  echo "\n";
  
  $table = array("Lenix", 20, "Dev");
  foreach($table as $i) {
    echo $i . "\n";
  }
  echo "\n";
  
  $table = [];
  $table[] = 20;
  $table[] = "Lenix";
  $table[] = "Dev";
  foreach($table as $i) {
    echo $i . "\n";
  }
  echo "\n";
  
  $table = array();
  $table[] = "Dev";
  $table[] = 20;
  $table[] = "Lenix";
  foreach($table as $i) { 
    echo $i . "\n";
  }
  echo "\n";
  
  $table = array(1 => "Lenix", 20, "Dev");
  echo $table[3] . "\n";
  echo "\n";
  
  $table = array("Lenix", "Dev", 20);
  for ($i = 0; $i < count($table); $i++) {
    echo $table[$i] . "\n";
  }
  echo "\n";
  
  $table = 0;
  while($table <=3) {
    echo $table++ . "\n";
  }
  echo "\n";

  $table = [
    "name" => "Lenix",
    "lastname" => "Dev",
    "age" => 20,
  ];
  
  foreach($table as $key => $value) {
    echo $key . " " . $value . "\n";
  }
  echo "\n";

  $table = array(
    0 => array(
      "nom" => "mirazka",
      "prenom" => "manel",
      "adresse_email" => "kamzer71@gmail.com"
    ),
    1 => array(
      "nom" => "boukra",
      "prenom" => "salim",
      "adresse_email" => "ifita@gmail.com"
    ),
    2 => array(
      "nom" => "kalem",
      "prenom" => "yassine",
      "adresse_email" => "Ecofam@gmail.com"
    ),
  );
  
  foreach($table as $cle1 => $valuer1) {
    echo "n: " . $cle1 . " ";
    foreach($valuer1 as $cle2 => $valeur2) {
      echo $cle2 . " => " . $valeur2 . "\n"; 
    }
    echo "\n";
  }

  ?>
