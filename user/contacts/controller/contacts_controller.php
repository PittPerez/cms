<?php


    require "../model/contacts_queries.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_request = filter_input(INPUT_POST, 'user_request');
    } else {
        $user_request = filter_input(INPUT_GET, 'user_request');
    }
    
    set_error_handler(function($errno, $errstr, $errfile, $errline) {
        if ($errno === E_WARNING) {
            // Convert warning to an exception
            throw new ErrorException("Warning: $errstr in $errfile on line $errline", 0, $errno, $errfile, $errline);
        }
        // For other error types, use the default handler
        return false;
    });
    
    switch($user_request) {
        //fetch all contacts
        case 'fetch_all_contacts':
            try{
                include '../../../utilities/db_conn.php';
                $user_contacts = fetch_user_contacts($db);
                $content = '';
                ob_start();
                foreach($user_contacts as $contact):
                    //Establecer variables
                    $contact_id = $contact['contact_id'];
                    $contact_fullname = $contact['contact_fullname'];
                    $contact_mobile = $contact['contact_mobile'];
                    $contact_email = $contact['contact_email'];
                    $contact_company = $contact['contact_company'];
                    //llamar vista
                    include "../../components/row_view.php";
                endforeach;
                $content = ob_get_clean();

                echo json_encode(['status' => 'success', 'view' => $content]);
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;

        //BUSQUEDA
        case 'search_user_contacts':
            try{
                include '../../../utilities/db_conn.php';
                $busquedaNombre = filter_input(INPUT_POST, 'busquedaNombre', FILTER_SANITIZE_STRING);
            
                if ($busquedaNombre !== null) {
                    $user_contacts = search_user_contacts($db, $busquedaNombre);

                    $content = '';
                    ob_start();
                    foreach($user_contacts as $contact):
                        $contact_id = $contact['contact_id'];
                        $contact_fullname = $contact['contact_fullname'];
                        $contact_mobile = $contact['contact_mobile'];
                        $contact_email = $contact['contact_email'];
                        $contact_company = $contact['contact_company'];
                        include "../../components/row_view.php";
                    endforeach;

                    $content = ob_get_clean();
                    echo json_encode(['status' => 'success', 'view' => $content]);
                }
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;    
        
        //DETALLES PARA EL PRIMER MODAL
        case 'contact_details':
            try{
                include '../../../utilities/db_conn.php';
                $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
            
                if ($contact_id) {
                    $contact = fetch_contact_by_id($db, $contact_id);
                    $content = '';
                    ob_start(); 

                    $contact_id = $contact['contact_id'];
                    $contact_fullname = $contact['contact_fullname'];
                    $contact_mobile = $contact['contact_mobile'];
                    $contact_email = $contact['contact_email'];
                    $contact_company = $contact['contact_company'];
                    include "../../components/modal1.php";

                    $content = ob_get_clean();
                    echo json_encode(['status' => 'success', 'view' => $content]);
                }
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;   

        //ACTUALIZAR SEGUNDO MODAL
        case 'update_contact':
            try{
                include '../../../utilities/db_conn.php';
                $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
                $contact_fullname = filter_input(INPUT_POST, 'contact_fullname', FILTER_SANITIZE_STRING);
                $contact_mobile = filter_input(INPUT_POST, 'contact_mobile', FILTER_SANITIZE_STRING);
                $contact_email = filter_input(INPUT_POST, 'contact_email', FILTER_SANITIZE_EMAIL);
                $contact_company = filter_input(INPUT_POST, 'contact_company', FILTER_SANITIZE_STRING);
            
                if ($contact_id && $contact_fullname && $contact_mobile && $contact_email && $contact_company) {
                    $updated = update_contact($db, $contact_id, $contact_fullname, $contact_mobile, $contact_email, $contact_company);        
                }
    
                $contact = fetch_contact_by_id($db, $contact_id);
                $content = '';
                ob_start();  

                $contact_id = $contact['contact_id'];
                $contact_fullname = $contact['contact_fullname'];
                $contact_mobile = $contact['contact_mobile'];
                $contact_email = $contact['contact_email'];
                $contact_company = $contact['contact_company'];
                include "../../components/modal1.php";

                $content = ob_get_clean();
                echo json_encode(['status' => 'success', 'view' => $content]);
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;

        case 'contact_edit_details':
            try{
                include '../../../utilities/db_conn.php';
                $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
            
                if ($contact_id) {
                    $contact = fetch_contact_by_id($db, $contact_id);
                    $content = '';
                    ob_start();  

                    $contact_id = $contact['contact_id'];
                    $contact_fullname = $contact['contact_fullname'];
                    $contact_mobile = $contact['contact_mobile'];
                    $contact_email = $contact['contact_email'];
                    $contact_company = $contact['contact_company'];
                    include "../../components/modal2.php";

                    $content = ob_get_clean();
                    echo json_encode(['status' => 'success', 'view' => $content]);
                }
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;

        //intento borrar
        case 'delete_contacts':
            try{
                include '../../../utilities/db_conn.php';
                $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
        
                if ($contact_id) {
                    $delete_result = delete_contact($db, $contact_id);
                    $content = '';
                    ob_start();    

                    if ($delete_result) {
                        include "../../components/toast_delete_user.php";
                    }

                    $content = ob_get_clean();
                    echo json_encode(['status' => 'success', 'view' => $content]);
                }
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;

        case 'create_contact_modal':
            try{
                $content = '';
                ob_start(); 

                include '../../../utilities/db_conn.php';
                include "../../components/modal3.php";

                $content = ob_get_clean();
                echo json_encode(['status' => 'success', 'view' => $content]);
            }catch (PDOException $e) {
                //? Ocurre cuando hay un error en la base datos o en el modelo
                error_log('Database Error: ' . $e->getMessage());
                $message = $development_mode ? 'Database error occurred: ' . $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (ErrorException $e) {
                //? Ocurre cuando convertimos un Warning a excepción, normal mente estos warnings php los ignora
                error_log('Warning converted to Exception: ' . $e->getMessage());
                $message = $development_mode ? $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            } catch (Exception $e) {
                //? Ocurre cuando hay un error fatal 
                error_log('Error: ' . $e->getMessage());
                $message = $development_mode ?  $e->getMessage() : $user_message;
                echo json_encode(['status' => 'error', 'message' => $message]);
            }
        break;
        
        case 'save_new_contact':
            try {
                include '../../../utilities/db_conn.php';
                
                $contact_fullname = filter_input(INPUT_POST, 'contact_fullname', FILTER_SANITIZE_STRING);
                $contact_mobile = filter_input(INPUT_POST, 'contact_mobile', FILTER_SANITIZE_STRING);
                $contact_email = filter_input(INPUT_POST, 'contact_email', FILTER_SANITIZE_EMAIL);
                $contact_company = filter_input(INPUT_POST, 'contact_company', FILTER_SANITIZE_STRING);
        
                $image_path = null;
                
                if (!empty($_FILES['image_user']['name'])) {
                    $target_dir = "../../../contacts_documents/";
                    $file_name = basename($_FILES['image_user']['name']);
                    $target_file = $target_dir . $file_name;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    
                    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array($imageFileType, $allowed_types) && $_FILES['image_user']['size'] < 5000000) { // 5MB máximo
                        if (move_uploaded_file($_FILES['image_user']['tmp_name'], $target_file)) {
                            $image_path = $target_file; // Guardamos la ruta en BD
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen']);
                            exit;
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Formato de imagen no válido o archivo demasiado grande']);
                        exit;
                    }
                }
        
                if ($contact_fullname && $contact_mobile && $contact_email && $contact_company) {
                    $created = create_contact($db, $contact_fullname, $contact_mobile, $contact_email, $contact_company, $image_path);
                    
                    $content = '';
                    ob_start();
                    include "../../components/toast_create_user.php";
                    $content = ob_get_clean();
                    
                    echo json_encode(['status' => 'success', 'view' => $content]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
                }
            } catch (PDOException $e) {
                error_log('Database Error: ' . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Error inesperado']);
            }
            break;
    }
?>