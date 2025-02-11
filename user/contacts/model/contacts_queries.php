<?php

    function fetch_user_contacts($db){
        try{
            $query = 'SELECT * FROM user_contacts ORDER BY contact_fullname ASC';
            $statement = $db->prepare($query);
            $statement->execute();
            $query_results = $statement->fetchAll();
            $statement->closeCursor();
            return $query_results;
        }catch (PDOException $e) {
            //? Genera un error cuando hay problema con la solicitud del query a la base datos
            error_log("Database error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            //? generar error cuando hay error de sintaxis o cualquier otro tipo de error
            error_log("Error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        }
        
    }

    function search_user_contacts($db, $busquedaNombre) {
        try{
            $query = 'SELECT * FROM user_contacts WHERE contact_fullname LIKE :contact_fullname';
            $statement = $db->prepare($query);
            $statement->bindValue(':contact_fullname', "%$busquedaNombre%", PDO::PARAM_STR);
            $statement->execute();
            $query_results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
          
            return $query_results;
        }catch (PDOException $e) {
            //? Genera un error cuando hay problema con la solicitud del query a la base datos
            error_log("Database error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            //? generar error cuando hay error de sintaxis o cualquier otro tipo de error
            error_log("Error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        }

    }    

    function fetch_contact_by_id($db, $contact_id) {
        try{
            $query = 'SELECT * FROM user_contacts WHERE contact_id = :contact_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
            $statement->execute();
            $contact = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
        
            return $contact;
        }catch (PDOException $e) {
            //? Genera un error cuando hay problema con la solicitud del query a la base datos
            error_log("Database error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            //? generar error cuando hay error de sintaxis o cualquier otro tipo de error
            error_log("Error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        }

    }

    function update_contact($db, $contact_id, $contact_fullname, $contact_mobile, $contact_email, $contact_company) {
        try{
            $query = 'UPDATE user_contacts 
            SET contact_fullname = :contact_fullname, 
                contact_mobile = :contact_mobile, 
                contact_email = :contact_email, 
                contact_company = :contact_company 
            WHERE contact_id = :contact_id';

            $statement = $db->prepare($query);
            $statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
            $statement->bindValue(':contact_fullname', $contact_fullname, PDO::PARAM_STR);
            $statement->bindValue(':contact_mobile', $contact_mobile, PDO::PARAM_STR);
            $statement->bindValue(':contact_email', $contact_email, PDO::PARAM_STR);
            $statement->bindValue(':contact_company', $contact_company, PDO::PARAM_STR);

            $success = $statement->execute();
            $statement->closeCursor();

            return $success;
        }catch (PDOException $e) {
            //? Genera un error cuando hay problema con la solicitud del query a la base datos
            error_log("Database error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            //? generar error cuando hay error de sintaxis o cualquier otro tipo de error
            error_log("Error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        }
    }    

    function delete_contact($db, $contact_id){
        try{
            $query = 'DELETE FROM user_contacts WHERE contact_id = :contact_id';
            $statement = $db->prepare($query);
            $statement->bindParam(':contact_id', $contact_id, PDO::PARAM_INT);
        
            $success = $statement->execute();  
            $statement->closeCursor();
        
            return $success;
        }catch (PDOException $e) {
            //? Genera un error cuando hay problema con la solicitud del query a la base datos
            error_log("Database error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            //? generar error cuando hay error de sintaxis o cualquier otro tipo de error
            error_log("Error in fetch_variable_data: " . $e->getMessage());
            throw $e;
        }    
    }     
    
    function create_contact($db, $contact_fullname, $contact_mobile, $contact_email, $contact_company, $image_path) {
        try {
            $query = 'INSERT INTO user_contacts (contact_fullname, contact_mobile, contact_email, contact_company, image_path) 
                      VALUES (:contact_fullname, :contact_mobile, :contact_email, :contact_company, :image_path)';
    
            $statement = $db->prepare($query);
            $statement->bindValue(':contact_fullname', $contact_fullname, PDO::PARAM_STR);
            $statement->bindValue(':contact_mobile', $contact_mobile, PDO::PARAM_STR);
            $statement->bindValue(':contact_email', $contact_email, PDO::PARAM_STR);
            $statement->bindValue(':contact_company', $contact_company, PDO::PARAM_STR);
            $statement->bindValue(':image_path', $image_path, PDO::PARAM_STR);
    
            $success = $statement->execute();
            $statement->closeCursor();
    
            return $success;
        } catch (PDOException $e) {
            error_log("Database error in create_contact: " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            error_log("Error in create_contact: " . $e->getMessage());
            throw $e;
        }
    }
    
    
?>