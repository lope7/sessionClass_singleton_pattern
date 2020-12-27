<?php

class Session { 

    //Time to expire the session.
    const ET=6000;

    private static ?Session $instance = null;

    /**
     * Method to create the session.
     */

    public static function createSession():Session{

        session_start();

        if (isset($_SESSION["session"])){

        self::$instance = unserialize($_SESSION["session"]);

        }else{

             if (self::$instance==null){

            self::$instance = new Session();

            }

        }

        return self::$instance;

    }

   /**
    * Method to save the session.
    */

    public function saveSession(){

        $_SESSION["time"]=time();

        $_SESSION["session"]= serialize(self::$instance);

    }

    
    /**
     * Method to check if the session has expired and close the session if it is expired or update the time in other case.
     */
    public function isExpired():bool{

        $ta = time();

        $ti = $_SESSION["time"];

        $isExpired = $ta-$ti> self::ET;

            if($isExpired){

                 $this->closeSession();

            }else{

                $_SESSION["time"]=time();

            }

            return $isExpired;

    }

        /**
         * Method to close the session.
         */
        public function closeSession(){

        $_SESSION=[];

        session_destroy();

        }

    }
