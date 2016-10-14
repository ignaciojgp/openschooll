<?php

    Class Installer {

        var $settings;
        var $dbcon;

        public function __construct ($s){
            $this->settings = $s;

            $this->dbcon = new PDOFromInit($this->settings);
            print_r("Installer".PHP_EOL);
        }

        public function installEntity($jsonFile){

            print_r("Installer".PHP_EOL);

            $objString = file_get_contents($jsonFile);

            $ed = json_decode($objString);

            //-----------------------------------------------------
            $findExistent = " SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?";
            $statem = $this->dbcon->prepare($findExistent);

            try{
                $statem->execute([
                        $this->settings['dbconnection']['database'],
                        $ed->name
                    ]);



                if($statem->fetch()['count'] == 1){
                    echo "update ".$ed->name." ".PHP_EOL;
                    $this->updateTable($ed);
                    return "update ".$ed->name;
                }else{
                    echo "create ".$ed->name." ".PHP_EOL;
                    //print("create \r");
                    $this->createTable($ed);
                    return "created".$ed->name;
                }
            }catch(Exception $e){
                return "error";
            }

            //-----------------------------------------------------




        }

        function createTable($ed){

            $q = "CREATE TABLE ".$ed->name." ( ";

            $q.="\r id int(11)  unsigned NOT NULL AUTO_INCREMENT ,";

            $count = 0;
            foreach ($ed->attributes as $key => $value) {
                if($count > 0) $q.=", ";

                $atr = $this->attrDefinition($key,$value);
                if($atr['type'] == "normal"){
                    $q.= "\r".$atr['definition'];
                }


                $count++;
            }
            $q.="\r PRIMARY KEY (id) ";
            $q.="\r ) ";


            $dbcon = new PDOFromInit($this->settings);
            $statement = $dbcon->prepare($q);
            $res = $statement->execute();
            //print_r($res);
            if($res){
                print("exito: al crear la tabla ".PHP_EOL);
            }else{
                print("error: al crear la tabla ".PHP_EOL);
            }



        }

        function updateTable($ed){

            $q = " DESCRIBE $ed->name ";
            $statement = $this->dbcon->prepare($q);
            $statement->execute();
            $descriptions = $statement->fetchAll();
            //print_r($descriptions);
            print("columnas existentes ".count($descriptions).PHP_EOL);
            print("columnas en descripcion ".count((array)$ed->attributes).PHP_EOL);


            foreach ($ed->attributes as $key => $value) {
                echo "------------------------------------------------------".PHP_EOL;
                echo "comparando: ".$key.PHP_EOL;

                $existent = null;
                foreach ($descriptions as $key2 => $value2) {
                    if($value2["Field"] == $key){
                        $existent = $value2;
                    }
                }



                $this->compareAttributes($value,$existent);


            }

        }

        function compareAttributes($definition,$existent){

            $needsModification = false;
            if(strpos($existent['Type'],$definition->type) != -1 ){
                $needsModification = true;
            }

            $existentsize = $existent["Type"];

            echo $existentsize;
            if($needsModification){
                echo "true".PHP_EOL;
            }else{

            }

        }


        function attrDefinition($key,$value){

            $attrType = "normal";
            $type =  $value->type;

            $isnumber = $type == "bit" || $type == "int" || $type == "smallint" || $type == "integer" || $type == "bigint" || $type == "decimal" || $type == "dec" || $type == "float" || $type == "double" ;

            $signed = isset($value->signed) && $isnumber ? ($value->signed? " signed ":" unsigned "):" ";
            $size = isset($value->size) ? "($value->size)" : " ";

            //----
            $notNull = isset($value->required) && $value->required == true ? " not null ":" ";
            $default = isset($value->default) ?  " default ".$value->default:" ";

            if($type=="string" ){
                if(isset($value->size)){
                    $type = "varchar";
                }else{
                    $type = "text";
                }
            }

            //--
            $finaltype = $type;

            if($type == "object"){
                $finaltype = "int";
                $size = isset($value->size) ? "($value->size)" : " (11) ";
            }

            if($type == "list"){
                $attrType ="foreight";
            }

            return ["type"=>$attrType, "definition"=>" $key $finaltype $size $signed $notNull $default  "];

        }

    }

?>
