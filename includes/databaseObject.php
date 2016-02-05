<?php
class DatabaseObject {
    /**
     * Queries the database and returns all entries in the table
     */
    public static function findAll() {
        $sql = "SELECT * FROM " . static::$table_name;
        $results = static::findBySQL($sql);

        return $results;
    }

    /**
     * Queries the database and returns data for the specified id value 
     */
    public static function findById($id="") {
        if(!empty($id)) {
            $id = intval($id);
            $sql = "SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1";
            $results = static::findBySQL($sql);
            return $results[0];
        }
    }

    /**
     * Queries the database and returns all data for a specified query string
     */
    public static function findBySQL($sql="", $paramArray=array()) {
        global $db;

        if(!empty($sql)) {
            $object_array = array();
            try {
                $results = $db->prepare($sql);
                $results->execute($paramArray);
                while($row = $results->fetch(PDO::FETCH_ASSOC)) {
                    $object_array[] = static::instantiate($row);
                }
                return $object_array;
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
        } 
        else {
            return false;
        }
    }

    /**
     * Creates and returns a new object with the specified array containing properties and values 
     */
    private static function instantiate($record) {
        $object = new static;
    
        foreach($record as $attribute=>$value) {
            if(property_exists($object, $attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    

    /*
     * Checks whether there is a field containing a specified value in the database
     */
    public static function fieldValueExists($field="", $value="") {
        if(!empty($field) && !empty($value)) {
            $sql = "SELECT * FROM " . static::$table_name . " WHERE $field = ? LIMIT 1";
            
            if(static::findBySql($sql,array($value))) {
                return true;   
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     * Calls the correct method to either update or create a new database entry
     */
    public function save($updateAttributes="") {
        if(isset($this->id)) {
            $this->update($updateAttributes);
        }
        else {
            $this->create();
        }
    }

    /**
     * Updates an entry in the database
     */
    private function update($updateAttributes) {
        global $db;

        $attributeError = false;
        if(is_array($updateAttributes)) {
            foreach($updateAttributes as $attribute) {
                if(!property_exists($this, $attribute)) {
                    $attributeError = true;
                    break;
                }
            }

            if($attributeError === true) {
                $attributes = static::$db_fields;
            }
            else {
                $attributes = $updateAttributes;
            }
        }
        else {
            $attributes = static::$db_fields;
        }

        $attributePairs = array();

        foreach($attributes as $attribute) {
            $attributePairs[] = $attribute . " = ?";
        }
        
        try {
            $sql = "UPDATE " . static::$table_name . " SET ";

            $sql .= join(", ", $attributePairs);
            $sql .= " WHERE id = ?";

            $results = $db->prepare($sql);
            for($ii=1;$ii<=count($attributes);$ii++) {
                $attribute = $attributes[$ii-1];
                $results->bindParam($ii, $this->$attribute);
            }
            $results->bindParam((count($attributes)+1), $this->id);

            $results->execute();
        }
        catch(Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Creates a new entry into the database
     */
    private function create() {
        global $db;

        $attributes = static::$db_fields;

        try {
            $sql = "INSERT INTO " . static::$table_name . " (";
            $sql .= join(", ", $attributes);
            $sql .= ") VALUES (";
            for($ii = 0;$ii < count($attributes);$ii++) {
                $sql.= "?";
                if($ii !== (count($attributes) - 1)) {
                    $sql .= ", ";
                }
            }
            $sql .= ")";
            
            $results = $db->prepare($sql);

            for($ii=1;$ii <= count($attributes);$ii++) {
                $attribute = $attributes[$ii-1];
                $results->bindParam($ii, $this->$attribute);
            }
            $results->execute();

            $this->id = $db->lastInsertId();
        }
        catch(Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Deletes an entry in the database
     */
    public function delete() {
        global $db;

        try {
            $sql = "DELETE FROM " . static::$table_name . " WHERE id = ?";
            $result = $db->prepare($sql);
            $result->bindValue(1,$this->id,PDO::PARAM_INT);
            $result->execute();
        }
        catch(Exception $e) {
            die("Error removing from database.");
        }
    }
}

?>
